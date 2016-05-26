<?php

$installer = $this;

$installer->startSetup();

$installer->run("

    DROP TABLE IF EXISTS `{$this->getTable('storelocator/store')}`;

    CREATE TABLE `{$this->getTable('storelocator/store')}` (
      `locator_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `region_code` varchar(100) NOT NULL COMMENT 'Region/Province code',
      `region_name` varchar(100) NOT NULL COMMENT 'Region/Province name',
      `city_name` varchar(100) NOT NULL COMMENT 'City Name',
      `counter` varchar(300) NOT NULL,
      `tel` varchar(100) NOT NULL COMMENT 'Telephone Number',
      `counter_address` varchar(300) NOT NULL,
      `fax` varchar(50) DEFAULT NULL,
      `website` varchar(300) DEFAULT NULL,
      `hours` varchar(300) DEFAULT NULL,
      `longitude` varchar(30) NOT NULL,
      `latitude` varchar(30) NOT NULL,
      PRIMARY KEY (`locator_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();