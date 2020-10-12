<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\modal;
use frontend\models\Book;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Books';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>


<div class="box box-info">
            <div class="box-header with-border">

          <?php if(Yii::$app->user->can('Librarian')){?>
          <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>

          <?php } ?>

          <?php if(Yii::$app->user->can('admin')){?>
          <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>

          <?php } ?>


              <div style="text-align: center;">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->

            <?php if(Yii::$app->user->can('admin')){?>
             
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        'bookId',
                        'bookName',
                        'referenceNo',
                        'publisher',
                         [
                   'label'=>'Book Status',
                   'format' => 'raw',
                   'value' => function ($dataProvider) {
                     $status = Book::find()->where(['bookId'=>$dataProvider->bookId])->one();
                     if($status->status == 0){
                       $status = 'Available';
                        return '<span class="btn btn-info">'.$status.'</span>';
                     }elseif ($status->status == 1) {
                       $status = 'Issued';
                        return '<span class="btn btn-success">'.$status.'</span>';
                     }elseif ($status->status == 2) 
                     {$status='Pending'; return '<span val="'.$dataProvider->bookId.'"class="btn btn-danger approvebook">'.$status.'</span>';
                   }
                   return '<span class="btn btn-info ">'.$status.'</span>';
                            },
               ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
             <?php }?>
             <?php if(Yii::$app->user->can('Librarian')){?>
             
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        'bookId',
                        'bookName',
                        'referenceNo',
                        'publisher',
                         [
                   'label'=>'Book Status',
                   'format' => 'raw',
                   'value' => function ($dataProvider) {
                     $status = Book::find()->where(['bookId'=>$dataProvider->bookId])->one();
                     if($status->status == 0){
                       $status = 'Available';
                        return '<span class="btn btn-info">'.$status.'</span>';
                     }elseif ($status->status == 1) {
                       $status = 'Issued';
                        return '<span class="btn btn-success">'.$status.'</span>';
                     }elseif ($status->status == 2) 
                     {$status='Pending'; return '<span val="'.$dataProvider->bookId.'"class="btn btn-danger approvebook">'.$status.'</span>';
                   }
                   return '<span class="btn btn-info ">'.$status.'</span>';
                            },
               ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
             <?php }?>


      <?php if(Yii::$app->user->can('student')){?>

            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        'bookId',
                        'bookName',
                        'referenceNo',
                        'publisher ',
                        
                        [
                   'label'=>'Book Status',
                   'format' => 'raw',
                   'value' => function ($dataProvider) {
                     $status = Book::find()->where(['bookId'=>$dataProvider->bookId])->one();
                     if($status->status == 0){
                       $status = 'Available';
                     }elseif ($status->status == 1) {
                       $status = 'Issued';
                     }elseif ($status->status == 2) {$status='Pending';
                   }
                   return '<span class="btn btn-info">'.$status.'</span>';
                            },
               ],
                        
                      [
                        'label'=>'Borrow Book',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                            return '<span val="'.$dataProvider->bookId.'"class="btn btn-danger borrowbook"> Borrow </span>';
                            },
                            
                            ],
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
             <?php }?> 
            <!-- /.box-body -->
          </div>

          <?php
        Modal::begin([
            'header'=>'<h4>Borrow Book</h4>',
            'id'=>'borrowbook',
            'size'=>'modal-md'
            ]);        

        echo "<div id='borrowbookContent'></div>";
        Modal::end();
      ?>

      <?php
        Modal::begin([
            'id'=>'approvebook',
            'size'=>'modal-md'
            ]);        

        echo "<div id='approvebookContent'></div>";
        Modal::end();
      ?>

