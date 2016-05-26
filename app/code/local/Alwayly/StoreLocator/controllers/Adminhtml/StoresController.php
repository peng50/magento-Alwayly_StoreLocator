<?php
class Alwayly_StoreLocator_Adminhtml_StoresController extends
    Mage_Adminhtml_Controller_Action
{
    protected function _initAction(){
        $this->loadLayout()
            ->_setActiveMenu('store/manage')
            ->_addBreadcrumb(
                Mage::helper('storelocator')->__('Store'),
                Mage::helper('storelocator')->__('Store')
            )
            ->_addBreadcrumb(
                Mage::helper('storelocator')->__('Manage Store'),
                Mage::helper('storelocator')->__('Manage Store')
            )
        ;
        return $this;
    }

    public function indexAction(){
        $this->_initAction()
            ->renderLayout();
    }

    public function gridAction(){
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('storelocator/adminhtml_store_grid')->toHtml()
        );
    }

    public function newAction(){
        $this->_forward('edit');
    }

    public function editAction(){

        // 1. instance store model
        $model = Mage::getModel('storelocator/store');

        $id = $this->getRequest()->getParam('id');
        // 2. if exists id, check it and load data
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('storelocator')->__('Store does not exist.')
                );
                return $this->_redirect('*/*/');
            }

            $this->_title($model->getCounter());
            $breadCrumb = Mage::helper('storelocator')->__('Edit Store');
        } else {
            $this->_title(Mage::helper('storelocator')->__('New Store'));
            $breadCrumb = Mage::helper('storelocator')->__('New Store');
        }
        // Init breadcrumbs
        $this->_initAction()->_addBreadcrumb($breadCrumb,$breadCrumb);

        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('current_edit_store', $model);

        // 5. render layout
        $this->renderLayout();
    }

    public function saveAction(){
        $redirectPath   = '*/*';
        $redirectParams = array();
        // check if data sent
        $data = $this->getRequest()->getPost();
        if($data){
            $model = Mage::getModel('storelocator/store');
            // if news item exists, try to load it
            $storeId = $this->getRequest()->getParam('id');
            if($storeId){
                $model->load($storeId);
            }

            $model->addData($data);

            try{
                $hasError = false;
                $model->save();
                $this->_getSession()->addSuccess(Mage::helper('storelocator')->__('The store has been saved'));

                if ($this->getRequest()->getParam('back')) {
                    $redirectPath   = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());
                }

            }catch (Exception $e){
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            }

            if ($hasError) {
                $this->_getSession()->setFormData($data);
                $redirectPath   = '*/*/edit';
                $redirectParams = array('id' => $this->getRequest()->getParam('id'));
            }

            $this->_redirect($redirectPath, $redirectParams);

        }
    }

    public function massDeleteAction(){
        if($this->getRequest()->isPost()){
            $ids = $this->getRequest()->getPost('store_ids');
            $fail = 0;
            $success = 0;
            foreach($ids as $id){
                try{
                    $store = Mage::getModel('storelocator/store')->load($id);
                    $store->delete();
                    $success++;
                }catch (Exception $e){
                    $fail++;
                }
            }
            if($fail){
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('storelocator')->__('store delete fail %d',$fail));
            }
            if($success){
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('storelocator')->__('store delete success %d',$success));
            }
        }
        $this->_redirect('*/*');
    }

    public function deleteAction(){
        $id = $this->getRequest()->getParam('id');
        try{
            $store = Mage::getModel('storelocator/store')->load($id);
            $store->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('storelocator')->__('this store have been delete'));
        }catch (Exception $e){
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('storelocator')->__('this store delete fail'));
        }

        $this->_redirect('*/*');
    }
}