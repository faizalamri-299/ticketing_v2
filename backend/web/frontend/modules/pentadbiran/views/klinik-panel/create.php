<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KpKlinikPanel */

$this->title = 'Create Kp Klinik Panel';
$this->params['breadcrumbs'][] = ['label' => 'Kp Klinik Panels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kp-klinik-panel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
