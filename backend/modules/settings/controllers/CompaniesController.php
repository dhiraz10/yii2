<?php

namespace backend\modules\settings\controllers;

use Yii;
use backend\modules\settings\models\companies;
use backend\modules\settings\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
// use yii\widgets\ActiveForm;

/**
 * CompaniesController implements the CRUD actions for companies model.
 */
class CompaniesController extends Controller
{
    /**
     * {@inheritdoc}
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
        // if(Yii::$app->request-> isAjax && $model->load(Yii::$app->request->post()))
        // {
        //     Yii::$app->response->format ='json';
        //     return ActiveFrom::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())  ){
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

        return $this->render('create', [
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
    public function actionCkeditor_image_upload()
{       
    $funcNum = $_REQUEST['CKEditorFuncNum'];

    if($_FILES['upload']) {

      if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name']))) {
      $message = Yii::t('app', "Please Upload an image.");
      }

      else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 5*1024*1024)
      {
      $message = Yii::t('app', "The image should not exceed 5MB.");
      }

      else if ( ($_FILES['upload']["type"] != "image/jpg") 
                AND ($_FILES['upload']["type"] != "image/jpeg") 
                AND ($_FILES['upload']["type"] != "image/png"))
      {
      $message = Yii::t('app', "The image type should be JPG , JPEG Or PNG.");
      }

      else if (!is_uploaded_file($_FILES['upload']["tmp_name"])){

      $message = Yii::t('app', "Upload Error, Please try again.");
      }

      else {
        //you need this (use yii\db\Expression;) for RAND() method 
        $random = rand(1,4000);

        $extension = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

        //Rename the image here the way you want
        $name = date("m-d-Y-h-i-s", time())."-".$random.'.'.$extension; 

        // Here is the folder where you will save the images
        $folder = 'uploads/ckeditor_images/';  

        $url = Yii::$app->urlManager->createAbsoluteUrl($folder.$name);

        move_uploaded_file( $_FILES['upload']['tmp_name'], $folder.$name );

      }

      echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'
           .$funcNum.'", "'.$url.'", "'.$message.'" );</script>';
    }
}
public function beforeAction($action)
{            
    if ($action->id == 'ckeditor_image_upload') {
        $this->enableCsrfValidation = false;
    }

    return parent::beforeAction($action);
}
}
