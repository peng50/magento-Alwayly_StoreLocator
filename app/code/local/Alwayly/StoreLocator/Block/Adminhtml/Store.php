<?php
class Alwayly_StoreLocator_Block_Adminhtml_Store extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct(){
        $this->_controller='adminhtml_store';
        $this->_blockGroup='storelocator';
        $this->_headerText = Mage::helper('storelocator')->__('Manager Stores');
        parent::__construct();
    }
}