<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigital */

$this->title = 'Pendaftaran Dokumen Digital';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Digital', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dd-dokumen-digital-create">
	<div class="card-box">    
	<?= $this->render('_form', [
        'model' => $model,
        'modelFile' => $modelFile,
    ]) ?>
    </div>
</div>
