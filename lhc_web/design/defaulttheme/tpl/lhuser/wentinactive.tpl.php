<?php $modalHeaderTitle = erTranslationClassLhTranslation::getInstance()->getTranslation('user/wentinactive','Offline'); ?>
<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_header.tpl.php'));?>

<p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/wentinactive','Because of inactivity you went offline, click continue to go online. Ctrl+F12 Shortcut.');?></p>

<button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/wentinactive','Continue');?></button>

<a class="btn btn-secondary btn-warning float-end" onclick="$(this).attr('href',$(this).attr('href')+'/(csfr)/'+confLH.csrf_token)" href="<?php echo erLhcoreClassDesign::baseurl('user/logout')?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/wentinactive','Logout');?></a>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_footer.tpl.php'));?>