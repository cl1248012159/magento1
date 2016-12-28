<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('webhome/hometag')}` (
      `id` int(11) NOT NULL auto_increment,
      `channel_id` int(4),
      `main_title`  varchar(255),
      `contents`  text,
      `status` int(2),
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");



$installer->endSetup();