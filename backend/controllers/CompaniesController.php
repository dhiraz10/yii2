<?php

namespace backend\controllers;

use Yii;
use backend\models\companies;
use backend\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * CompaniesController implements the CRUD actions for companies model.
 */
class CompaniesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    //widget ko code ho:
    // public function actions()
    // {
    //     return [
    //         'uploadPhoto' => [
    //             'class' => 'budyaga\cropper\actions\UploadAction',
    //             'url' => 'http://localhost:8081/projectsss/backend/uploads/company_img',
    //             'path' => '@backend/uploads/company_img',
    //         ]
    //     ];
    // }
/**incase csrfvalidation lai disable garnu paryo vaney */
    // public function beforeAction($action){
    //     if($action->id=='uploadPhoto'){
    //         $this->enableCsrfValidation = false;
    //     }
    //     return parent::beforeAction($action);
    // }
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
     * Lists all companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single companies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new companies();

        if ($model->load(Yii::$app->request->post()) ) {
        //          echo '<pre>';
        //   print_r($model);
        //   die();
              $image = UploadedFile::getInstance($model, 'photo');
              $model->company_created=date('Y-m-d H:i:s');
              if(!empty($image)){
                $image_name= rand(1,4000).'.'.$image->extension;
                $model->logo = $image_name;
                $model->save();
                $image->saveAS('uploads/company_img/'.$image_name);
                
              }else{
                $model->save();
              }  
                                
            return $this->redirect(['view', 'id' => $model->company_id]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
          
        ]);
    }

    /**
     * Updates an existing companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        $old_img=$model->logo;
        $model->scenario = 'update-photo-upload';
        if ($model->load(Yii::$app->request->post()) ) {

          $image = UploadedFile::getInstance($model, 'photo');
        //   echo '<pre>';
        //   print_r($image);
        //   die();
        //   $model->company_created=date('Y-m-d H:i:s');
          if(!empty($image)){
            $image_name= rand(1,4000).'.'.$image->extension;
            $model->logo = $image_name;
            $model->save();
            $image->saveAS('uploads/company_img/'.$image_name);
            if ($old_img){
                unlink('uploads/company_img/'.$old_img);
            }
          }else{
            $model->save();
          }  
            return $this->redirect(['view', 'id' => $model->company_id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = companies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
