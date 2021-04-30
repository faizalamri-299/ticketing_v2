<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\PermissionHelpers;
use common\models\User;
use dominus77\sweetalert2\Alert;
use frontend\models\Profil;
use frontend\modules\tetapan\models\TetapanSistem;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

use frontend\assets\AdminoxAsset;
AdminoxAsset::register($this);

$this->registerJs("$('[data-tooltip=\"tooltip\"]').tooltip();");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tunku Laksamana Johor Cancer Foundation" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom" style="background-color: #552586;">
        <ul class="list-unstyled topnav-menu float-right mb-0">

             <li class="dropdown notification-list">
                <a class="nav-link _dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
                    <!-- <img src="<?= Yii::$app->view->theme->baseUrl . '/assets/images/users/avatar-4.jpg' ?>" class="rounded-circle" alt="user-image"> -->
                    <span class="pro-user-name ml-1">
                        <?php //Profil::getValue(Yii::$app->user->identity->id, 'pu_mod_nama_penuh'); ?>  <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Selamat datang!</h6>
                    </div>

                    <!-- item-->
                    <a href="<?= Url::to(['//user/view', 'id' => Yii::$app->user->identity->id]); ?>" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profail</span>
                    </a>

                    <!-- item-->
                    <a href="<?= Url::to(['/user/update-password', 'id' => Yii::$app->user->identity->id]); ?>" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Tukar Katalaluan</span>
                    </a>

                    <!-- item-->
                    <a href="<?= Url::to(['/video/index']); ?>" class="dropdown-item notify-item">
                        <i class="fe-video"></i>
                        <span>Bantuan</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Tetapan</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="<?= Url::to(['/site/logout']); ?>" data-method="POST" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i> <span>Log Keluar</span>
                    </a>

                </div>
            </li>
        </ul>
        
        <!-- LOGO -->
        <div class="logo-box">
            <a href="<?= Url::home()?>" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="<?= Yii::$app->request->baseUrl . '/img/logo-tljcf-new.png' ?>" alt="" height="120">
                    <!-- <span class="logo-lg-text-dark">Adminox</span> -->
                </span>
                <span class="logo-sm">
                    <!-- <span class="logo-lg-text-dark">A</span> -->
                    <img src="<?= Yii::$app->request->baseUrl . '/img/logo-tangan-2.png' ?>" alt="" height="60">
                </span>

            </a>
        </div>

         <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li class="d-none d-sm-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari..." style="background-color: #F5F5F5;color: #000000;">
                            <div class="input-group-append">
                                <button class="btn" type="submit" style="background-color: #F5F5F5;">
                                    <i class="fas fa-search" style="color: #000000;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li>
            <?php if($maintenanceMode) { ?>
            <li class="d-none d-sm-block">
                Maintenance Mode
            </li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- end Topbar -->
        
       
    <div class="left-side-menu">
        <div class="slimscroll-menu">
            <!-- Navigation Menu-->
            <?= $this->render('_vertical-menu',['isRoleSuperAdmin'=>$isRoleSuperAdmin,'minAdmin'=>$minAdmin]) ?>
            <!-- End navigation menu -->
            <div class="clearfix"></div>
        </div>
    </div>

<!-- end #navigation -->   
</div>

<div class="content-page" style="margin-top:0px">
    <div class="content">
        

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row" style="margin-top:70px">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'options' => ['class' => 'breadcrumb m-0']
                            ]) ?>
                        </div>
                        <h4 class="page-title"><?= $this->title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <!-- start page content -->
            <?php 
                foreach (Yii::$app->session->getAllFlashes() as $message) {
                echo \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]);
                }
             ?>

            <?= $content ?>
            <!-- end page content -->

        </div>
        <!-- End Content-->
        
    </div>
</div>



<!-- Footer Start -->
<?= $this->render('_footer'); ?>
<!-- end Footer -->

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
