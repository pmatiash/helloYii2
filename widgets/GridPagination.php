<?php
namespace app\widgets;

use yii\base\Exception;
use yii\data\Pagination;

class GridPagination extends \yii\base\Widget
{
    public $pagination;

    public function __construct(Pagination $pagination)
    {
        parent::__construct();

        $this->pagination = $pagination;

        if (!$this->pagination instanceof Pagination) {
            throw new Exception ('Wrong Pagination class was set');
        }
    }


    public function __toString()
    {
        $output = '<ul class="pagination">';

        foreach ($this->pagination->getLinks() as $text => $link) {
            $output .= sprintf('<li><a href="%s"><span>%s</span></a></li>', $link, $text);
        }

        $output .= '</ul>';
        return $output;
    }
}