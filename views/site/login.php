<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
]); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Вход<small class="display-block">Введите свои учетные данные ниже</small></h5>
        </div>

        <?= $form->field($model, 'username')
            ->textInput(['autofocus' => true, 'placeholder' => 'Логин'])
            ->label(false) ?>

        <?= $form->field($model, 'password')
            ->passwordInput(['placeholder' => 'Пароль'])
            ->label(false) ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                Войти <i class="icon-circle-right2 position-right"></i>
            </button>
        </div>
    </div>
<?php ActiveForm::end(); ?>