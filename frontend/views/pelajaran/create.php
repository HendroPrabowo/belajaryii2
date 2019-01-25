<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pelajaran */

$this->title = 'Create Pelajaran';
$this->params['breadcrumbs'][] = ['label' => 'Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
