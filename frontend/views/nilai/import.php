<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nilai */

$this->title = 'Import Nilai';
$this->params['breadcrumbs'][] = ['label' => 'Nilai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_import_form', [
        'model' => $model,
    ]) ?>

</div>
