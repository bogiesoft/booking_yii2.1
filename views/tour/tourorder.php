<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

//$this->title = $tours->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo DetailView::widget([
        'model' => $tours,
        'attributes' => [
            'name:ntext',
            'adult_q',
            'child_q',
            'baby_q',
        ],
    ]); 
    ?>
    
    <?php
		foreach($tours->qfields as $qfiels){
			echo '<div class="row">
			<div class="col-sm-2">'.$qfiels['field_name'].'</div>
			<div class="col-sm-10">'.$qfiels['field_data'].'</div><br><br></div>';
		}
		echo '<br>';
	?>
    
    <?php $form = ActiveForm::begin(); ?>
    
	<?= $form->field($model, 'date_tour')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Enter Booking date ...'],
		'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy/mm/dd'
    ]
	]); ?>
	
	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Order' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
