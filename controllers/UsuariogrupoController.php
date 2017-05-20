<?php

namespace app\controllers;

use Yii;
use app\models\Usuariogrupo;
use app\models\Grupo;
use app\models\UsuariogrupoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use lo\modules\noty\Wrapper;


/**
 * UsuariogrupoController implements the CRUD actions for Usuariogrupo model.
 */
class UsuariogrupoController extends Controller
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
     * Lists all Usuariogrupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariogrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuariogrupo model.
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
     * Creates a new Usuariogrupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuariogrupo();

        if ($model->load(Yii::$app->request->post())) {
          $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo','nombre');
          $passwords = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'nombre','contrasena');
          $misGrupos = \yii\helpers\ArrayHelper::map(Usuariogrupo::find()->all(),'idUsuario', 'idGrupo','idUsuGrupo');

          if(in_array($model->idGrupo, $container) && $model->idUsuario == $passwords[$model->idGrupo] ){
            $model->idGrupo = array_search($model->idGrupo, $container);
            $model->idUsuario = Yii::$app->user->id;
            foreach ($misGrupos as $key) {
              if(isset($key[$model->idUsuario])){
                if($key[$model->idUsuario] == $model->idGrupo)
                return $this->redirect(['create', 'id' => $model->idUsuGrupo, 'error' => '1']);
              }
            }
            $model->save();
            return $this->redirect(['index', 'id' => $model->idUsuGrupo]);
          }
          else{
            return $this->redirect(['create', 'id' => $model->idUsuGrupo, 'error' => '2']);
          }

        } else {
            return $this->render('create', [
            'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuariogrupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idUsuGrupo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuariogrupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuariogrupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuariogrupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuariogrupo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
