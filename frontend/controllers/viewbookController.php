<?php

namespace frontend\controllers;

class viewbookController extends \frontend\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

public function actionViewbook()
{
    $model = new \frontend\models\Borrowedbook();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->renderAjax('viewbook', [
        'model' => $model,
    ]);
}
