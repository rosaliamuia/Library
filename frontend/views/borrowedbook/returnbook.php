<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Student;
use frontend\models\Book;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */



$students = ArrayHelper::map(Student::find()->all(), 'studentsId', 'fullName');

$books = ArrayHelper::map(Book::find()->where(['status'=>0])->all(), 'bookId', 'bookName');
?><div class="borrowed-book-form">    


	<?php $form = ActiveForm::begin(['id' => 'borrowedbook-create']); ?>
    
        <?= $form->field($model, 'studentId')->dropDownList($students,['disabled' => true]) ?>    <?= $form->field($model, 'bookId')->dropDownList($books,['disabled' => true]) ?>
    
    <?= $form->field($model, 'borrowDate')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'expectedreturnDate')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'actualreturnDate')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter Expected Return date ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format'=>'yyyy/mm/dd'
            ]
        ]);
     ?>    

     <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>    


    <?php ActiveForm::end(); ?>


</div>