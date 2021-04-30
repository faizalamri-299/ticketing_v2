<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!--- Sidemenu -->
<div id="sidebar-menu">
<br /><br />
    <ul class="metismenu" id="side-menu">

		<li class="menu-title"> SEGMEN EKSEKUTIF </li>
    	<li>
	        <a href="javascript: void(0);">
	            <i class="fe-airplay"></i>
	            <span>  Eksekutif </span>
	            <span class="menu-arrow"></span>
	        </a>
	        <ul class="nav-second-level" aria-expanded="false">
	            <li><?= Html::a('Dashboard', ['//dashboard']) ?></li>
	            <li><?= Html::a('Statistik', ['//dashboard/senarai-grid']) ?></li>
	            <li><?= Html::a('Kalendar Tahunan', ['//kalendar/index-tahunan']) ?></li>
	        </ul>
	    </li>
	    

        <li class="menu-title"> SEGMEN PENTADBIRAN </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fe-users"></i>
                <span> Perkhidmatan </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Anggota/Kakitangan
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tambah', ['/pentadbiran/kakitangan/create']) ?></li>
                        <li><?= Html::a('Senarai', ['/pentadbiran/kakitangan/index']) ?></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Tetapan
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Unit', ['/pentadbiran/unit/index']) ?></li>
                        <li><?= Html::a('Jawatan', ['/pentadbiran/jawatan/index']) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fe-calendar"></i>
                <span> Cuti </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><?= Html::a('Tambah', ['/pentadbiran/permohonan-cuti/create']) ?></li>
                <li><?= Html::a('Senarai', ['/pentadbiran/permohonan-cuti/index']) ?></li>
                 <li>
                    <a href="javascript: void(0);" aria-expanded="false">Kalendar
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tahunan', ['/pentadbiran/permohonan-cuti/kalendar']) ?></li>
                        <li><?= Html::a('Bulanan', ['/pentadbiran/permohonan-cuti/bulanan']) ?></li>
                    </ul>
                </li>
                <li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fe-dollar-sign"></i>
                <span> Tuntutan </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li><?= Html::a('Tambah', ['/pentadbiran/tuntutan/create']) ?></li>
                <li><?= Html::a('Senarai', ['/pentadbiran/tuntutan/index']) ?></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fe-file"></i>
                <span> Dokumen Digital </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li><?= Html::a('Tambah', ['/pentadbiran/dokumen-digital/create']) ?></li>
                <li><?= Html::a('Senarai', ['/pentadbiran/dokumen-digital/index']) ?></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);">
                <i class="fas fa-hospital-alt"></i>
                <span> Klinik Panel </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li><?= Html::a('Tambah', ['/pentadbiran/klinik-panel/create']) ?></li>
                <li><?= Html::a('Senarai', ['/pentadbiran/klinik-panel/index']) ?></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);">
                <i class="fe-settings"></i>
                <span> Tetapan </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Kod Jenis Dokumen
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tambah', ['/pentadbiran/kod-jenis-dokumen/create']) ?></li>
                        <li><?= Html::a('Senarai', ['/pentadbiran/kod-jenis-dokumen/index']) ?></li>
                    </ul>
                </li>
            </ul>
             <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Kod Cuti
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tambah', ['/pentadbiran/kod-cuti/create']) ?></li>
                        <li><?= Html::a('Senarai', ['/pentadbiran/kod-cuti/index']) ?></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Jumlah Cuti Kakitangan
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tambah', ['/pentadbiran/kakitangan-has-kod-cuti/create']) ?></li>
                        <li><?= Html::a('Senarai', ['/pentadbiran/kakitangan-has-kod-cuti/index']) ?></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Kod Tuntutan
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li><?= Html::a('Tambah', ['/pentadbiran/kod-tuntutan/create']) ?></li>
                        <li><?= Html::a('Senarai', ['/pentadbiran/kod-tuntutan/index']) ?></li>
                    </ul>
                </li>
            </ul>
        </li>

		<?php if($minAdmin) { ?>
        <li>
            <a href="javascript: void(0);">
                <i class="fe-user"></i>
                <span> Role Access </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><?= Html::a('Pengguna', ['/user']); ?></li>
                <?php if($isRoleSuperAdmin) { ?>
                <li><?= Html::a('Roles', ['//rbac/role']); ?></li>
                <li><?= Html::a('Permissions', ['//rbac/permission']); ?></li>
                <li><?= Html::a('Routes', ['//rbac/route']); ?></li>
                <?php } ?>
            </ul>
        </li>
        <?php } ?>
    </ul>
</div>
<div class="clearfix"></div>
