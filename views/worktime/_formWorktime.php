<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use yii\helpers\VarDumper;

/**
 *
 * @var yii\web\View $this
 * @var istt\sms\models\Worktime $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="worktime-form">

    <?php $form = ActiveForm::begin(); ?>

	 <div class="row">
		<div class="col-sm-6">

			<?= $form->field($model, 'start')
				->widget(TimePicker::className()) ?>

		</div>
		<div class="col-sm-6">

	    	<?= $form->field($model, 'end')->widget(TimePicker::className())?>

		</div>
	</div>

	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php VarDumper::dump($model, 10, true)?>