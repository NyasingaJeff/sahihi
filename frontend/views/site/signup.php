<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

>
    <?php $form = ActiveForm::begin(['id' => 'form-signup'],['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'kraPin')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'kraFileAddress')->fileInput() ?>
            <?= $form->field($model, 'idNumber')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'idScan')->fileInput() ?>
        </div>
    </div>
        <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
    </div>
</div>
