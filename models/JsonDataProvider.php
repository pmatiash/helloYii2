<?php
namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * Singleton JsonDataProvider
 */
class JsonDataProvider
{
    const DIR_DATA = '/data';

    private static  $_items;

    /**
     * Getting data from json file
     * @return mixed
     * @throws \yii\base\Exception
     */
    public static function getArrayFromJson()
    {
        if (!self::$_items) {
            self::$_items = json_decode(file_get_contents(Yii::getAlias('@app') . self::DIR_DATA . '/JSON.json'), true);

            if (!self::$_items) {
                throw new Exception ('No data');
            }
        }

        return self::$_items;
    }

    /**
     * @return array
     */
    public static function getSortAttributes()
    {
        return [
            'id' => [
                'asc' => ['id' => SORT_ASC],
                'desc' => ['id' => SORT_DESC],
                'default' => SORT_ASC,
                'label' => 'Id',
            ],
            'guid' => [
                'asc' => ['guid' => SORT_ASC],
                'desc' => ['guid' => SORT_DESC],
                'default' => SORT_ASC,
                'label' => 'Guid',
            ],
            'isActive' => [
                'asc' => ['isActive' => SORT_ASC],
                'desc' => ['isActive' => SORT_DESC],
                'default' => SORT_ASC,
                'label' => 'Active',
            ],
            'balance' => [
                'asc' => ['balance' => SORT_ASC],
                'desc' => ['balance' => SORT_DESC],
                'default' => SORT_ASC,
                'label' => 'Balance',
            ],
            'age' => [
                'asc' => ['age' => SORT_ASC],
                'desc' => ['age' => SORT_DESC],
                'default' => SORT_ASC,
                'label' => 'age',
            ],

        ];
    }

}