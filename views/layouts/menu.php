<?php
use yii\helpers\Url;

$urlDetalles = Url::to(['usuario/view', 'id' => Yii::$app->user->id]);
$urlMiArmario = Url::to(['prenda/miarmario', 'id' => Yii::$app->user->id]);


return [
	//['label' => 'Grupos', 'url' => ['/grupo']],
  ['label' => 'Mi armario', 'url' => $urlMiArmario],
  ['label' => 'Mis Prendas', 'url' => ['/prenda']],
  ['label' => 'Mis Préstamos', 'url' => ['/prestamo']],
	//['label' => 'Mis Grupos', 'url' => ['/Usuariogrupo']],
	['label' => 'Detalles y Grupos', 'url' => $urlDetalles],

];
