<?php

$Module = array( "name" => "System configuration");

$ViewList = array();

$ViewList['htmlcode'] = array(
    'params' => array(),
    'functions' => array( 'generatejs' )
);

$ViewList['htmlcodebeta'] = array(
    'params' => array(),
    'functions' => array( 'generatejs' )
);

$ViewList['embedcode'] = array(
    'params' => array(),
    'functions' => array( 'generatejs' )
);

$ViewList['configuration'] = array(
    'params' => array(),
    'functions' => array( 'use' )
);

$ViewList['offlinesettings'] = array(
    'params' => array(),
    'functions' => array( 'offlinesettings' )
);

$ViewList['usersactions'] = array(
    'params' => array(),
    'functions' => array( 'usersactions' )
);

$ViewList['expirecache'] = array(
    'params' => array(),
    'functions' => array( 'expirecache' ),
    'uparams' => array('csfr')
);

$ViewList['smtp'] = array(
    'params' => array(),
    'functions' => array( 'configuresmtp' )
);

$ViewList['recaptcha'] = array(
    'params' => array(),
    'functions' => array( 'configurerecaptcha' )
);

$ViewList['timezone'] = array(
    'params' => array(),
    'functions' => array( 'timezone' )
);

$ViewList['languages'] = array(
    'params' => array(),
    'uparams' => array('updated','sa'),
    'functions' => array( 'changelanguage' )
);

$ViewList['update'] = array(
    'params' => array(),
    'uparams' => array('action','scope'),
    'functions' => array( 'performupdate' )
);

$ViewList['ga'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array( 'ga_configuration' )
);

$ViewList['transferconfiguration'] = array(
    'params' => array(),
    'uparams' => array('action'),
    'functions' => array( 'transferconfiguration' )
);

$ViewList['autodbupdate'] = array(
    'params' => array('hash'),
    'uparams' => array()
);

$ViewList['singlesetting'] = array(
    'params' => array('identifier'),
    'uparams' => array(),
    'functions' => array( 'singlesetting' )
);

$ViewList['bbcode'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array( 'messagecontentprotection' )
);

$ViewList['notice'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array( 'notice' )
);

$ViewList['confirmdialog'] = array(
    'params' => array(),
    'uparams' => array()
);

$FunctionList['use'] = array('explain' => 'Allow user to see configuration links');
$FunctionList['expirecache'] = array('explain' => 'Allow user to clear cache');
$FunctionList['generatejs'] = array('explain' => 'Allow user to access HTML generation');
$FunctionList['configuresmtp'] = array('explain' => 'Allow user to configure SMTP');
$FunctionList['configurelanguages'] = array('explain' => 'Allow user to configure languages');
$FunctionList['changelanguage'] = array('explain' => 'Allow user to change their languages');
$FunctionList['timezone'] = array('explain' => 'Allow user to change global time zone');
$FunctionList['performupdate'] = array('explain' => 'Allow user to update Live Helper Chat');
$FunctionList['changetemplates'] = array('explain' => 'Allow user to change e-mail templates');
$FunctionList['generate_js_tab'] = array('explain' => 'User can see embed code tab');
$FunctionList['transferconfiguration'] = array('explain' => 'User can configure transfer options');
$FunctionList['offlinesettings'] = array('explain' => 'Allow user to change offline settings');
$FunctionList['configurerecaptcha'] = array('explain' => 'Allow user to configure recaptcha');
$FunctionList['auditlog'] = array('explain' => 'Allow user to see audit log');
$FunctionList['usersactions'] = array('explain' => 'Allow user to see operators real time chats statistic');
$FunctionList['ga_configuration'] = array('explain' => 'Allow user to configure Events Tracking');
$FunctionList['singlesetting'] = array('explain' => 'Allow user to change app settings');
$FunctionList['messagecontentprotection'] = array('explain' => 'Allow user to configure message content protection');
$FunctionList['notice'] = array('explain' => 'Allow operator to configure static notice message');

?>