<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <ul>
        <li><?= Html::a('Pelajaran', ['pelajaran/index']) ?></li>
        <li><?= Html::a('Kelas', ['kelas/index']) ?></li>
        <li><?= Html::a('Siswa', ['siswa/index']) ?></li>
    </ul>

</div>
