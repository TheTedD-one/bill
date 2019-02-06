<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequisitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requisites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisites-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Requisites', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'enableSorting' => false
            ],
            [
                'attribute' => 'bin',
                'enableSorting' => false
            ],
            [
                'attribute' => 'address',
                'enableSorting' => false
            ],
            [
                'attribute' => 'iik',
                'enableSorting' => false
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
