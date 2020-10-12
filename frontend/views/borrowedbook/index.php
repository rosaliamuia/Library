<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use frontend\models\Book;
use frontend\models\BorrowedBook;
use frontend\models\Student;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailsView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorrowedBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider*/

$this->title = 'BorrowedBooks';
$this->params['breadcrumbs'][] = $this->title;

$totalBooks = Book::find()->asArray()->all();
$bb = BorrowedBook::find()->asArray()->all();
$totalStudents = Student::find()->asArray()->all();
$overdue = BorrowedBook::find()->where('expectedreturnDate >'.date('yy/m/d'))->andWhere([
  'actualreturnDate'=>NULL])->asArray()->all();
?>

<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>            
            <div class="info-box-content">
              <span class="info-box-text">TOTAL BOOKS</span>
              <span class="info-box-number"><?= count($totalBooks)?><small></small></span>
            </div>

            <!-- /.info-box-content -->

          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>            
            <div class="info-box-content">
              <span class="info-box-text">BORROWED BOOKS</span>
              <span class="info-box-number"><?= count($bb)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        

      

        <!-- /.col -->        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>            
            <div class="info-box-content">
              <span class="info-box-text">OVERDUE BOOKS</span>
              <span class="info-box-number"><?= count($overdue)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>            
            <div class="info-box-content">
              <span class="info-box-text">TOTAL STUDENTS</span>
              <span class="info-box-number"><?= count($totalStudents)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">


               <?php if(Yii::$app->user->can('admin')){?>  
          <div style="padding-top: 20px;">
             <button type="button" class="btn btn-block btn-success btn-lg assignbook" style="width: 300px;"><i class="fa fa-plus" aria-hidden="true"></i> Assign a Book</button>
            </div>
          <?php } ?>

            <?php if(Yii::$app->user->can('Librarian')){?>  
          <div style="padding-top: 20px;">
             <button type="button" class="btn btn-block btn-success btn-lg assignbook" style="width: 300px;"><i class="fa fa-plus" aria-hidden="true"></i> Assign a Book</button>
            </div>
          <?php } ?>

  <?php if(Yii::$app->user->can('admin')){?> 
<div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOK ASSIGNMENTS</strong></h2>
            </div>
            <?php } ?>

             <?php if(Yii::$app->user->can('Librarian')){?> 
<div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOK ASSIGNMENTS</strong></h2>
            </div>
            <?php } ?>

             <?php if(Yii::$app->user->can('student')){?> 
<div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOKS BORROWED</strong></h2>
            </div>
            <?php } ?>


            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length">
                      <label>Show
                        <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> entries
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div id="example1_filter" class="dataTables_filter pull-right">
                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </div>
              </div>
              </div>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">                  <div class="input-group-btn">
                      <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

      <?php if(Yii::$app->user->can('admin')){?>

      <div class="row table-responsive no-padding">
                <div class="col-sm-12">           
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'bbId',
                        [
                            'attribute' => 'studentId',
                            'value' => function ($dataProvider) {
                                $studentName = Student::find()->where(['studentsId'=>$dataProvider->studentId])->One();
                                return $studentName->fullName;
                            },
                        ],
                         [
                            'attribute' => 'bookId',
                            'value' => function ($dataProvider) {
                            $studentName = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            return $studentName->bookName;
                            },
                        ],
                        [
                            'attribute' => 'borrowDate',
                            'value' => function ($dataProvider) {
                                $date = new DateTime($dataProvider->borrowDate);
                                return $date->format('F j, Y,');
                            },
                        ],
                        [
                            'attribute' => 'expectedreturnDate',
                            'value' => function ($dataProvider) {
                            $date = new DateTime($dataProvider->expectedreturnDate);
                            return $date->format('F j, Y,');
                            },
                        ],
      


                        'actualreturnDate',
                        [

                            'label'=>'Return Book',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                            return '<span val="'.$dataProvider->bbId.'" class="btn btn-danger returnbook">Return</span>';
                            },
                           
                        ],
                       

                        [
                            'label'=>'Status',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                                $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                                if($bookStatus->status == 0){
                                    $status = 'Available';
                                }elseif ($bookStatus->status == 1){
                                    $status = 'Issued';
                                }elseif ($bookStatus->status == 2){
                                    $status = 'Pending';
                                }
                                return '<span class="btn btn-info">'.$status.'</span>';
                            },
                            
                        ],
              
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php } ?> 

   <?php if(Yii::$app->user->can('Librarian')){?>           
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'bbId',
                        [
                            'attribute' => 'studentsId',
                            'value' => function ($dataProvider) {
                                $studentName = Student::find()->where(['studentsId'=>$dataProvider->studentId])->One();
                                return $studentName->fullName;
                            },
                        ],
                         [
                            'attribute' => 'bookId',
                            'value' => function ($dataProvider) {
                            $studentName = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            return $studentName->bookName;
                            },
                        ],
                        [
                            'attribute' => 'borrowDate',
                            'value' => function ($dataProvider) {
                                $date = new DateTime($dataProvider->borrowDate);
                                return $date->format('F j, Y,');
                            },
                        ],
                        [
                            'attribute' => 'expectedreturnDate',
                            'value' => function ($dataProvider) {
                            $date = new DateTime($dataProvider->expectedreturnDate);
                            return $date->format('F j, Y,');
                            },
                        ],
      


                        'actualreturnDate',
                        [

                            'label'=>'Return Book',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                            return '<span val="'.$dataProvider->bbId.'" class="btn btn-danger returnbook">Return</span>';
                            },
                           
                        ],
                       

                        [
                            'label'=>'Status',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                                $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                                if($bookStatus->status == 0){
                                    $status = 'Available';
                                }elseif ($bookStatus->status == 1){
                                    $status = 'Issued';
                                }elseif ($bookStatus->status == 2){
                                    $status = 'Pending';
                                }
                                return '<span class="btn btn-info">'.$status.'</span>';
                            },
                            
                        ],
              
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php } ?>  


                <?php if(Yii::$app->user->can('student')){?>           
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'bbId',
                        [
                            'attribute' => 'studentId',
                            'value' => function ($dataProvider) {
                                $studentName = Student::find()->where(['studentsId'=>$dataProvider->studentId])->One();
                                return $studentName->fullName;
                            },
                        ],
                         [
                            'attribute' => 'bookId',
                            'value' => function ($dataProvider) {
                            $studentName = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            return $studentName->bookName;
                            },
                        ],
                        [
                            'attribute' => 'borrowDate',
                            'value' => function ($dataProvider) {
                                $date = new DateTime($dataProvider->borrowDate);
                                return $date->format('F j, Y,');
                            },
                        ],
                        [
                            'attribute' => 'expectedreturnDate',
                            'value' => function ($dataProvider) {
                            $date = new DateTime($dataProvider->expectedreturnDate);
                            return $date->format('F j, Y,');
                            },
                        ],
                       

                        [
                            'label'=>'Status',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                                $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                                if($bookStatus->status == 0){
                                    $status = 'Available';
                                      return '<span class="btn btn-info">'.$status.'</span>';
                                }elseif ($bookStatus->status == 1){
                                    $status = 'Issued';  return '<span class="btn btn-success">'.$status.'</span>';
                                }elseif ($bookStatus->status == 2){
                                    $status = 'Pending';
                                }
                                return '<span class="btn btn-info">'.$status.'</span>';
                            },
                            
                        ],
              
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php } ?>  

 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <div class="row">
                <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
            </div>
            <div class="col-sm-7">
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                <ul class="pagination">
                <li class="paginate_button previous disabled" id="example1_previous">
                  <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                </li><li class="paginate_button active">
                  <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                </li><li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                </li>
                <li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                </li><li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                  </li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
                </ul></div></div></div></div>
            </div>
            <!-- /.box-body -->
          </div>



<?php
        Modal::begin([
            'header'=>'<h4>Return Book</h4>',
            'id'=>'returnbook',
            'size'=>'modal-sm'
            ]);        

        echo "<div id='returnbookContent'></div>";
        Modal::end();
      ?>

      <?php
        Modal::begin([
            'header'=>'<h4>Assign A Book</h4>',
            'id'=>'assignbook',
            'size'=>'modal-md'
            ]);        

        echo "<div id='assignbookContent'></div>";
        Modal::end();
      ?>

      