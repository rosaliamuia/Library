<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */
/* @var $form ActiveForm */
?>
<div class="viewbook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentId') ?>
        <?= $form->field($model, 'bookId') ?>
        <?= $form->field($model, 'borrowDate') ?>
        <?= $form->field($model, 'expectedreturnDate') ?>
        <?= $form->field($model, 'actualreturnDate') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- viewbook -->
