<?php

namespace app\models\Creatiff;
use yii\base\Exception;

/**
 * Delivered Company Model
 * Class Company
 * @package app\models\Creatiff
 */
class Company extends \yii\base\Model
{
    public $id;
    public $name;
    public $dataSource;

    const DATA_SOURCE_LOCAL_PRICE = 0;
    const DATA_SOURCE_API = 1;

    /**
     * @param null $id
     * @param null $name
     * @param int $dataSource
     */
    public function __construct($id = null, $name = null, $dataSource = self::DATA_SOURCE_LOCAL_PRICE)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dataSource = $dataSource;
    }

    /**
     * @return array
     */
    public function getAllCompanies()
    {
        return [
            new Company(1, 'Google', self::DATA_SOURCE_LOCAL_PRICE),
            new Company(2, 'P&G', self::DATA_SOURCE_API),
            new Company(3, 'ZAZ', self::DATA_SOURCE_LOCAL_PRICE),
            new Company(4, 'Yahoo', self::DATA_SOURCE_LOCAL_PRICE),
            new Company(5, 'Creatiff', self::DATA_SOURCE_API),

        ];
    }

    /**
     * @param Package $package
     * @return array|mixed
     * @throws \yii\base\Exception
     */
    public function getPriceList(\app\models\Creatiff\Package $package)
    {
        switch($this->dataSource) {
            case self::DATA_SOURCE_LOCAL_PRICE:
                return (new DeliveryPrice())->getPriceListByCompanyId($this->id);

            case self::DATA_SOURCE_API:
                // we could get any results here e.g. timeout error etc.
                try {
                    $api = (new Api())
                        ->setPackage($package)
                        ->setCompany($this);

                    return $api->getPriceList();

                } catch (Exception $e) {
                    throw new Exception ('Something wrong with API. Try again later.');
                }
        }
    }
}
