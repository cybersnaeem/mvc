<?php
namespace Block\Core;

class Edit extends Template
{
	protected $tab = null;
	protected $tableRow = null;
    protected $tabClass = null;

	public function __CONSTRUCT()
    {
        parent::__construct();
        $this->setTemplate('./core/edit.php');
    }

	public function getTabContent()
    {
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();

        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if (!array_key_exists($tab,$tabs)) {
            return null;
        }
        $blockClassName = $tabs[$tab]['className'];
        $block = \Mage::getBlock($blockClassName)->setTableRow($this->getTableRow());
        echo $block->toHtml();
    }	

    public function getTabHtml()
    {
        return $this->getTab()->toHtml();
    }

    public function getTab()
    {
        if (!$this->tab) {
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTab($tab = null)
    {
        if (!$tab) {
            $tab = $this->getTabClass();
        }
        $tab->setTableRow($this->getTableRow());
        $this->tab = $tab;
        return $this;
    }

    public function getTableRow()
    {
    	return $this->tableRow;
    }

    public function setTableRow(\Model\Core\Table $tableRow)
    {
    	$this->tableRow = $tableRow;
    	return $this;
    }

    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }

    public function getTabClass()
    {
        return $this->tabClass;
    }

    public function setTabClass($tabClass = null)
    {
        $this->tabClass = $tabClass;
        return $this;
    }
}