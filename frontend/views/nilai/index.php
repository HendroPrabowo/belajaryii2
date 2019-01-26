<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NilaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nilai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Nilai', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Import Nilai', ['import'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'nama',
            'nilai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
