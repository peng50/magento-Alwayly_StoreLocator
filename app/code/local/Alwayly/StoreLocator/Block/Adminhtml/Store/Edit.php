<?php
class Alwayly_StoreLocator_Block_Adminhtml_Store_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_store';

        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Save Store'));
        $this->_updateButton('delete', 'label', Mage::helper('storelocator')->__('Delete Store'));
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );

        $this->_formScripts[]
            = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('current_edit_store') && Mage::registry('current_edit_store')->getId()) {
            return Mage::helper('adminhtml')->__(
                "Edit Store '%s'", $this->escapeHtml(Mage::registry('current_edit_store')->getCounter())
            );
        } else {
            return Mage::helper('adminhtml')->__('Add Store');
        }
    }
}