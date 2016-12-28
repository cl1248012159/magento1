<?php
/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 15/11/5
 * Time: 下午2:13
 */

$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('webhome/webhome')}` (
      `id` int(11) NOT NULL auto_increment,
      `banner_id` int(4),
      `object_name`  varchar(255),
      `object_image_url`  varchar(255),
      `object_link_url`  varchar(255),
      `position` int(4),
      `status` int(2),
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->run("
    CREATE TABLE `{$installer->getTable('webhome/webhomebanner')}` (
      `id` int(11) NOT NULL auto_increment,
      `channel` int(4),
      `banner_name`  varchar(255),
      `banner_image_url` varchar(255),
      `banner_link_url`  varchar(255),
      `position` int(4),
      `status` int(2),
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");


$installer->endSetup();