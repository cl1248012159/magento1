<?php
class WCC_Webhome_Block_Adminhtml_Webhome_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('webhomeGrids');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('Desc');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getModel('webhome/webhome')
            ->getCollection()
            ->addFieldToFilter('is_active',1)
            ->addFieldToFilter('reserved_order_id',array(
                                                        array('notnull' => true),
                                                        )
                                                );
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('entity_id',
            array(
                'header'=> $this->__('entity_id'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'entity_id'
            )
        );
        $this->addColumn('reserved_order_id',
            array(
                'header'=> $this->__('Order #'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'reserved_order_id'
            )
        );
        $this->addColumn('created_at', array(
            'header' => Mage::helper('sales')->__('Purchased On'),
            'index' => 'created_at',
            'type' => 'datetime',
            'width' => '100px',
        ));
        $this->addColumn('customer_email',
            array(
                'header'=> $this->__('customer_email'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'customer_email'
            )
        );
        $this->addColumn('base_grand_total', array(
            'header' => $this->__('G.T. (Base)'),
            'index' => 'base_grand_total',
            'type'  => 'currency',
            'currency' => 'base_currency_code',
        ));
        $this->addColumn('grand_total', array(
            'header' => $this->__('G.T. (Purchased)'),
            'index' => 'grand_total',
            'type'  => 'currency',
            'currency' => 'order_currency_code',
        ));
        $this->addColumn('action',
            array(
                'header'    => $this->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => $this->__('View'),
                        'url'     => array('base'=>'*/webhome/edit'),
                        'field'   => 'entity_id',
                        'data-column' => 'action',
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getEntityId()));
    }
}