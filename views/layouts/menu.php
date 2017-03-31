<?php
use yii\helpers\Url;

$urlDetalles = Url::to(['usuario/view', 'id' => Yii::$app->user->id]);

return [
	['label' => 'Grupos', 'url' => ['/grupo']],
  ['label' => 'Mis Prendas', 'url' => ['/prenda']],
  ['label' => 'Mis Préstamos', 'url' => ['/prestamo']],
	['label' => 'Mis Grupos', 'url' => ['/usuariogrupo']],
	['label' => 'Detalles', 'url' => $urlDetalles],

];
