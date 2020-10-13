<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BorrowedBook;
use frontend\models\Student;
use Yii;

/**
 * BorrowedBookSearch represents the model behind the search form of `frontend\models\BorrowedBook`.
 */
class BorrowedBookSearch extends BorrowedBook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bbId', 'studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedreturnDate', 'actualreturnDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        if (Yii::$app->user->can('student')){
        $student_id = Student::find()->where(['userId'=>Yii::$app->user->id])->One();
        // var_dump($student_id);exit();
        $query = BorrowedBook::find()->where(['actualreturnDate'=>NULL])->andWhere(['studentId'=>$student_id->studentsId]);

        }
        if (Yii::$app->user->can('Librarian')){
        $query = BorrowedBook::find()->where(['actualreturnDate'=>NULL]);
      }
        //$query = BorrowedBook::find()->where(['actualreturnDate'=>NULL]);
/**

        if (Yii::$app->user->can('student')){
                $studentsId = Student::find()->where(['userId'=>Yii::$app->user->id])->One();
                $query = BorrowedBook::find()->where(['actualReturnDate'=>NULL])->where(['studentsId'=>$studentsId->studentsId]);
            }
            */


$query = BorrowedBook::find()->where(['actualreturnDate'=>NULL]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bbId' => $this->bbId,
            'studentId' => $this->studentId,
            'bookId' => $this->bookId,
            'borrowDate' => $this->borrowDate,
            'expectedreturnDate' => $this->expectedreturnDate,
            'actualreturnDate' => $this->actualreturnDate,
        ]);

        return $dataProvider;
    }
}
