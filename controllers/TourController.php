<?php

namespace app\controllers;

use Yii;
use app\models\Tour;
use app\models\User;
use app\models\Qfield;
use app\models\Booking;
use app\models\TourSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionThanks()
    {
        return $this->render('thanks');
    }
	
	public function actionTours()
    {
		$modelTour = new Tour;
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tours', [
			'model' => $modelTour,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionTourorder($id)
    {
		$model = new Booking();
		$model->id_user=Yii::$app->user->getId();
		$model->id_tour=$id;
        $tours=Tour::find()->with('qfields')->where(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['thanks']);
        } else {
            return $this->render('tourorder', [
            'tours' => $tours,
			'model' => $model,
        	]);
        }
    }
    
    public function actionBookings(){
        
        $dataProvider = new ActiveDataProvider([
            'query' => Booking::find()->with('tours'),
        ]);
        return $this->render('bookings', ['dataProvider'=>$dataProvider]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelTour = new Tour;
        $modelsQfield = [new Qfield];

        if ($modelTour->loadAll(Yii::$app->request->post()) && $modelTour->saveAll()) {
            return $this->redirect(['view', 'id' => $modelTour->id]);
        } else {
            return $this->render('create', [
                'modelTour' => $modelTour,
                'modelsQfield' => $modelsQfield
            ]);
        }
    }

    /**
     * Updates an existing Tour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelTour = $this->findModel($id);
    	$modelsQfield = $modelTour->qfields;

        if ($modelTour->loadAll(Yii::$app->request->post()) && $modelTour->saveAll()) {
            return $this->redirect(['view', 'id' => $modelTour->id]);
        } else {
            return $this->render('update', [
                'modelTour' => $modelTour,
                'modelsQfield' => (empty($modelsQfield)) ? [new Qfield] : $modelsQfield
            ]);
        }
    }

    /**
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {        
        try
        {
            $this->findModel($id)->delete();
            $this->redirect(array('index'));
        }
        catch(Exception $e)
        {
            Yii::$app->user->setFlash('error','DB Error');
        }
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}