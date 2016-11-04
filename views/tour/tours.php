<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tours');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="tour-tours">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php 
			if(Yii::$app->user->isGuest)
			{
				echo "<h3>Please Login to order the tour</h3>";
			}
		?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'adult_q',
            'child_q',
            'baby_q',

            ['class' => 'yii\grid\ActionColumn',
			'template'=>'{viewtour}',
    		'visible'=> Yii::$app->user->isGuest ? false : true,
			'buttons'=>[
                'viewtour'=>function ($url, $model) {
                    $customurl=Yii::$app->getUrlManager()->createUrl(['tour/tourorder','id'=>$model->id]); 
                    return \yii\helpers\Html::a( 'More', $customurl,
                        ['title' => Yii::t('yii', 'More'), 'data-pjax' => '0']);}
                        ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>