<div class="row">
    <div class=" col-md-4">
        <?php echo new \app\widgets\GridPagination($pagination); ?>
    </div>

    <label class="col-md-2 mg20">Items Per Page:</label>
    <div class="col-md-2 mg20">
        <select id="itemsPerPage" class="form-control">
            <?php foreach ($pageSizeRange as $pageSize):?>
                <option <?= $pageSize == $pagination->getPageSize() ? 'selected="selected"' : "" ?>><?= $pageSize; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="table table-condensed">
    <div class="row">
        <?php foreach ($gridHeader as $columnHeader) :
            $width = $columnHeader == 'about' ? 4 : 1;
            echo "<div class='table-bordered col-md-$width bold text-center'>";
            echo $sort->hasAttribute($columnHeader) ? $sort->link($columnHeader) : $columnHeader;
            echo "</div>";
        endforeach; ?>
    </div>

    <?php foreach ($gridBody as $model) : ?>

    <div class="row">

        <?php foreach ($model as $field => $value) :

            $width = $field == 'about' ? 4 : 1;

            if (is_array($value)):

                echo "<div class='table-bordered col-md-$width  $field'><dl>";

                array_walk_recursive($value, function($val) {
                    echo '<dd>' . $val . '</dd>';
                });

                echo '</dl></div>';

            else:
                echo  "<div class='table-bordered col-md-$width $field'>$value</div>";
            endif;

        endforeach;

        echo '</div><div class="clearfix"></div>';

        endforeach; ?>

    </div>

<?php echo new \app\widgets\GridPagination($pagination); ?>


<?php $this->registerJs("
    $('#itemsPerPage').on('change', function(){
        var perPage = $(this).val();
        $.get('\\darrowtest', {'per-page': perPage}, function(response) {
            $('#darrowtest').html(response);
        });
    });

", \yii\web\View::POS_END); ?>