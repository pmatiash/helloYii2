<?php
namespace app\widgets;

class GridData extends \yii\base\Widget
{
    public $dataProvider;

    private $_pageSizeRange = [5, 10];

    public function run()
    {
        return $this->render('gridData', [
            'gridHeader' => array_keys(current($this->dataProvider->getModels())),
            'gridBody' => $this->dataProvider->getModels(),
            'pagination' => $this->dataProvider->getPagination(),
            'pageSizeRange' => $this->_pageSizeRange,
            'sort' => $this->dataProvider->getSort()
        ]);
    }

}