<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Pendaftaran Jenis Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Kod Jenis Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kod-jenis-dokumen-create">
	<div class="card-box">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>	
	</div>
</div>
