<?php
namespace common\components;
 
use Yii;
use kartik\grid\GridView;
 
class BitGridView extends GridView
{
	public $responsiveWrap = false;
	public $striped = false;
	public $bordered = false;
	public $pager = [
		'firstPageLabel' => 'Pertama',
		'lastPageLabel'  => 'Terakhir'
	];
	public $summary = "Memaparkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> rekod. Paparan <b>{page}</b> dari <b>{pageCount}</b>.";
	public $emptyText = 'Tiada data';

	public function init()
	{
		parent::init();
	}
}