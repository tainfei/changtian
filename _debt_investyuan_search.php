<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


?>

<?php $form = ActiveForm::begin([
    'action' => ['investment-record'],
    'method' => 'get',
    'id'=>'form_id',
]);
?>
<div class="row">
    <div class="col-lg-2">
        <?php echo $form->field($searchModel, 'status')->label('投资状态:')->dropDownList([1=>'撮合成功',2=>'变现中',3=>'变现成功',4=>'变现失败',5=>'待撮合']);?>
    </div>
    <input type="hidden" name = 'ui_id' value ="<?php echo $ui_id; ?>">
    <input type="hidden" name = 'type' value ="1">
    <input type="hidden" name="db" value='hlc'>
    <div class="col-lg-2" >
        <?= Html::submitButton('查询  ', ['class' => 'btn btn-success gridview','id'=>'submit_btn','style'=>'margin-top:23px']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>