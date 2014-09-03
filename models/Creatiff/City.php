<?php

namespace app\models\Creatiff;

/**
 * Class City
 * @package app\models\Creatiff
 */
class City extends \yii\base\Model
{
    public $id;
    public $name;

    /**
     * @param null $id
     * @param null $name
     */
    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return[
            1 => 'New York',
            2 => 'Kiev',
            3 => 'Poltava',
            4 => 'Berlin',
            5 => 'Paris'
        ];
    }
}