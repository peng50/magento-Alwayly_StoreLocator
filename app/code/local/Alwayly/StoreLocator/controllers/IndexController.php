<?php

class Alwayly_StoreLocator_IndexController extends Mage_Core_Controller_Front_Action{

    public function indexAction(){
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle('店铺查询');
        $this->renderLayout();
    }
}