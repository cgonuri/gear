<?php

namespace app\controllers;

use Yii;
use app\models\Prenda;
use app\models\Talla;

use app\models\PrendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\FormUpload;
use yii\web\UploadedFile;

/**
 * PrendaController implements the CRUD actions for Prenda model.
 */
class PrendaController extends Controller
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
     * Lists all Prenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrendaSearch();
        $userId = Yii::$app->user->id;
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $dueno="ewew");
        //$dataProvider = $searchModel->search(Yii::$app->Prenda->identity->id);

        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams+['PrendaSearch' => ['<>', 'dueno' =>$userId]]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prenda model.
     * @param integer $idPrenda
     * @param integer $idTalla
     * @param integer $tipoPrendaId
     * @return mixed
     */
    // public function actionView($idPrenda, $idTalla, $tipoPrendaId)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($idPrenda, $idTalla, $tipoPrendaId),
    //     ]);
    // }
    public function actionView($idPrenda)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPrenda),
        ]);
    }

    public function actionMiarmario()
    {
      $model = new Prenda();

      $searchModel = new PrendaSearch();

      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('miArmario', [
          'model' => $model,
          'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Creates a new Prenda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prenda();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          $model->upload();
            return $this->redirect(['view', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId]);
       } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prenda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPrenda
     * @param integer $idTalla
     * @param integer $tipoPrendaId
     * @return mixed
     */
    public function actionUpdate($idPrenda, $idTalla, $tipoPrendaId)
    {
        $model = $this->findModel($idPrenda, $idTalla, $tipoPrendaId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
            return $this->redirect(['view', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Prenda model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idPrenda
     * @param integer $idTalla
     * @param integer $tipoPrendaId
     * @return mixed
     */
    public function actionDelete($idPrenda, $idTalla, $tipoPrendaId)
    {
        $this->findModel($idPrenda, $idTalla, $tipoPrendaId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idPrenda
     * @param integer $idTalla
     * @param integer $tipoPrendaId
     * @return Prenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // protected function findModel($idPrenda, $idTalla, $tipoPrendaId)
    // {
    //     if (($model = Prenda::findOne(['idPrenda' => $idPrenda, 'idTalla' => $idTalla, 'tipoPrendaId' => $tipoPrendaId])) !== null) {
    //         return $model;
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }
    protected function findModel($idPrenda)
    {
        if (($model = Prenda::findOne(['idPrenda' => $idPrenda])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //SUBIR FOTO DEL USUARIO
      public function actionUpload($id)
         {
             $model = new Prenda();
            //  die("action upload");

             if (Yii::$app->request->isPost) {
                 $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                 if($model->save()){

                 }else
                 var_dump($model->getErrors());
                 if ($model->upload()) {
                     // file is uploaded successfully
                     return;
                 }
             }

             return $this->render('view', ['model' => $model]);
         }

         public function actionLists ($id)
             {

                 $countTallas = Talla::find()
                         ->where(['tipoPrendaId' => $id])
                         ->count();

                 $tallas = Talla::find()
                         ->where(['tipoPrendaId' => $id])
                         ->all();

                 if($countTallas>0){
                     foreach($tallas as $prenda){
                         //echo "<option value='".$prenda->tipoPrendaId."'>".$prenda->talla."</option>";
                         echo "<option value='1'>HELLO</option>";
                     }
                 }
                 else{
                     echo "<option>-</option>";
                 }

                 //echo "<option>-</option>";

             }

}
