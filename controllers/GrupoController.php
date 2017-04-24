<?php

namespace app\controllers;

use Yii;
use app\models\Grupo;
use app\models\Usuariogrupo;
use app\models\GrupoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller
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
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
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
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grupo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idGrupo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($nombre, $contrasena, $indice)
    {
        // $model = $this->findModel($id);
        //
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->idGrupo]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
        return $this->render('update', [
                // 'nombre' => $nombre,
                // 'contrasena' => $contrasena,
                // 'indice' => $indice,
             ]);
    }

    /**
     * Deletes an existing Grupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionIngresar($nombre, $contrasena, $indice){

      $realPass = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'nombre','contrasena','idGrupo');
      if(array_key_exists($indice, $realPass)){
        if(array_key_exists($nombre, $realPass[$indice]) && $realPass[$indice][$nombre] == $contrasena){
          $this->yaIngresado(Yii::$app->user->id, $indice);
          return $this->render('//UsuarioGrupo/create', [
              'idUsuario' => Yii::$app->user->id,
              'idGrupo' => $indice,
          ]);
        }else{
          die("No existe el grupo o la contraseña es incorrecta - ".$nombre."--".$contrasena);
        }
      }else{
        die("no existe el indice - ".$nombre."--".$contrasena);
      }

    }

    public function yaIngresado($idUsuario, $idGrupo){
      $container = \yii\helpers\ArrayHelper::map(Usuariogrupo::find()->all(),'idGrupo','idUsuario');
      if($container[$idGrupo] == $idUsuario){
        die("El usuario ya existe en este grupo");
      }

    }

    /**
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
