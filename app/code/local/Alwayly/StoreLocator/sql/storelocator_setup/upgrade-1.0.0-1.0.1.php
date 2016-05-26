<?php

$installer = $this;
$installer->startSetup();
//insert province data

$chinaProvinces = Mage::getModel('directory/region')
    ->getResourceCollection()
    ->addFieldToFilter('country_id','CN');
if(!$chinaProvinces->getSize()){
    $installer->run("
INSERT INTO `{$this->getTable('directory/country_region')}` (`country_id`,`code`, `default_name`) VALUES
('CN', 'CN_01', '北京'),
('CN', 'CN_02', '上海'),
('CN', 'CN_03', '天津'),
('CN', 'CN_04', '重庆'),
('CN', 'CN_05', '内蒙'),
('CN', 'CN_06', '河北'),
('CN', 'CN_07', '辽宁'),
('CN', 'CN_08', '吉林'),
('CN', 'CN_09', '黑龙江'),
('CN', 'CN_10', '江苏'),
('CN', 'CN_11', '安徽'),
('CN', 'CN_12', '山东'),
('CN', 'CN_13', '浙江'),
('CN', 'CN_14', '江西'),
('CN', 'CN_15', '福建'),
('CN', 'CN_16', '湖南'),
('CN', 'CN_17', '湖北'),
('CN', 'CN_18', '河南'),
('CN', 'CN_19', '广东'),
('CN', 'CN_20', '广西'),
('CN', 'CN_21', '贵州'),
('CN', 'CN_22', '四川'),
('CN', 'CN_23', '云南'),
('CN', 'CN_24', '陕西'),
('CN', 'CN_25', '甘肃'),
('CN', 'CN_26', '宁夏'),
('CN', 'CN_27', '青海'),
('CN', 'CN_28', '新疆'),
('CN', 'CN_29', '西藏'),
('CN', 'CN_30', '海南'),
('CN', 'CN_31', '山西');
");
}

$installer->endSetup();