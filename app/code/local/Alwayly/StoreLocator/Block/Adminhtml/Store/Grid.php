<?php
class Alwayly_StoreLocator_Block_Adminhtml_Store_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(){
        parent::__construct();
        $this->setId('storesGrid');
        $this->setDefaultSort('locator_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('storelocator/store')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('locator_id', array(
            'header'    => Mage::helper('storelocator')->__('ID'),
            'index'     => 'locator_id',
        ));

        $this->addColumn('region_name', array(
            'header'    => Mage::helper('storelocator')->__('Province Name'),
            'index'     => 'region_name',
        ));

        $this->addColumn('city_name', array(
            'header'    => Mage::helper('storelocator')->__('City Name'),
            'index'     => 'city_name',
        ));

        $this->addColumn('counter', array(
            'header'    => Mage::helper('storelocator')->__('Counter Name'),
            'index'     => 'counter',
        ));

        $this->addColumn('tel', array(
            'header'    => Mage::helper('storelocator')->__('Telephone'),
            'index'     => 'tel',
        ));

        $this->addColumn('counter_address', array(
            'header'    => Mage::helper('storelocator')->__('Address'),
            'index'     => 'counter_address',
        ));

//        $this->addColumn(
//            'action',
//            array(
//                'header'    => Mage::helper('storelocator')->__('Action'),
//                'width'     => '100',
//                'type'      => 'action',
//                'actions'   => array(
//                    array(
//                        'caption' => Mage::helper('storelocator')->__('Edit'),
//                        'url'     => array(
//                            'base'  => '*/*/edit',
//                            'params'=>$this->getRequest()->getParam('locator_id')
//                        ),
//                        'field'   => 'id',
//                    )
//                ),
//                'filter'    => false,
//                'sortable'  => false,
//                'is_system' => true,
//            )
//        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('locator_id');
        $this->getMassactionBlock()->setFormFieldName('store_ids');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'   => Mage::helper('storelocator')->__('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('storelocator')->__('Are you sure?'),
            )
        );
        return $this;
    }


    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
