<?php

namespace app\models\Creatiff;

/**
 * Class Api
 * Getting data from remote host
 * @package app\models\Creatiff
 */
class Api
{
    // need for estimation
    private $_package;

    private $_company;

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
     * @param Package $package
     * @return $this
     */
    public function setPackage(Package $package)
    {
        $this->_package = $package;

        return $this;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function setCompany(Company $company)
    {
        $this->_company = $company;

        return $this;
    }


    /**
     * @return array
     */
    public function getPriceList()
    {
        return $this->_presets[$this->_company->id];
    }
}