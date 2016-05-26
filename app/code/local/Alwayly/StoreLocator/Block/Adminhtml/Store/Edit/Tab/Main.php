<?php
class Alwayly_StoreLocator_Block_Adminhtml_Store_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $model = Mage::registry('current_edit_store');

        $form = new Varien_Data_Form();

        $prifix = 'store_main_';
        $form->setHtmlIdPrefix($prifix);
//        directory
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('storelocator')->__('Store Base Info')
        ));

        $chinaProvinces = Mage::getModel('directory/region')
            ->getResourceCollection()
            ->addFieldToFilter('country_id','CN');
        $provinces = array();
        $provinces[''] = $this->__('请选择省');//$this->__('Please select province')
        foreach($chinaProvinces as $province){
            $provinces[$province->getCode()] = $province->getDefaultName();
        }
        if($chinaProvinces->getSize() > 0){

            $fieldset->addField('region_name', 'hidden', array(
                'name'     => 'region_name',
            ));
            $fieldset->addField('region_code', 'select', array(
                'name'     => 'region_code',
                'label'    => Mage::helper('storelocator')->__('Province Name'),
                'title'    => Mage::helper('storelocator')->__('Province Name'),
                'options'  => $provinces,
                'required' => true,
            ));
            $form->getElement('region_code')->setAfterElementHtml(
                '<script type="text/javascript">
                window.onload = function(){
                    var region_code = document.getElementById("'.$prifix.'region_code");
                    var region_name = document.getElementById("'.$prifix.'region_name");

                    var options = region_code.getElementsByTagName("option");
                    var region_names = new Array();
                    for(var i=0;i<options.length;i++){
                        region_names[options[i].value] = options[i].innerText;
                    }

                    region_code.onchange = function(){
                        var code = this.value;
                        region_name.value = region_names[code];
                    }
                }
            </script>'
            );

        }else{
            $fieldset->addField('region_name', 'text', array(
                'name'     => 'region_name',
                'label'    => Mage::helper('storelocator')->__('Region Name'),
                'title'    => Mage::helper('storelocator')->__('Region Name'),
                'required' => true,
            ));
        }

        $fieldset->addField('city_name', 'text', array(
            'name'     => 'city_name',
            'label'    => Mage::helper('storelocator')->__('City Name'),
            'title'    => Mage::helper('storelocator')->__('City Name'),
            'required' => true,
        ));

        $fieldset->addField('counter', 'text', array(
            'name'     => 'counter',
            'label'    => Mage::helper('storelocator')->__('Store'),
            'title'    => Mage::helper('storelocator')->__('Store'),
            'required' => true,
        ));

        $fieldset->addField('counter_address', 'editor', array(
            'name'     => 'counter_address',
            'style'    => 'height:7em;',
            'label'    => Mage::helper('storelocator')->__('Address'),
            'title'    => Mage::helper('storelocator')->__('Address'),
            'required' => true,
        ));
        $fieldset->addField('longitude', 'text', array(
            'name'     => 'longitude',
            'label'    => Mage::helper('storelocator')->__('Longitude'),
            'title'    => Mage::helper('storelocator')->__('Longitude'),
            'required' => true,
        ));
        $fieldset->addField('latitude', 'text', array(
            'name'     => 'latitude',
            'label'    => Mage::helper('storelocator')->__('Latitude'),
            'title'    => Mage::helper('storelocator')->__('Latitude'),
            'required' => true,
        ));


        $fieldset->addField('tel', 'text', array(
            'name'     => 'tel',
            'label'    => Mage::helper('storelocator')->__('Telephone'),
            'title'    => Mage::helper('storelocator')->__('Telephone'),
            'required' => true,
        ));

        $fieldset->addField('fax', 'editor', array(
            'name'     => 'fax',
            'style'    => 'height:7em;',
            'label'    => Mage::helper('storelocator')->__('Fax'),
            'title'    => Mage::helper('storelocator')->__('Fax'),
            'required' => false,
        ));

        $fieldset->addField('website', 'text', array(
            'name'     => 'website',
            'label'    => Mage::helper('storelocator')->__('Website'),
            'title'    => Mage::helper('storelocator')->__('Website'),
            'required' => false,
        ));





        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('storelocator')->__('Store Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('storelocator')->__('Store Info');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}