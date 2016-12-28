<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('webhome/pcmenu')}` (
      `id` int(11) NOT NULL auto_increment,
      `channel` int(4),
      `title`  varchar(255),
      `link`  varchar(255),
      `style` varchar(255),
      `image` varchar(255),
      `image_link` varchar(255),
      `image_style` varchar(255),
      `image2` varchar(255),
      `image2_link` varchar(255),
      `image2_style` varchar(255),
      `description` varchar(255),
      `description_link` varchar(255),
      `description_style` varchar(255),
      `info` varchar(255),
      `position` int(4),
      `parentid` int(11),
      `status` int(2),
      `products_category_id` int(11),
      `menu_type` int(4),
      PRIMARY KEY  (`id`)
      
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

//CONSTRAINT `FK_pc_menu` FOREIGN KEY (`parentid`) REFERENCES {$installer->getTable('pcmenu')} (`id`) ON DELETE CASCADE ON UPDATE CASCADE

$installer->endSetup();