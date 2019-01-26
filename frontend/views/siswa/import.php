<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Siswa */

$this->title = 'Import CSV';
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_import_form', [
        'model' => $model,
    ]) ?>

</div>
