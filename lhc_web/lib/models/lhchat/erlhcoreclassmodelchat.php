<?php
#[\AllowDynamicProperties]
class erLhcoreClassModelChat {

   use erLhcoreClassDBTrait;
    
   public static $dbTable = 'lh_chat';
    
   public static $dbTableId = 'id';
   
   public static $dbSessionHandler = 'erLhcoreClassChat::getSession';
    
   public static $dbSortOrder = 'DESC';
    
   public function getState()
   {
       return array(
               'id'              		=> $this->id,
               'nick'            		=> $this->nick,
               'status'          		=> $this->status,
               'status_sub'          	=> $this->status_sub,
               'status_sub_arg'         => $this->status_sub_arg,
               'status_sub_sub'         => $this->status_sub_sub,
               'sender_user_id'         => $this->sender_user_id,
               'time'            		=> $this->time,
               'user_id'         		=> $this->user_id,
               'hash'            		=> $this->hash,
               'ip'              		=> $this->ip,
               'referrer'        		=> $this->referrer,
               'dep_id'          		=> $this->dep_id,
               'email'           		=> $this->email,
               'user_status'     		=> $this->user_status,
               'support_informed'		=> $this->support_informed,
               'country_code'    		=> $this->country_code,
               'country_name'    		=> $this->country_name,
               'user_typing'     		=> $this->user_typing,
               'user_typing_txt'     	=> $this->user_typing_txt,
               'operator_typing' 		=> $this->operator_typing,
               'operator_typing_id' 	=> $this->operator_typing_id,
               'phone'           		=> $this->phone,
               'has_unread_messages'    => $this->has_unread_messages,
               'has_unread_op_messages' => $this->has_unread_op_messages,
               'last_user_msg_time'     => $this->last_user_msg_time,
               'last_op_msg_time'     	=> $this->last_op_msg_time,
               'last_msg_id'     		=> $this->last_msg_id,
               'mail_send'     			=> $this->mail_send,
               'lat'     				=> $this->lat,
               'lon'     				=> $this->lon,
               'city'     				=> $this->city,
               'additional_data'     	=> $this->additional_data,
               'session_referrer'     	=> $this->session_referrer,
               'wait_time'     			=> $this->wait_time,
               'chat_duration'     		=> $this->chat_duration,
               'chat_variables'     	=> $this->chat_variables,
               'priority'     			=> $this->priority,
               'chat_initiator'     	=> $this->chat_initiator,
               'user_tz_identifier'     => $this->user_tz_identifier,
               'user_closed_ts'     	=> $this->user_closed_ts,
               'lsync'     	            => $this->lsync,

       		   'online_user_id'     	=> $this->online_user_id,
       		   'unread_messages_informed' => $this->unread_messages_informed,
       		   'unread_op_messages_informed' => $this->unread_op_messages_informed,
       		   'reinform_timeout'     	=> $this->reinform_timeout,

               // Auto responder
               'auto_responder_id'      => $this->auto_responder_id,
           
       		    // Transfer workflow attributes
               'transfer_timeout_ts'    => $this->transfer_timeout_ts,
               'transfer_if_na'    		=> $this->transfer_if_na,
               'transfer_timeout_ac'    => $this->transfer_timeout_ac,
               'transfer_uid'           => $this->transfer_uid,

       			// Callback status
               'na_cb_executed'    		=> $this->na_cb_executed,
               'fbst'    				=> $this->fbst,
               'nc_cb_executed'    		=> $this->nc_cb_executed,
       		
       		    //
               'remarks'    			=> $this->remarks,
       		   // What operation is pending visitor?
               'operation'    			=> $this->operation,
       		
       		   // What operation is pending operator?
               'operation_admin'    	=> $this->operation_admin,
       		
       		   // Screenshot ID? maps to file
               'screenshot_id'    		=> $this->screenshot_id,
       		
               'tslasign'    			=> $this->tslasign,
           
               // Operator status while they were accepting chat
               'usaccept'    			=> $this->usaccept,
           
               // Visitor language
               'chat_locale'    		=> $this->chat_locale,
           
               // Operator language
               'chat_locale_to'    		=> $this->chat_locale_to,
           
               // Was chat unanswered before user has left a chat
               // Currently there isn’t a statistic that shows the number of users that has left the chat before operator has accepted the chat.
               'unanswered_chat'    	=> $this->unanswered_chat,
           
               // Product ID
               'product_id'    	        => $this->product_id,

               // Product ID
               'invitation_id'    	    => $this->invitation_id,
       		
               'uagent'    	        	=> $this->uagent,
               'device_type'    	    => $this->device_type,

               // Time then chat became pending
               'pnd_time'    	        => $this->pnd_time,

               // Time then chat was closed
               'cls_time'    	        => $this->cls_time,

               // Anonymized
               'anonymized'    	        => $this->anonymized,
               'gbot_id'    	        => $this->gbot_id,
               'cls_us'    	            => $this->cls_us,
               'iwh_id'    	            => $this->iwh_id,
               'theme_id'    	        => $this->theme_id,

                'frt'                   => $this->frt,  // First time response delay
                'aart'                  => $this->aart, // Average agent response time
                'mart'                  => $this->mart  // Maximum agent response time
       );
   }

   public function beforeRemove()
   {
       $db = ezcDbInstance::get();

       foreach ([
           'lh_msg',
           'lh_chat_action',
           'lh_chat_online_user_footprint',
           'lh_cobrowse',
           'lh_speech_chat_language',
           'lh_abstract_survey_item',
           'lh_chat_paid',
           'lh_abstract_subject_chat',
           'lh_chat_voice_video',
           'lh_chat_incoming',
           'lh_chat_participant',
           'lh_canned_msg_use'] as $table) {
           $q = $db->createDeleteQuery();
           $q->deleteFrom($table)->where( $q->expr->eq( 'chat_id', $this->id ) );
           $stmt = $q->prepare();
           $stmt->execute();
       }

       $q = $db->createDeleteQuery();
       $q->deleteFrom("lh_transfer")->where(
           $q->expr->eq( 'chat_id', $this->id ),
           $q->expr->eq( 'transfer_scope', 0 )
       );
       $stmt = $q->prepare();
       $stmt->execute();

       $this->removePendingEvents();

       erLhcoreClassModelGroupChat::deleteByChatId($this->id);

       erLhcoreClassModelChatFile::deleteByChatId($this->id);
   }

   public function removePendingEvents() {
       $q = ezcDbInstance::get()->createDeleteQuery();
       foreach ([
                    'lh_abstract_auto_responder_chat',
                    'lh_generic_bot_repeat_restrict',
                    'lh_generic_bot_chat_event',
                    'lh_generic_bot_pending_event'] as $table){
           $q->deleteFrom($table)->where( $q->expr->eq( 'chat_id', $this->id ) );
           $stmt = $q->prepare();
           $stmt->execute();
       }
   }

   public function afterRemove()
   {
       erLhcoreClassChat::updateActiveChats($this->user_id);
        
       if ($this->department !== false) {
           erLhcoreClassChat::updateDepartmentStats($this->department);
       }
   }
   
   public function setIP()
   {
       $this->ip = erLhcoreClassIPDetect::getIP();
   }

   public function getChatOwner()
   {
       try {
           $user = erLhcoreClassUser::getSession()->load('erLhcoreClassModelUser', $this->user_id);
           return $user;
       } catch (Exception $e) {
           return false;
       }
   }

   public function __get($var) {

       switch ($var) {

       	case 'time_created_front':
       			$this->time_created_front = date('Ymd') == date('Ymd',$this->time) ? date(erLhcoreClassModule::$dateHourFormat,$this->time) : date(erLhcoreClassModule::$dateDateHourFormat,$this->time);
       			return $this->time_created_front;
       		break;

       	case 'pnd_time_front':
       	        if ($this->pnd_time == 0) {
                    $this->pnd_time = $this->time;
                }
       			$this->pnd_time_front = date('Ymd') == date('Ymd',$this->pnd_time) ? date(erLhcoreClassModule::$dateHourFormat,$this->pnd_time) : date(erLhcoreClassModule::$dateDateHourFormat,$this->pnd_time);
       			return $this->pnd_time_front;
       		break;

       	case 'cls_time_front':
       			$this->cls_time_front = date('Ymd') == date('Ymd',$this->cls_time) ? date(erLhcoreClassModule::$dateHourFormat,$this->cls_time) : date(erLhcoreClassModule::$dateDateHourFormat,$this->cls_time);
       			return $this->cls_time_front;
       		break;

       	case 'user_closed_ts_front':
       			$this->user_closed_ts_front = date('Ymd') == date('Ymd',$this->user_closed_ts) ? date(erLhcoreClassModule::$dateHourFormat,$this->user_closed_ts) : date(erLhcoreClassModule::$dateDateHourFormat,$this->user_closed_ts);
       			return $this->user_closed_ts_front;
       		break;
       	
       	case 'is_operator_typing':
       		   $this->is_operator_typing = $this->operator_typing > (time()-60); // typing is considered if status did not changed for 30 seconds
       		   return $this->is_operator_typing;
       		break;

       	case 'can_edit_chat':
       		   $this->can_edit_chat = erLhcoreClassChat::hasAccessToWrite($this); // typing is considered if status did not changed for 30 seconds
       		   return $this->can_edit_chat;
       		break;

       	case 'is_user_typing':
       		   $this->is_user_typing = $this->user_typing > (time()-10); // typing is considered if status did not changed for 30 seconds
       		   return $this->is_user_typing;
       		break;

       	case 'wait_time_seconds':
       		   $this->wait_time_seconds = time() - max($this->time,$this->pnd_time);
       		   return $this->wait_time_seconds;

       case 'last_msg':
           $this->last_msg = erLhcoreClassModelmsg::fetch($this->last_msg_id);
           return $this->last_msg;

       case 'last_msg_time':
            $this->last_msg_time = max($this->last_user_msg_time, $this->last_op_msg_time);
            return $this->last_msg_time;

       case 'last_msg_time_front':
            $this->last_msg_time_front = erLhcoreClassChat::formatSeconds(time() - max($this->last_user_msg_time, $this->last_op_msg_time, $this->pnd_time));
            return $this->last_msg_time_front;

       	case 'wait_time_front':
       		   $this->wait_time_front = erLhcoreClassChat::formatSeconds($this->wait_time);
       		   return $this->wait_time_front;

       case 'start_last_action_front':
           $this->start_last_action_front = erLhcoreClassChat::formatSeconds(time() - ($this->status == 0 ? $this->pnd_time : $this->time));
           return $this->start_last_action_front;

       	case 'last_user_msg_time_front':
               $this->last_user_msg_time_front = $this->last_user_msg_time > 0 ? erLhcoreClassChat::formatSeconds(time() - $this->last_user_msg_time) : null;
       		   return $this->last_user_msg_time_front;

       	case 'wait_time_pending':
       		   $this->wait_time_pending = erLhcoreClassChat::formatSeconds($this->wait_time_seconds);
       		   return $this->wait_time_pending;

       	case 'pnd_rsp':
       		   $this->pnd_rsp = $this->status == self::STATUS_PENDING_CHAT || $this->last_user_msg_time > $this->last_op_msg_time;
       		   return $this->pnd_rsp;

       	case 'chat_duration_front':
       	       if ($this->chat_duration > 0) {
                   $this->chat_duration_front = erLhcoreClassChat::formatSeconds($this->chat_duration);
               } elseif ($this->status != self::STATUS_CLOSED_CHAT) {
                   $this->chat_duration_front = erLhcoreClassChat::formatSeconds($this->wait_time_seconds);
               } else {
                   $this->chat_duration_front = null;
               }
       		   return $this->chat_duration_front;

       	case 'user_name':
       			return $this->user_name = (string)$this->user;

       	case 'plain_user_name':
       	        $this->plain_user_name = false;
       	        
       	        if ($this->user !== false) {
       	            $this->plain_user_name = (string)$this->user->name_support;
       	        }
       	        
       			return $this->plain_user_name;
       		break;

           case 'hum':
               $this->hum = $this->has_unread_messages == 1 && $this->last_user_msg_time < time() - 7;
               return $this->hum;
               break;

       	case 'n_official':
       	        $this->n_office = false;

       	        if ($this->user !== false) {
       	            $this->n_office = (string)$this->user->name;
       	            if ($this->n_office == '') {
                        $this->n_office = $this->plain_user_name;
                    }
       	        }

       			return $this->n_office;
       		break;

       	case 'n_off_full':
       	        $this->n_off_full = false;
       	        
       	        if ($this->user !== false) {
       	            $this->n_off_full = (string)$this->user->name_official;
       	        }

       			return $this->n_off_full;
       		break;
       		
       	case 'user':
       		   $this->user = false;
       		   if ($this->user_id > 0) {
       		   		try {
       		   			$this->user = erLhcoreClassModelUser::fetch($this->user_id,true);
       		   		} catch (Exception $e) {
       		   			$this->user = false;
       		   		}
       		   }
       		   return $this->user;
       		break;
       	    	
       	case 'operator_typing_user':
       		   $this->operator_typing_user = false;
       		   if ($this->operator_typing_id > 0) {
       		   		try {
       		   			$this->operator_typing_user = erLhcoreClassModelUser::fetch($this->operator_typing_id);
       		   		} catch (Exception $e) {
       		   			$this->operator_typing_user = false;
       		   		}
       		   }
       		   return $this->operator_typing_user;
       		break;

       	case 'online_user':
       			$this->online_user = false;
       			if ($this->online_user_id > 0){
       				try {
       					$this->online_user = erLhcoreClassModelChatOnlineUser::fetch($this->online_user_id);
       				} catch (Exception $e) {
       					$this->online_user = false;
       				}
       			}
       			return $this->online_user;
       		break;

       	case 'department':
       			$this->department = false;
       			if ($this->dep_id > 0) {
       				try {
       					$this->department = erLhcoreClassModelDepartament::fetch($this->dep_id,true);
       				} catch (Exception $e) {

       				}
       			}

       			return $this->department;
       		break;
       		
       	case 'auto_responder':
           	    $this->auto_responder = false;
           	    if ($this->auto_responder_id > 0) {
           	        try {
           	            $this->auto_responder = erLhAbstractModelAutoResponderChat::fetch($this->auto_responder_id);
           	        } catch (Exception $e) {
           	    
           	        }
           	    }
           	    return $this->auto_responder;
       	    break;

       	case 'product':
       			$this->product = false;
       			if ($this->product_id > 0) {
       				try {
       					$this->product = erLhAbstractModelProduct::fetch($this->product_id,true);
       				} catch (Exception $e) {
                        
       				}
       			}
       			return $this->product;
       		break;

       	case 'product_name':
       			$this->product_name = (string)$this->product;
       			return $this->product_name;

       case 'subject_ids':
           $this->subject_ids = erLhAbstractModelSubjectChat::getCount(['filter' => ['chat_id' => $this->id]],'count','subject_id','subject_id',false, true, true);
           return $this->subject_ids;

       case 'subject_ids_list':
           $this->subject_ids_list = implode(',',$this->subject_ids);
           return $this->subject_ids_list;

       	case 'department_role':
                $this->department_role = \LiveHelperChat\Models\Brand\BrandMember::findOne(['filter' => ['dep_id' => $this->dep_id]]);
       			return $this->department_role;
       		break;

       	case 'department_name':
       			return $this->department_name = (string)$this->department;
       		break;
       		
       	case 'number_in_queue':
       	        $this->number_in_queue = 1;
       	        if ($this->status == self::STATUS_PENDING_CHAT) {
       	           $this->number_in_queue = self::getCount(array('filterlt' => array('id' => $this->id), 'filtergte' => array('priority' => $this->priority),'filter' => array('dep_id' => $this->dep_id, 'status' => self::STATUS_PENDING_CHAT))) + 1;
       	        }
       	        return $this->number_in_queue;
       	    break;
       	    	
       	case 'screenshot':
       			$this->screenshot = false;
       			if ($this->screenshot_id > 0) {
       				try {
       					$this->screenshot = erLhcoreClassModelChatFile::fetch($this->screenshot_id);
       				} catch (Exception $e) {
       			
       				}
       			}
       			
       			return $this->screenshot;
       		break;	
       		
       	case 'unread_time':
       		
	       		$diff = time()-$this->last_user_msg_time;
	       		$hours = floor($diff/3600);
	       		$minits = floor(($diff - ($hours * 3600))/60);
	       		$seconds = ($diff - ($hours * 3600) - ($minits * 60));
	       		
       			$this->unread_time = array(
       				'hours' => $hours,
       				'minits' => $minits,
       				'seconds' => $seconds,
       			); 
       			 
       			return $this->unread_time;
       		break;
       		
       	case 'user_tz_identifier_time':
                try {
                    $date = new DateTime('NOW', new DateTimeZone($this->user_tz_identifier));
                } catch (Exception $e) {
                    $date = new DateTime('NOW', new DateTimeZone('UTC'));
                }
       			$this->user_tz_identifier_time = $date->format(erLhcoreClassModule::$dateHourFormat);
       			return $this->user_tz_identifier_time;
       		break;
       		
       	case 'additional_data_array':

                $this->additional_data_array = array();
       	        if ($this->additional_data != ''){
                    $jsonData = json_decode($this->additional_data,true);
                    if ($jsonData !== null) {
                        $this->additional_data_array = $jsonData;
                    } else {
                        $this->additional_data_array = array();
                    }
                }

       			return $this->additional_data_array;
       		break;

       case 'msg_v':
            $this->msg_v = 0;
            $chatVariables = $this->chat_variables_array;
            if (isset($chatVariables['msg_v'])) {
                $this->msg_v = $chatVariables['msg_v'];
            }
            return $this->msg_v;
       break;

       case 'aicons':
           $this->aicons = [];
           $chatVariables = $this->chat_variables_array;
           if (isset($chatVariables['aicons']) ) {
               foreach ($chatVariables['aicons'] as $icon => $params) {
                   $iconParams = ['i' => $icon];
                   if (isset($params['icolor'])) {
                       $iconParams['c'] = $params['icolor'];
                   }
                   if (isset($params['t']) && $params['t'] != '') {
                       $iconParams['t'] = $params['t'];
                   }
                   if (isset($params['b']) && $params['b'] === 1) {
                       $this->nb = 1;
                   }
                   if (isset($params['nc']) && $params['nc'] != '') {
                       $this->nc = $params['nc'];
                   }
                   $this->aicons[$icon] = $iconParams;
               }
           }
           if ($this->iwh_id > 0 && is_object($this->iwh) && $this->iwh->icon != '') {
               $iconParams = ['i' => (strpos($this->iwh->icon,'.') !== false ? erLhcoreClassDesign::design('images/' . $this->iwh->icon) : $this->iwh->icon)];

               if (empty($iconParams['i'])){
                   $iconParams['i'] = 'webhook';
               }

               if ($this->iwh->icon_color != '') {
                   $iconParams['c'] = $this->iwh->icon_color ;
               }
               $iconParams['t'] = (string)$this->iwh;
               $this->aicons[$this->iwh->icon] = $iconParams;
           }
           return $this->aicons;

       case 'aalert':
            $this->aalert = null;
            $chatVariables = $this->chat_variables_array;
            if (isset($chatVariables['aicons'])) {
                foreach ($chatVariables['aicons'] as $aicon) {
                    if ($aicon['alert'] == true) {
                        $this->aalert = true;
                        break;
                    }
                }
            }
            return $this->aalert;

       	case 'chat_variables_array':
       	        if (!empty($this->chat_variables)){
           			$jsonData = json_decode($this->chat_variables,true);
           			if ($jsonData !== null) {
           				$this->chat_variables_array = $jsonData;
           			} else {
           			    $chat_variables_array = @unserialize($this->chat_variables);
           			    if ($chat_variables_array !== false) {
           			        $this->chat_variables_array = $chat_variables_array;
           			    } else {
           			        $this->chat_variables_array = $this->chat_variables;
           			    }
           			}
       	        } else {
       	            $this->chat_variables_array = array();
       	        }
       			return $this->chat_variables_array;

       case 'chat_dynamic_array':

           $chat_dynamic_array = [];
           erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.dynamic_array', array('chat' => $this, 'dynamic_array' => & $chat_dynamic_array));
           $this->chat_dynamic_array = $chat_dynamic_array;

           return $this->chat_dynamic_array;

       case 'user_status_front':

           if ($this->status == self::STATUS_CLOSED_CHAT && $this->cls_us != 0) {
                $this->user_status_front = $this->cls_us - 1;
                return $this->user_status_front;
            }

            // Because mobile devices freezes background tabs we need to have bigger timeout
            $timeout = 60;

            if ($this->device_type != 0 && (strpos($this->uagent,'iPhone') !== false || strpos($this->uagent,'iPad') !== false)) {
                $timeout = 240;
            }

            $this->user_status_front =  (time() - $timeout > $this->lsync || in_array($this->status_sub,array(erLhcoreClassModelChat::STATUS_SUB_SURVEY_COMPLETED, erLhcoreClassModelChat::STATUS_SUB_SURVEY_SHOW,erLhcoreClassModelChat::STATUS_SUB_USER_CLOSED_CHAT,erLhcoreClassModelChat::STATUS_SUB_CONTACT_FORM))) ? 1 : 0;

       		return $this->user_status_front;

       	case 'bot':
            $chatVariables = $this->chat_variables_array;
            $bot = null;

            if (isset($chatVariables['gbot_id']) && $chatVariables['gbot_id'] > 0) {
                $bot = erLhcoreClassModelGenericBotBot::fetch($chatVariables['gbot_id']);
            } elseif ($this->gbot_id > 0) {
                $bot = erLhcoreClassModelGenericBotBot::fetch($this->gbot_id);
            }

            $this->bot = $bot;
            return $this->bot;

       case 'incoming_chat':
           $this->incoming_chat = erLhcoreClassModelChatIncoming::findOne(array('filter' => array('chat_id' => $this->id)));
           return $this->incoming_chat;

       case 'iwh':
           $this->iwh = $this->iwh_id > 0 ? erLhcoreClassModelChatIncomingWebhook::fetch($this->iwh_id) : null;
           return $this->iwh;

       case 'referrer_params':
           $this->referrer_params = parse_url($this->referrer);
           return $this->referrer_params;

       	default:
       		break;
       }

   }

   public static function detectLocation(erLhcoreClassModelChat & $instance, $vid = '')
   {
       $locationDetected = false;

       // Try to detect GEO information from online visitor record. So we avoid duplicate calls.
       if ($vid != '' && is_string($vid)) {
           $onUser = erLhcoreClassModelChatOnlineUser::findOne(array('filter' => array('vid' => $vid)));
           if ($onUser instanceof erLhcoreClassModelChatOnlineUser) {
               if ($onUser->user_country_name != '') {
                   $instance->country_code = (string)$onUser->user_country_code;
                   $instance->country_name = (string)$onUser->user_country_name;
                   $instance->lat = (string)$onUser->lat;
                   $instance->lon = (string)$onUser->lon;
                   $instance->city = (string)$onUser->city;
                   $locationDetected = true;
               }
               if ($instance->online_user_id == 0) {
                   $instance->online_user_id = $onUser->id;
               }
           }
       }

       if ($locationDetected === false) {
           $geoData = erLhcoreClassModelChatConfig::fetch('geo_data');
           $geo_data = (array)$geoData->data;

           $fileData = erLhcoreClassModelChatConfig::fetch('file_configuration');
           $data = (array)$fileData->data;

           if (isset($geo_data['geo_detection_enabled']) && $geo_data['geo_detection_enabled'] == 1) {

               $params = array();

               if ($geo_data['geo_service_identifier'] == 'mod_geoip2'){
                   $params['country_code'] = $geo_data['mod_geo_ip_country_code'];
                   $params['country_name'] = $geo_data['mod_geo_ip_country_name'];
                   $params['mod_geo_ip_city_name'] = $geo_data['mod_geo_ip_city_name'];
                   $params['mod_geo_ip_latitude'] = $geo_data['mod_geo_ip_latitude'];
                   $params['mod_geo_ip_longitude'] = $geo_data['mod_geo_ip_longitude'];
               } elseif ($geo_data['geo_service_identifier'] == 'locatorhq') {
                   $params['username'] = $geo_data['locatorhqusername'];
                   $params['api_key'] = $geo_data['locatorhq_api_key'];
               } elseif ($geo_data['geo_service_identifier'] == 'ipinfodbcom') {
                   $params['api_key'] = $geo_data['ipinfodbcom_api_key'];
               } elseif ($geo_data['geo_service_identifier'] == 'max_mind') {
                   $params['detection_type'] = $geo_data['max_mind_detection_type'];
                   $params['city_file'] = isset($geo_data['max_mind_city_location']) ? $geo_data['max_mind_city_location'] : '';
               } elseif ($geo_data['geo_service_identifier'] == 'freegeoip') {
                   $params['freegeoip_key'] = $geo_data['freegeoip_key'];
               } elseif ($geo_data['geo_service_identifier'] == 'ipapi') {
                   $params['api_key'] = $geo_data['ipapi_key'];
               } elseif ($geo_data['geo_service_identifier'] == 'abstractapi') {
                   $params['abstractapi_key'] = $geo_data['abstractapi_key'];
               }

               $location = erLhcoreClassModelChatOnlineUser::getUserData($geo_data['geo_service_identifier'],$instance->ip,$params);

               if ($location !== false){
                   $instance->country_code = (string)$location->country_code;
                   $instance->country_name = (string)$location->country_name;
                   $instance->lat = (string)$location->lat;
                   $instance->lon = (string)$location->lon;
                   $instance->city = (string)$location->city;
               }
           }
       }

       $hideIp = erLhcoreClassModelChatConfig::fetch('do_no_track_ip');
       if ($hideIp->value == 1) {
           $instance->ip = preg_replace(
               [
                   '/(\.\d+){2}$/',
                   '/(:[\da-f]*){2,4}$/'
               ],
               [
                   '.XXX.XXX',
                   ':XXXX:XXXX:XXXX:XXXX'
               ],
               $instance->ip
           );
       }
   }

   const STATUS_PENDING_CHAT = 0;
   const STATUS_ACTIVE_CHAT = 1;
   const STATUS_CLOSED_CHAT = 2;
   const STATUS_CHATBOX_CHAT = 3;
   const STATUS_OPERATORS_CHAT = 4;
   const STATUS_BOT_CHAT = 5;

   const CHAT_INITIATOR_DEFAULT = 0;
   const CHAT_INITIATOR_PROACTIVE = 1;

   const STATUS_SUB_DEFAULT = 0;
   const STATUS_SUB_OWNER_CHANGED = 1;
   const STATUS_SUB_CONTACT_FORM = 2;
   const STATUS_SUB_USER_CLOSED_CHAT = 3;
   const STATUS_SUB_START_ON_KEY_UP = 4;
   const STATUS_SUB_SURVEY_SHOW = 5;
   const STATUS_SUB_SURVEY_COLLECTED = 6;
   const STATUS_SUB_OFFLINE_REQUEST = 7;
   const STATUS_SUB_ON_HOLD = 8;
   const STATUS_SUB_SURVEY_COMPLETED = 9;

   const STATUS_SUB_SUB_DEFAULT = 0;
   const STATUS_SUB_SUB_TRANSFERED = 1;
   const STATUS_SUB_SUB_CLOSED = 2; // Chat was previously closed, but became pending again.
   const STATUS_SUB_SUB_MSG_DELIVERED = 3; // Chat was previously closed, but became pending again.

   const USER_STATUS_JOINED_CHAT = 0;
   const USER_STATUS_CLOSED_CHAT = 1;
   const USER_STATUS_PENDING_REOPEN = 2;
   
   const OP_STATUS_ACCEPT_ONLINE = 0;
   const OP_STATUS_ACCEPT_OFFLINE = 1;
   
   public $id = null;
   public $nick = '';
   
   // General chat statusses
   public $status = self::STATUS_PENDING_CHAT;
   
   // Used for visitors
   public $status_sub = self::STATUS_SUB_DEFAULT;
   
   // Used for operators
   public $status_sub_sub = self::STATUS_SUB_SUB_DEFAULT;
   
   public $time = '';
   public $user_id = 0;
   public $sender_user_id = 0;
   public $hash = '';
   public $ip = '';
   public $referrer = '';
   public $dep_id = '';
   public $email = '';
   public $user_status = self::USER_STATUS_JOINED_CHAT;
   public $support_informed = '';
   public $country_code = '';
   public $country_name = '';
   public $phone = '';
   public $user_typing = 0;
   public $user_typing_txt = '';
   public $operator_typing = 0;
   public $has_unread_messages = 0;
   public $last_user_msg_time = 0;
   public $last_msg_id = 0;
   public $mail_send = 0;
   public $lat = 0;
   public $lon = 0;
   public $city = '';
   public $additional_data = '';
   public $session_referrer = '';
   public $wait_time = 0;
   public $chat_duration = 0;
   public $priority = 0;
   public $online_user_id = 0;
   public $lsync = 0;

   // Transfer attributes
   public $transfer_if_na = 0;
   public $transfer_timeout_ts = 0;
   public $transfer_timeout_ac = 0;
   public $transfer_uid = 0;

   // Time then chac became pending
   public $pnd_time = 0;

   // Time then chat was closed
   public $cls_time = 0;

   public $auto_responder_id = 0;
   
   // User timezone identifier
   public $user_tz_identifier = '';

   // Unanswered chat callback executed
   public $na_cb_executed = 0;
   
   // New chat callback executed
   public $nc_cb_executed = 0;

   // Feedback status
   public $fbst = 0;
   
   // What operator is typing now.
   public $operator_typing_id = 0;

   public $chat_initiator = self::CHAT_INITIATOR_DEFAULT;
   public $chat_variables = '';
   
   public $remarks = '';
   
   // Pending operations from user side
   public $operation = '';
   
   public $operation_admin = '';
   
   public $screenshot_id = 0;
   
   public $unread_messages_informed = 0;
   
   public $reinform_timeout = 0;
   
   // Last operator message time
   public $last_op_msg_time = 0;
   
   // Does chat has unread messages from operator
   public $has_unread_op_messages = 0; 
   
   // Was visitor informed about unread message
   public $unread_op_messages_informed = 0;
   
   // Time when user closed a chat window
   public $user_closed_ts = 0;
   
   public $unanswered_chat = 0;
   
   public $product_id = 0;
   
   public $usaccept = self::OP_STATUS_ACCEPT_ONLINE;
   
   public $status_sub_arg = '';
   
   // Time since last assignment
   public $tslasign = 0;
   
   public $chat_locale = '';
   
   public $chat_locale_to = '';
   
   public $uagent = '';

   public $anonymized = 0;

   public $invitation_id = 0;

   // 0 - PC, 1 - mobile, 2 - tablet
   public $device_type = 0;

   // Bot ID assigned to the chat
   public $gbot_id = 0;

   // Theme ID
   public $theme_id = 0;

   // User status on close event

   // 0 - online
   // 1 - offline
   public $cls_us = 0;

   public $iwh_id = 0;
   public $frt = 0;
   public $aart = 0;
   public $mart = 0;

   public $updateIgnoreColumns = array();
}

?>