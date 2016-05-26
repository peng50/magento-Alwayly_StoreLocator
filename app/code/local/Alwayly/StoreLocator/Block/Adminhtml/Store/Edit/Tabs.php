<?php
class Alwayly_StoreLocator_Block_Adminhtml_Store_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs{
    public function __construct()
    {
        parent::__construct();
        $this->setId('store_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('storelocator')->__('Store Information'));
    }
}