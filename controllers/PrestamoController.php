<?php

namespace app\controllers;
//namespace Yii;

use Yii;
use app\models\Prestamo;
use app\models\PrestamoSearch;
use app\models\Prenda;

use yii\db\ActiveRecord;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PrestamoController implements the CRUD actions for Prestamo model.
 */
class PrestamoController extends Controller
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
                    //'delete' => ['POST'],
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
     * Lists all Prestamo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prestamo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prestamo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idPrenda)
    {
        $model = new Prestamo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPrestamo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prestamo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPrestamo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionLiberar(){
      if(isset($_GET['idPrenda']))
        $idPrenda = $_GET['idPrenda'];

      $prenda = Prenda::find()->where(['idPrenda' => $idPrenda])->one();

      if($prenda->estado == 'Pendiente'){
        $prenda->estado = 'Libre';
        $prenda->save(false);
        $this->findModel($idPrenda)->delete();
      }

      return $this->redirect(['index']);

    }

    public function actionReserva($idPrenda, $dueno)
    {
        $model = new Prestamo();
        $prenda = Prenda::find()->where(['idPrenda' => $idPrenda])->one();

        $today = date("yyyy-mm-dd");
        
        if(strtotime($model->fechaInicio) < strtotime($model->fechaFinal))
          die("Inicio > Final");
        if(strtotime($model->fechaInicio) > $today)
          die("Día ya pasado");


        $model->idPrenda = $idPrenda;
        $model->idUsuarioDa = $dueno;
        $model->idUsuarioUsa = Yii::$app->user->id;
        $prendasEstado = ArrayHelper::map(Prenda::find()->all(), 'idPrenda', 'estado');

        //No debería entrar nunca, pues el botón de reserva no aparece con la prenda !libre, pero si se intenta forzar se lanza un die
        if($prendasEstado[$idPrenda] != 'Libre')
          die("Prenda en estado ".$prendasEstado[$idPrenda]);


        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $prenda->changeEstado($idPrenda);
            $idEncode = base64_encode($model->idPrenda);

            return $this->redirect(['prenda/view', 'idPrenda' => $idEncode]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Prestamo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idPrenda)
    {
        //$this->findModel($id)->delete();
        if(isset($_GET['idPrenda']))
          $idPrenda = $_GET['idPrenda'];

        $prenda = Prenda::find()->where(['idPrenda' => $idPrenda])->one();
        if($prenda->save(false)){
          if($prenda->estado == 'Ocupado')
            $this->findModel($idPrenda)->delete();
          $prenda->changeEstado($idPrenda);
        }


        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Prestamo::findOne(['idPrenda' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Prestamo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestamo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */



}
