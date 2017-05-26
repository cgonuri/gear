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
            'acces' => [
              'class' => \yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            ]

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
     * @param integer $tipoprendaid
     * @return mixed
     */
    // public function actionView($idPrenda, $idTalla, $tipoprendaid)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($idPrenda, $idTalla, $tipoprendaid),
    //     ]);
    // }
    public function actionView($idPrenda)
    {
        //$idPrenda = SiteController::decode($idPrenda);
        $idPrenda = base64_decode($idPrenda);
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          $model->upload();
          $idEncode = base64_encode($model->idPrenda);
          return $this->redirect(['view', 'idPrenda' => $idEncode, 'idTalla' => $model->idTalla, 'tipoprendaid' => $model->tipoprendaid]);
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
     * @param integer $tipoprendaid
     * @return mixed
     */
    public function actionUpdate($idPrenda, $idTalla, $tipoprendaid)
    {
        $model = $this->findModel($idPrenda, $idTalla, $tipoprendaid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
            return $this->redirect(['view', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoprendaid' => $model->tipoprendaid]);
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
     * @param integer $tipoprendaid
     * @return mixed
     */
    public function actionDelete($idPrenda, $idTalla, $tipoprendaid)
    {
        $this->findModel($idPrenda, $idTalla, $tipoprendaid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idPrenda
     * @param integer $idTalla
     * @param integer $tipoprendaid
     * @return Prenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // protected function findModel($idPrenda, $idTalla, $tipoprendaid)
    // {
    //     if (($model = Prenda::findOne(['idPrenda' => $idPrenda, 'idTalla' => $idTalla, 'tipoprendaid' => $tipoprendaid])) !== null) {
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

    //subir foto nueva prenda
      public function actionUpload($id)
         {
           $model = new Prenda();
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

         //añadir foto prenda existente
           public function actionUploadother($id)
              {
                if(isset($_GET['id']))
                  $idPrenda = $_GET['id'];

                  $model = Prenda::find()->where(['idPrenda' => $idPrenda])->one();

                  if (Yii::$app->request->isPost) {
                      $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                      if($model->save()){

                      }else
                      var_dump($model->getErrors());
                      if ($model->uploadother()) {
                          // file is uploaded successfully
                          return;
                      }
                  }

                  return $this->render('view', ['model' => $model]);
              }

          public function actionLists ($id)
             {
                return $this->redirect(['create', 'idEstiloPrenda' => $id]);
             }

          public function actionFiltrotipo($id){

              if($id == '')
                return $this->redirect(['miarmario']);

              return $this->redirect(['miarmario', 'tipoPrendaId' => $id]);
            }

             public function actionChangeestado($idPrenda){

               $model = $this->findModel($idPrenda);

               $estado = $model->estado;

               switch ($estado) {
                 case 'Libre':
                   $model->estado = 'Pendiente';
                   break;
                 case 'Pendiente':
                   $model->estado = 'Ocupado';
                   break;
                 case 'Ocupado':
                   $model->estado = 'Libre';
                   break;

                 default:
                   break;
               }

               $model->save();

               return $this->render('view', ['model' => $model]);
             }






}
