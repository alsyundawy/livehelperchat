<?php

$requestPayload = json_decode(file_get_contents('php://input'),true);

erLhcoreClassRestAPIHandler::setHeaders('Content-Type: application/json', (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : (isset($requestPayload['host']) && $requestPayload['host'] != '' ? $requestPayload['host'] : "*")));

erTranslationClassLhTranslation::$htmlEscape = false;

$Params['user_parameters_unordered']['department'] = isset($requestPayload['department']) ? $requestPayload['department'] : null;

$chat = new erLhcoreClassModelChat();

$inputData = new stdClass();
$inputData->chatprefill = '';
$inputData->email = '';
$inputData->username = '';
$inputData->phone = '';
$inputData->product_id = '';
$inputData->bot_id = '';
$inputData->trigger_id = '';
$inputData->validate_start_chat = $inputData->validate_start_chat = isset($requestPayload['mode']) && $requestPayload['mode'] == 'popup' ? true : false;
$inputData->priority = (isset($requestPayload['fields']['priority']) && is_numeric($requestPayload['fields']['priority'])) ? (int)$requestPayload['fields']['priority'] : false;
$inputData->only_bot_online = isset($_POST['onlyBotOnline']) ? (int)$_POST['onlyBotOnline'] : 0;
$inputData->vid = isset($requestPayload['vid']) && $requestPayload['vid'] != '' ? (string)$requestPayload['vid'] : '';
$inputData->skip_bot = false;

if (isset($requestPayload['fields']['DepartamentID']) && !empty($requestPayload['fields']['DepartamentID'])) {
    $Params['user_parameters_unordered']['department'] = [$requestPayload['fields']['DepartamentID']];
}

$validStart = false;

if (is_array($Params['user_parameters_unordered']['department']) && count($Params['user_parameters_unordered']['department']) == 1) {
    if (!(isset($requestPayload['fields']['DepartamentID']) && $requestPayload['fields']['DepartamentID'] == -1)) {
        $parametersDepartment = erLhcoreClassChat::extractDepartment($Params['user_parameters_unordered']['department'],true, $requestPayload);
        $Params['user_parameters_unordered']['department'] = $parametersDepartment['system'];
        $requestPayload['fields']['DepartamentID'] = $inputData->departament_id = array_shift($Params['user_parameters_unordered']['department']);
    } else {
        $inputData->departament_id = -1;
    }
} else {
    $inputData->departament_id = 0;
}

if (is_numeric($inputData->departament_id) && $inputData->departament_id > 0 && ($startDataDepartment = erLhcoreClassModelChatStartSettings::findOne(array('customfilter' => array("((`dep_ids` != '' AND JSON_CONTAINS(`dep_ids`,'" . (int)$inputData->departament_id . "','$')) OR department_id = " . (int)$inputData->departament_id . ")" )))) !== false) {
    $startDataFields = $startDataDepartment->data_array;
} else {
    // Start chat field options
    $startData = erLhcoreClassModelChatConfig::fetch('start_chat_data');
    $startDataFields = (array)$startData->data;
}

if (isset($requestPayload['theme']) && ($themeId = erLhcoreClassChat::extractTheme($requestPayload['theme'])) !== false) {
    $additionalParams['theme'] = erLhAbstractModelWidgetTheme::fetch($themeId);
}

$additionalParams['payload_data'] = isset($requestPayload['fields']) ? $requestPayload['fields'] : array();

if (isset($requestPayload['bpayload']['payload'])) {
    $additionalParams['bpayload'] = $requestPayload['bpayload'];
}

if (isset($additionalParams['payload_data']['phash']) && isset($additionalParams['payload_data']['pvhash']) && (string)$additionalParams['payload_data']['phash'] != '' && (string)$additionalParams['payload_data']['pvhash'] != '') {
    $paidChatSettings = erLhcoreClassChatPaid::paidChatWorkflow(array(
        'uparams' => $additionalParams['payload_data'],
        'mode' => 'chat',
        'output' => 'json'
    ));

    if (isset($paidChatSettings['error'])) {
        $Errors['phash'] = $paidChatSettings['message'];
    }
}

if (isset($restAPI) && $requestPayload['ignore_required'] == true) {
    $additionalParams['ignore_required'] = true;
}

if (isset($restAPI['ignore_captcha']) && $restAPI['ignore_captcha'] === true) {
    $additionalParams['ignore_captcha'] = true;
}

if (isset($restAPI['collect_all']) && $restAPI['collect_all'] === true) {
    $additionalParams['collect_all'] = true;
}

if (!isset($Errors)) {

    if (isset($requestPayload['invitation_id']) && is_numeric($requestPayload['invitation_id'])) {
        $chat->invitation_id = (int)$requestPayload['invitation_id'];
    }

    $chat->referrer = isset($requestPayload['fields']['URLRefer']) ? $requestPayload['fields']['URLRefer'] : '';
    
    if (is_array($chat->referrer)) {
        if (isset($chat->referrer['href'])){
            $chat->referrer = (string)$chat->referrer['href'];
        } else {
            $chat->referrer = '';
        }
    }

    $chat->session_referrer = isset($requestPayload['fields']['r']) ? $requestPayload['fields']['r'] : '';

    $Errors = erLhcoreClassChatValidator::validateStartChat($inputData,$startDataFields,$chat, $additionalParams);
    // Check is visitor blocked based on previous data if present chat does not have a nick
    if (empty($Errors) &&
        erLhcoreClassModelChatConfig::fetch('track_online_visitors')->current_value == 1 &&
        ($chat->nick == 'Visitor' || empty($chat->nick)) && isset($inputData->vid) && !empty($inputData->vid) &&
        ($onlineUser = erLhcoreClassModelChatOnlineUser::fetchByVid($inputData->vid)) instanceof erLhcoreClassModelChatOnlineUser && $onlineUser->nick &&
        $onlineUser->has_nick && erLhcoreClassModelChatBlockedUser::isBlocked(array('ip' => $chat->ip, 'dep_id' => $chat->dep_id, 'nick' => $onlineUser->nick))
    ) {
        $Errors['blocked_user'] = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','At this moment you can contact us via email only. Sorry for the inconveniences.');
    }
}

if (empty($Errors) && isset($startDataFields['pre_conditions']) && !empty($startDataFields['pre_conditions'])) {
    $preConditions = json_decode($startDataFields['pre_conditions'], true);
    if (
        (isset($preConditions['maintenance_mode']) && $preConditions['maintenance_mode'] == 1) ||
        (isset($preConditions['online']) && !empty($preConditions['online'])) ||
        (isset($preConditions['offline']) && !empty($preConditions['offline'])) ||
        (isset($preConditions['disable']) && !empty($preConditions['disable'])) ) {

        $outcome = erLhcoreClassChatValidator::validatePreconditions($preConditions, ['is_online' => true, 'online_user' => (isset($onlineUser) ? $onlineUser : false)]);

        if ($outcome['mode'] == 'disable' || $outcome['mode'] == 'terminate') {
            $Errors['blocked_user'] = $outcome['message'];
        }
    }
}

if (empty($Errors)) {

    $chat->lsync = time();
    $chat->setIP();

    erLhcoreClassModelChat::detectLocation($chat, $inputData->vid);

    if (!isset($restAPI['ignore_geo']) || $restAPI['ignore_geo'] === false) {
        $statusGeoAdjustment = erLhcoreClassChat::getAdjustment(erLhcoreClassModelChatConfig::fetch('geoadjustment_data')->data_value, $inputData->vid);

        if ($statusGeoAdjustment['status'] == 'hidden') {
            $outputResponse = array (
                'success' => false,
                'errors' => ['Chat not available in your country']
            );

            erLhcoreClassRestAPIHandler::outputResponse($outputResponse, 'json', JSON_FORCE_OBJECT);
            exit;
        }
    }

    $chat->time = $chat->pnd_time = time();
    $chat->status = erLhcoreClassModelChat::STATUS_PENDING_CHAT;
    $chat->hash = erLhcoreClassChat::generateHash();

    if (isset($restAPI) && isset($requestPayload['chat_variables']) && is_array($requestPayload['chat_variables'])) {
        $chat_variables_array = $chat->chat_variables_array;
        foreach ($requestPayload['chat_variables'] as $chatVariableKey => $chatVariableName) {
            $chat_variables_array[$chatVariableKey] = $chatVariableName;
        }
        $chat->chat_variables = json_encode($chat_variables_array);
        $chat->chat_variables_array = $chat_variables_array;
    }

    if (isset($restAPI) && isset($requestPayload['additional_data']) && is_array($requestPayload['additional_data'])) {
        $chat_variables_array = $chat->additional_data_array;
        foreach ($requestPayload['additional_data'] as $chatVariableKey => $chatVariableName) {
            $chat_variables_array[$chatVariableKey] = $chatVariableName;
        }
        $chat->additional_data = json_encode($chat_variables_array);
        $chat->additional_data_array = $chat_variables_array;
    }

    $nick = trim($chat->nick);

    if ( empty($nick) ) {
        $chat->nick = 'Visitor';
    }

    try {
        $db = ezcDbInstance::get();
        $db->beginTransaction();

        // Reopen old chat if enabled
        if ( erLhcoreClassModelChatConfig::fetch('track_online_visitors')->current_value == 1 && $inputData->vid != '' && erLhcoreClassModelChatConfig::fetch('reopen_chat_enabled')->current_value == 1 && ($onlineUser = erLhcoreClassModelChatOnlineUser::fetchByVid($inputData->vid)) instanceof erLhcoreClassModelChatOnlineUser ) {
            erLhcoreClassChat::reopenChatWidgetV2($onlineUser, $chat, array(
                'open_closed_chat_timeout' => erLhcoreClassModelChatConfig::fetch('open_closed_chat_timeout')->current_value,
                'reopen_closed' => erLhcoreClassModelChatConfig::fetch('allow_reopen_closed')->current_value
            ));
        }

        $chat->saveThis();

        $logRouting = (int)erLhcoreClassModelChatConfig::fetch('audit_configuration')->data['log_routing'];
        if ($logRouting == 1) {
            erLhcoreClassChatValidator::logRoutingActions($chat);
        }

        if (isset($restAPI) && isset($requestPayload['messages']) && is_array($requestPayload['messages'])) {
            erLhcoreClassRestAPIHandler::importMessages($chat, $requestPayload['messages']);
        }

        $paramsExecution = array();

        // Handle subject
        if (isset($requestPayload['fields']['subject_id']) && is_numeric($requestPayload['fields']['subject_id'])) {
            $subject = erLhAbstractModelSubject::fetch($requestPayload['fields']['subject_id']);
            if ($subject instanceof erLhAbstractModelSubject) {
                $subjectChat = new erLhAbstractModelSubjectChat();
                $subjectChat->subject_id = (int)$requestPayload['fields']['subject_id'];
                $subjectChat->chat_id =$chat->id;
                $subjectChat->saveThis();
            }
        }

        // Assign chat to user
        if ( erLhcoreClassModelChatConfig::fetch('track_online_visitors')->current_value == 1 ) {
            // To track online users
            $userInstance = erLhcoreClassModelChatOnlineUser::handleRequest(array('check_message_operator' => true, 'message_seen_timeout' => erLhcoreClassModelChatConfig::fetch('message_seen_timeout')->current_value, 'vid' => $inputData->vid));

            if ($userInstance !== false) {

                if (isset($requestPayload['invitation_id']) && is_numeric($requestPayload['invitation_id'])) {
                    $chat->invitation_id = (int)$requestPayload['invitation_id'];

                    $onlineAttrSystem = $userInstance->online_attr_system_array;

                    $ignoreResponder = isset($onlineAttrSystem['lhc_ignore_autoresponder']) && $onlineAttrSystem['lhc_ignore_autoresponder'] == 1;

                    if (isset($onlineAttrSystem['lhc_assign_to_me']) && $onlineAttrSystem['lhc_assign_to_me'] == 1 && $userInstance->operator_user !== false && $userInstance->operator_user_id > 0) {
                        $chat->user_id = $userInstance->operator_user_id;
                        $chat->tslasign = time();
                    }

                    if (isset($onlineAttrSystem['lhc_ignore_bot']) && $onlineAttrSystem['lhc_ignore_bot'] == 1) {
                        $ignoreBot = true;
                    }

                    $conversionUser = erLhAbstractModelProactiveChatCampaignConversion::fetch($userInstance->conversion_id);
                    if ($conversionUser instanceof erLhAbstractModelProactiveChatCampaignConversion) {
                        $conversionUser->invitation_status = erLhAbstractModelProactiveChatCampaignConversion::INV_CHAT_STARTED;
                        $conversionUser->chat_id = $chat->id;
                        $conversionUser->department_id = $chat->dep_id;
                        $conversionUser->con_time = time();
                        $conversionUser->saveThis();
                    }

                    $userInstance->conversion_id = 0;

                    // Store Message from operator
                    $msg = new erLhcoreClassModelmsg();
                    $msg->msg = trim($userInstance->operator_message_front);

                    if ($msg->msg == '') {
                        $inv = erLhAbstractModelProactiveChatInvitation::fetch($requestPayload['invitation_id']);
                        if ($inv instanceof erLhAbstractModelProactiveChatInvitation){
                            erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.process_invitation',array(
                                'invitation' => & $inv,
                                'chat' => $chat,
                                'ou' => $userInstance
                            ));
                            $inv->translateByLocale();
                            $msg->msg = $inv->message;
                        }
                    } else {
                        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.process_invitation_ou',array(
                            'ou' => $userInstance,
                            'msg' => & $msg,
                            'chat' => $chat
                        ));
                    }

                    $msg->chat_id = $chat->id;
                    $msg->name_support = $userInstance->operator_user !== false ? trim($userInstance->operator_user->name_support) : (!empty($userInstance->operator_user_proactive) ? $userInstance->operator_user_proactive : erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Live Support'));
                    $msg->user_id = $userInstance->operator_user_id > 0 ? $userInstance->operator_user_id : -2;
                    $msg->time = time();

                    // Save only if there is a message
                    // Happens with invitations where there is no message itself
                    if ($msg->msg != '') {
                        erLhcoreClassChat::getSession()->save($msg);
                    }

                    if ($ignoreResponder == false && $userInstance->invitation !== false && (!isset($userInstance->invitation->design_data_array['use_default_autoresponder']) || $userInstance->invitation->design_data_array['use_default_autoresponder'] == false)) {
                        $responder = $userInstance->invitation->autoresponder;
                    }

                    if ($requestPayload['invitation_id'] > 0) {
                        $invitation = erLhAbstractModelProactiveChatInvitation::fetch($requestPayload['invitation_id']);

                        if ($invitation instanceof erLhAbstractModelProactiveChatInvitation && $invitation->bot_id > 0 && $invitation->trigger_id > 0) {

                            if ($invitation->bot_offline == true) {
                                $paramsExecution['bot_only_offline'] = true;
                            }

                            $paramsExecution['bot_id'] = $invitation->bot_id;
                            $paramsExecution['trigger_id'] = $invitation->trigger_id;

                            // If bot is appended to a widget we should always execute it first.
                            if (isset($invitation->design_data_array['append_bot']) && $invitation->design_data_array['append_bot'] == 1 && !isset($requestPayload['bpayload']['payload'])) {
                                $trigger = erLhcoreClassModelGenericBotTrigger::fetch($paramsExecution['trigger_id']);
                                $paramsExecution['trigger_id_executed'] = $paramsExecution['trigger_id'];
                                if (is_object($trigger)) {
                                    erLhcoreClassGenericBotWorkflow::processTrigger($chat, $trigger);
                                    $triggerEvent = erLhcoreClassModelGenericBotChatEvent::findOne(array('filter' => array('chat_id' => $chat->id)));
                                    unset($paramsExecution['trigger_id']); // Now we let default trigger to be executed
                                }
                            }
                        }

                        // Lock department support
                        if (
                            $invitation instanceof erLhAbstractModelProactiveChatInvitation &&
                            isset($invitation->design_data_array['lock_department']) &&
                            $invitation->design_data_array['lock_department'] == true &&
                            isset($onlineAttrSystem['inv_ldp']) &&
                            is_numeric($onlineAttrSystem['inv_ldp']) &&
                            $onlineAttrSystem['inv_ldp'] > 0
                        ) {
                            $chat->dep_id = $onlineAttrSystem['inv_ldp'];
                            unset($onlineAttrSystem['inv_ldp']); // Let invitation flow set it again
                            $userInstance->online_attr_system = json_encode($onlineAttrSystem);
                        }

                        if ($invitation instanceof erLhAbstractModelProactiveChatInvitation &&
                            isset($invitation->design_data_array['show_everytime']) && $invitation->design_data_array['show_everytime'] == true &&
                            isset($invitation->design_data_array['show_after_chat']) && $invitation->design_data_array['show_after_chat'] == true) {
                            $userInstance->operator_message = '';
                            $userInstance->message_seen = 0;
                            $userInstance->message_seen_ts = 0;
                            if (isset($onlineAttrSystem['qinv'])) {
                                unset($onlineAttrSystem['qinv']); // Next time show normal invitation
                            }
                            if (isset($onlineAttrSystem['session_inv'])) {
                                unset($onlineAttrSystem['session_inv']); // Next time show normal invitation
                            }
                            $userInstance->online_attr_system = json_encode($onlineAttrSystem);
                            $resetMessage = true;
                        }
                    }

                    $chat->chat_initiator = erLhcoreClassModelChat::CHAT_INITIATOR_PROACTIVE;
                }

                if (!isset($resetMessage)) {
                    $userInstance->message_seen = 1;
                    $userInstance->message_seen_ts = time();
                }

                if ($userInstance->visitor_tz == '') {
                    $userInstance->visitor_tz = $chat->user_tz_identifier;
                }

                if (erLhcoreClassModelChatConfig::fetch('remember_phone_email')->current_value == 1 && $userInstance->chat_id > 0) {
                    $chatLegacy = erLhcoreClassModelChat::fetch($userInstance->chat_id);
                    if (is_object($chatLegacy)) {
                        if ($chatLegacy->phone != '' && $chat->phone == '') {
                            $chat->phone = $chatLegacy->phone;
                        }
                        if ($chatLegacy->email != '' && $chat->email == '') {
                            $chat->email = $chatLegacy->email;
                        }
                    }
                }

                $userInstance->dep_id = $chat->dep_id;
                $userInstance->chat_time = time();
                $userInstance->chat_id = $chat->id;

                if (erLhcoreClassModelChatConfig::fetch('remember_username')->current_value == 1) {
                    if ($chat->nick != 'Visitor') {
                        $onlineAttr = $userInstance->online_attr_system_array;
                        if (!isset($onlineAttr['username'])) {
                            $onlineAttr['username'] = $chat->nick;
                            $userInstance->online_attr_system = json_encode($onlineAttr);
                            $userInstance->online_attr_system_array = $onlineAttr;
                        }
                    } elseif ($chat->nick == 'Visitor') {
                        if ($userInstance->nick && $userInstance->has_nick) {
                            $chat->nick = $userInstance->nick;
                            if (empty($chat->nick)) {
                                $chat->nick = 'Visitor';
                            }
                        }
                    }
                }

                $userInstance->saveThis();

                $chat->online_user_id = $userInstance->id;
                $chat->saveThis();

                if ( erLhcoreClassModelChatConfig::fetch('track_footprint')->current_value == 1) {
                    erLhcoreClassModelChatOnlineUserFootprint::assignChatToPageviews($userInstance, erLhcoreClassModelChatConfig::fetch('footprint_background')->current_value == 1);
                }
            }
        }

        // Store theme trigger message as first message
        // But only if invitation have not set those
        // And only if it's not button click
        if ((!isset($requestPayload['invitation_id']) || !is_numeric($requestPayload['invitation_id'])) && !isset($msg) && isset($additionalParams['theme']) && isset($additionalParams['theme']->bot_configuration_array['trigger_id'])
            && !empty($additionalParams['theme']->bot_configuration_array['trigger_id'])
            && $additionalParams['theme']->bot_configuration_array['trigger_id'] > 0
            && !isset($requestPayload['bpayload']['payload'])
        ) {
            $trigger = erLhcoreClassModelGenericBotTrigger::fetch($additionalParams['theme']->bot_configuration_array['trigger_id']);
            $paramsExecution['trigger_id_executed'] = $additionalParams['theme']->bot_configuration_array['trigger_id'];
            if (is_object($trigger)) {
                erLhcoreClassGenericBotWorkflow::$setBotFlow = true;
                erLhcoreClassGenericBotWorkflow::processTrigger($chat, $trigger);
                erLhcoreClassGenericBotWorkflow::$setBotFlow = false;
                $triggerEvent = erLhcoreClassModelGenericBotChatEvent::findOne(array('filter' => array('chat_id' => $chat->id)));
            }
        }

        $messageInitial = false;

        // Store message if required
        if (isset($startDataFields['message_visible_in_page_widget']) && $startDataFields['message_visible_in_page_widget'] == true) {
            if (isset($inputData->question) && $inputData->question != '') {
                // Store question as message
                $msg = new erLhcoreClassModelmsg();
                $msg->msg = trim($inputData->question);
                $msg->chat_id = $chat->id;
                $msg->user_id = 0;
                $msg->time = time();
                erLhcoreClassChat::getSession()->save($msg);

                $paramsExecution['msg'] = $messageInitial = $msg;

                $chat->unanswered_chat = 1;
                $chat->last_msg_id = $msg->id;
                $chat->saveThis();

                if (isset($triggerEvent) && $triggerEvent instanceof erLhcoreClassModelGenericBotChatEvent){
                    erLhcoreClassGenericBotWorkflow::userMessageAdded($chat, $msg);
                    $paramsExecution['ignore_default'] = true;
                }
            }
        }

        if (is_numeric($inputData->bot_id) && !isset($paramsExecution['bot_id'])) {
            $paramsExecution['bot_id'] = (int)$inputData->bot_id;
        }

        if (isset($requestPayload['bpayload']['payload']) && isset($requestPayload['bpayload']['type']) && $requestPayload['bpayload']['type'] == 'triggerclicked') {
            $paramsExecution['trigger_id'] = $requestPayload['bpayload']['id'];
            $paramsExecution['trigger_button_id'] = $requestPayload['bpayload']['payload'];
            $paramsExecution['processed'] = $requestPayload['bpayload']['processed'];
        }else if (isset($requestPayload['bpayload']['payload']) && isset($requestPayload['bpayload']['type']) && $requestPayload['bpayload']['type'] == '') {
            $paramsExecution['trigger_id'] = $requestPayload['bpayload']['id'];
            $paramsExecution['trigger_payload_id'] = $requestPayload['bpayload']['payload'];
            $paramsExecution['processed'] = $requestPayload['bpayload']['processed'];
        } else if (is_numeric($inputData->trigger_id)) {
            $paramsExecution['trigger_id'] = $inputData->trigger_id;
        }

        if (
            !(isset($requestPayload['ignore_bot']) && $requestPayload['ignore_bot'] == true) &&
            !(isset($additionalParams['payload_data']['ignore_bot']) && $additionalParams['payload_data']['ignore_bot'] == true) &&
            !(isset($ignoreBot) && $ignoreBot == true) &&
            $inputData->skip_bot === false
        ) {
            // Set bot workflow if required
            erLhcoreClassChatValidator::setBot($chat, $paramsExecution);
        }

        if (!isset($responder) && (!isset($ignoreResponder) || $ignoreResponder === false)) {
            $responder = erLhAbstractModelAutoResponder::processAutoResponder($chat);
        }

        if (isset($responder) && $responder instanceof erLhAbstractModelAutoResponder && $responder->disabled == 0) {
            $beforeAutoResponderErrors = array();
            erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.before_auto_responder_triggered',array('chat' => & $chat, 'errors' => & $beforeAutoResponderErrors));

            if (empty($beforeAutoResponderErrors)) {

                $responderChat = new erLhAbstractModelAutoResponderChat();
                $responderChat->auto_responder_id = $responder->id;
                $responderChat->chat_id = $chat->id;
                $responderChat->wait_timeout_send = 1 - $responder->repeat_number;
                $responderChat->saveThis();

                $chat->auto_responder_id = $responderChat->id;

                erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.before_auto_responder_message',array('chat' => & $chat, 'responder' => & $responder));

                if ($chat->status != erLhcoreClassModelChat::STATUS_BOT_CHAT)
                {
                    $messageText = '';

                    if ($responder->offline_message != '' && !erLhcoreClassChat::isOnline($chat->dep_id, false, array(
                            'online_timeout' => (int) erLhcoreClassModelChatConfig::fetch('sync_sound_settings')->data['online_timeout'],
                            'ignore_user_status' => false
                        ))) {
                        $messageText = $responder->offline_message;
                    } else {
                        $messageText = $responder->wait_message;
                    }

                    if ($messageText != '') {
                        $msg = new erLhcoreClassModelmsg();
                        $msg->msg = erLhcoreClassGenericBotWorkflow::translateMessage(trim($messageText), array('chat' => $chat, 'args' => ['chat' => $chat]));
                        $msg->meta_msg = $responder->getMeta($chat, 'pending');

                        if ($msg->meta_msg == '') {
                            $msg->meta_msg = '{"content":{"auto_responder":true}}';
                        } else {
                            $metaMessage = json_decode($msg->meta_msg, true);
                            $metaMessage['content']['auto_responder'] = true;
                            $msg->meta_msg = json_encode($metaMessage);
                        }
                        
                        $msg->chat_id = $chat->id;
                        $msg->name_support = $responder->operator != '' ? $responder->operator : erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Live Support');
                        $msg->user_id = -2;
                        $msg->time = time() + 1;
                        erLhcoreClassChat::getSession()->save($msg);

                        if ($chat->last_msg_id < $msg->id) {
                            $chat->last_msg_id = $msg->id;
                        }
                    }
                }


                $chat->saveThis();

                erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.auto_responder_triggered', array('chat' => & $chat));
            } else {
                $msg = new erLhcoreClassModelmsg();
                $msg->msg = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/adminchat','Auto responder got error').': '.implode('; ', $beforeAutoResponderErrors);
                $msg->chat_id = $chat->id;
                $msg->user_id = -1;
                $msg->time = time();

                if ($chat->last_msg_id < $msg->id) {
                    $chat->last_msg_id = $msg->id;
                }

                erLhcoreClassChat::getSession()->save($msg);
            }
        }

        erLhcoreClassChat::updateDepartmentStats($chat->department);

        // Paid chat settings
        if (isset($paidChatSettings)) {
            erLhcoreClassChatPaid::processPaidChatWorkflow(array(
                'chat' => $chat,
                'paid_chat_params' => $paidChatSettings,
            ));
        }

        // We want to find first visitor message and always scroll to it
        $message_id_first = (int)erLhcoreClassModelmsg::getCount(['limit' => 1, 'sort' => 'id ASC', 'filter' => ['user_id' => 0, 'chat_id' => $chat->id]],'count','id','id');

        if ($message_id_first == 0) { // Sometimes action can be a button click without saving visitor message, in this scenario there is no visitor message
            $message_id_first = (int)erLhcoreClassModelmsg::getCount(['limit' => 1, 'offset' => 1, 'sort' => 'id ASC', 'filter' => ['chat_id' => $chat->id]],'count','id','id');
        }

        $db->commit();

        $validStart = true;

    } catch (Exception $e) {
        $db->rollback();
        throw $e;
    }

    $outputResponse = array (
        'success' => true,
        't' => erLhcoreClassGenericBotWorkflow::$triggerName,
        'chatLiveData' => array (
            'message_id_first' => (isset($message_id_first) ? $message_id_first : 0)
        ),
        'chatData' => array (
            'id' => $chat->id,
            'hash' => $chat->hash,
            'lmsg_id' => (is_numeric($chat->old_last_msg_id) ? $chat->old_last_msg_id : 0)
        )
    );

} else {
    $optionsJson = JSON_FORCE_OBJECT;
    $outputResponse = array (
        'success' => false,
        'errors' => $Errors
    );
}

if (!isset($restAPI)) {
    erLhcoreClassRestAPIHandler::outputResponse($outputResponse, 'json', isset($optionsJson) ? $optionsJson : 0);

    if ($validStart === true) {

        // Try to finish request before any listers do their job
        flush();
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.chat_started', array('chat' => & $chat, 'msg' => $messageInitial));
    }

    exit;
} else {
    if ($validStart === true) {
        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.chat_started', array('chat' => & $chat, 'msg' => $messageInitial));
    }
}


?>