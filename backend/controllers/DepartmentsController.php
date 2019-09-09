<?php

namespace backend\controllers;

use Yii;
use backend\models\departments;
use backend\models\DepartmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;

/**
 * DepartmentsController implements the CRUD actions for departments model.
 */
class DepartmentsController extends Controller
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
     * Lists all departments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->post('hasEditable')){
            $departmentID =Yii::$app->request->post('editableKey');
            $department =Departments::findOne($department_id);
            $out =json::encode(['output'=>'','message'=>'']);
            $post=[];
            $posted =current($_POST['Branches']);
            $post['Departments']=$posted;
            if($department->load($post)){
                $department->save();
            }
            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single departments model.
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
     * Creates a new departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new departments();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->department_created = date('y-m-d h:m:s');
			$model->save();
            return $this->redirect(['view', 'id' => $model->department_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing departments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->department_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing departments model.
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
     * Finds the departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = departments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEditableDemo() {
        $model = new Departments; // your model can be loaded here
        
        // Check if there is an Editable ajax request
        if (Yii::$app->request->post('hasEditable')) {
            Yii::$app->response->format = Response::FORMAT_JSON;
  
            $model = $this->findModel(Yii::$app->request->post('editableKey'));
  
            $out = [
                'output'    => '',
                'message'   => '',
            ];
  
            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Model without any indexes
            // - $post is the converted array for single model validation
            $posted =Yii::$app->request->post();
            $post = [
                'Departments'=>$posted['Departments'][$posted['editableIndex']]
            ];
            //echo '<pre>';print_r($post);die;
            
            
            if ($model->load($post)) {
                if (!$model->save()) {
                    $out = [
                        'output'    => '',
                        'message'   => $model->getFirstError(),
                    ];
                }
                $out = [
                    'output'    => $model->department_name,
                    'message'   => '',
                ];
            }
        }
        return $out;
    }

}
