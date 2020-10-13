<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Book;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
/* @var $form ActiveForm */

$books = ArrayHelper::map(Book::find()->where(['status'=>2])->all(), 'bookId', 'bookName');
?>
<div class="approvebook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'bookId')->dropDownList($books) ?>
       
    
        <div class="form-group">
            <?= Html::submitButton('Approve Book', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- approvebook -->
