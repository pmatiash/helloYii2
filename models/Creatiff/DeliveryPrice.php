<?php

namespace app\models\Creatiff;

/**
 * Locale price, getting from db storage
 * Class DeliveryPrice
 * @package app\models\Creatiff
 */
class DeliveryPrice extends \yii\base\Model
{
    private $_presets = [
        1 => [
            'id' => 1,
            'name' => 'Google',
            'time' => 2,
            'price' => 300
        ],
        2 => [
            'id' => 2,
            'name' => 'P&G',
            'time' => 3,
            'price' => 200
        ],
        3 => [
            'id' => 2,
            'name' => 'ZAZ',
            'time' => 1,
            'price' => 500
        ],
        4 => [
            'id' => 2,
            'name' => 'UPS',
            'time' => 4,
            'price' => 300
        ],
        5 => [
            'id' => 2,
            'name' => 'Creatiff',
            'time' => 3,
            'price' => 250
        ],
    ];

    /**
     * @param $id
     * @return mixed
     */
    public function getPriceListByCompanyId($id)
    {
        return $this->_presets[$id];
    }
}