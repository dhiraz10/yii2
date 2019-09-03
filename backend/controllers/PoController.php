<?php

namespace backend\controllers;

use Yii;
use backend\models\po;
use backend\models\model;
use common\models\PoSearch;
use yii\web\Controller;
use backend\models\PoItems;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/**
 * PoController implements the CRUD actions for po model.
 */
class PoController extends Controller
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
     * Lists all po models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single po model.
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
     * Creates a new po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new po();
        $modelsPoItems = [new PoItems];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsPoItems = Model::createMultiple(PoItems::classname());
            Model::loadMultiple($modelsPoItems, Yii::$app->request->post());

           

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItems) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPoItems as $modelPoItems) {
                            $modelPoItems->po_id = $model->id;
                            if (! ($flag = $modelPoItems->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }



            
        }

        return $this->render('create', [
            'model' => $model,
            'modelsPoItems' => (empty($modelsPoItems)) ? [new PoItems] : $modelsPoItems
        ]);
    }

    /**
     * Updates an existing po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {  
      
        $model = $this->findModel($id);
        $modelsPoItems = $model->poItems;
        // echo '<pre>';
        // print_r($modelsPoItems);
        // die();
        
        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsPoItems, 'id', 'id');
            $modelsPoItems = Model::createMultiple(Address::classname(), $modelsPoItems);
            Model::loadMultiple($modelsPoItems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPoItems, 'id', 'id')));
                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($modelsPoItems) && $valid;

                    if ($valid) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            if ($flag = $model->save(false)) {
                                if (! empty($deletedIDs)) {
                                    Address::deleteAll(['id' => $deletedIDs]);
                                }
                                foreach ($modelsPoItems as $modelPoItems) {
                                    $modelsPoItems->po_id = $model->id;
                                    if (! ($flag = $modelPoItems->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                            if ($flag) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $modelPoItems->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }

                            
                            }
        //                       echo '<pre>';
        // print_r($modelsPoItems);
        // die();

        return $this->render('update', [
            'model' => $model,
            'modelsPoItems' => (empty($modelsPoItems)) ? [new PoItems] : $modelsPoItems
        ]);
    }

    /**
     * Deletes an existing po model.
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
     * Finds the po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = po::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
