<?php

class Alwayly_StoreLocator_Block_Store extends Mage_Core_Block_Template{

    public function getStores(){

        $collection = Mage::getModel('storelocator/store')->getCollection()
                        ->setOrder('`main_table`.region_code', 'desc');

//        echo $collection->getSelect()->__toString();
        $info = array();
        foreach($collection as $_item)

            if(!isset($info[$_item->getData('region_code')])) {
                $info[$_item->getData('region_code')] = array("region_name" => $_item->getData('region_name'));
                $info[$_item->getData('region_code')]['cities'] = array();
            }

        foreach($info as $code=>$val)

            foreach($collection as $_item)

                if($code==$_item->getRegionCode() && !isset($info[$code][$_item->getCityName()]))
                    $info[$code]['cities'][$_item->getCityName()] = array();

        $data = $collection->getData();
        foreach($info as $code=>$_region) {

            foreach ($_region["cities"] as $key => $val) {

                foreach ($data as &$_item) {

                    if ($code == $_item['region_code'] && $key == $_item['city_name']) {

                        unset($_item['locator_id'], $_item['region_code'] ,$_item['region_name'], $_item['city_name']);
                        $info[$code]['cities'][$key][] = $_item;
                        unset($_item);
                    }
                }
            }
        }

        return Mage::helper('core')->jsonEncode($info);
    }

}