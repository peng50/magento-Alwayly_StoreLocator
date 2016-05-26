<?php

class Alwayly_StoreLocator_Model_Resource_Store extends Mage_Core_Model_Resource_Db_Abstract{

    public function _construct(){

        $this->_init('storelocator/store', 'locator_id');
    }
}