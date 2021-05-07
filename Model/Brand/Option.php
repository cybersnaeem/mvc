<?php

namespace Model\Brand;

use Mage;

Mage::getModel('Model\Attribute\Option');

class Option extends \Model\Attribute\Option
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOption()
    {
        if (!$this->getAttribute()->attributeId) {
            return false;
        }

        $query = "SELECT
            `brandId` AS `optionId`,
            `name` AS `name`,
            '{$this->getAttribute()->attributeId}' AS `attributeId`,
            sortOrder
        FROM `brand`
        ORDER BY `sortOrder` ASC";

        $options = Mage::getModel('Model\Brand')->fetchAll($query);

        if (!$options) {
            return null;
        }

        return $options;
    }
}
