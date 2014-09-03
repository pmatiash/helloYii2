<div id="cntCreatiff">
    <form id="frmDeliveryOrder" class="calc-form" role="form" action="\site\deliveryestimate">
        <div class="form-group">
            <label>From</label>
            <select class="form-control" name="from">
                <?php foreach ($cities as $cityId => $cityName): ?>
                    <option value="<?=$cityId?>"><?=$cityName?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>To</label>
            <select class="form-control" name="to">
                <?php foreach ($cities as $cityId => $cityName): ?>
                    <option value="<?=$cityId?>"><?=$cityName?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Dimensions (L x W x H)</label>
            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="length" class="form-control" placeholder="Length"/>
                </div>

                <div class="col-md-4">
                    <input type="text" name="width" class="form-control" placeholder="Width"/>
                </div>

                <div class="col-md-4">
                    <input type="text" name="height" class="form-control" placeholder="Height"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Price</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="price" placeholder="Price" class="form-control" />
                </div>
            </div>
        </div>

        <div class="form-group text-right">
            <a id="btnDeliverySubmit" class="btn btn-primary">Estimate</a>
        </div>
    </form>

    <div id="deliveryReport" style="display: none;"></div>
    <a id="btnDeliveryTryAgain" class="btn btn-primary" style="display: none;">Try again</a>
</div>

<?php $this->registerJs("
        $('#btnDeliverySubmit').click(function() {
            var form = $(this).closest('form');
            $.post(form.attr('action'), form.serialize(), function(response) {
                form.hide();
                $('#deliveryReport').html(response).show();
                $('#btnDeliveryTryAgain').show();
            });
        });

        $('#btnDeliveryTryAgain').click(function() {
            $('#deliveryReport').hide();
            $(this).hide();
            $('#frmDeliveryOrder').show();

        });
", \yii\web\View::POS_END); ?>