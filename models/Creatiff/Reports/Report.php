<?php

namespace app\models\Creatiff\Reports;

class Report extends \app\models\Creatiff\AbstractReport
{
    private $_package;

    public function setPackage(\app\models\Creatiff\Package $package)
    {
        $this->_package = $package;

        return $this;
    }

    public function __toString()
    {
        $html = "<div>";

        $companies = (new \app\models\Creatiff\Company())->getAllCompanies();

        if (!$companies) {
            return "";
        }

        foreach ($companies as $company) {
            $html .= "<div class='row'>";
            $html .= "Компания " .$company->name ." ";
            $html .= $company->getPriceList($this->_package)['time'] . " дня, ";
            $html .= $company->getPriceList($this->_package)['price'] . " долларов";
            $html .= "</div>";
        }

        $html .= "</div>";

        return $html;
    }
}