ALTER TABLE `lh_chat_online_user` ADD `chat_time` bigint(20) unsigned NOT NULL DEFAULT '0', COMMENT='';
ALTER TABLE `lh_chat_online_user` ADD `last_visit_prev` bigint(20) unsigned NOT NULL DEFAULT '0', COMMENT='';