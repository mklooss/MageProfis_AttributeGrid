<?php

class MageProfis_AttributeGrid_Block_Catalog_Product_Attribute_Grid extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Grid
{

    /**
     * Prepare product attributes grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Product_Attribute_Grid
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();

        $is_filterable = $this->getColumn('is_filterable');
        if ($is_filterable)
        {
            $info = array(
                'width' => '100px',
            );
            $is_filterable->addData($info);
        }
        $is_global = $this->getColumn('is_global');
        if ($is_global)
        {
            $info = array(
                'width' => '100px',
            );
            $is_global->addData($info);
        }

        $this->addColumnAfter('used_in_product_listing', array(
            'header'=>Mage::helper('catalog')->__('Used in Product Listing'),
            'sortable'=>true,
            'index'=>'used_in_product_listing',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
            'width' => '50px',
        ), 'is_comparable');

        $this->addColumnAfter('frontend_input', array(
            'header'=>Mage::helper('catalog')->__('Catalog Input Type for Store Owner'),
            'sortable'=>true,
            'index'=>'frontend_input',
            'type' => 'options',
            'options' => $this->getInputTypes(),
            'align' => 'left',
            'width' => '50px',
        ), 'frontend_label');

        $this->addColumnAfter('used_in_product_listing', array(
            'header'=>Mage::helper('catalog')->__('Used in Product Listing'),
            'sortable'=>true,
            'index'=>'used_in_product_listing',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
            'width' => '50px',
        ), 'is_comparable');
        
        $this->addColumn('action', array(
            'header' => Mage::helper('mpattributegrid')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('mpattributegrid')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'attribute_id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'is_system' => true,
        ));

        $this->sortColumnsByOrder();

        return $this;
    }

    /**
     * get Input Type Options
     * 
     * @return array
     */
    protected function getInputTypes()
    {
        $inputTypes = Mage::getModel('eav/adminhtml_system_config_source_inputtype')->toOptionArray();
        $additionalTypes = array(
            array(
                'value' => 'price',
                'label' => Mage::helper('catalog')->__('Price')
            ),
            array(
                'value' => 'media_image',
                'label' => Mage::helper('catalog')->__('Media Image')
            )
        );
        $additionalTypes[] = array(
            'value' => 'gallery',
            'label' => Mage::helper('catalog')->__('Gallery')
        );
        $result = array();
        foreach (array_merge($inputTypes, $additionalTypes) as $_item)
        {
            $result[$_item['value']] = $_item['label'];
        }
        return $result;
    }
}
