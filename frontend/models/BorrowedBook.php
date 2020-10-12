<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "borrowedBook".
 *
 * @property int $bbId
 * @property int $studentId
 * @property int $bookId
 * @property string $borrowDate
 * @property string $expectedreturnDate
 * @property string|null $actualreturnDate
 */
class BorrowedBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrowedBook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentId', 'bookId', 'borrowDate', 'expectedreturnDate'], 'required'],
            [['studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedreturnDate', 'actualreturnDate'], 'safe'],
            [['studentId'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['studentId' => 'studentsId']],
            [['bookId'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['bookId' => 'bookId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bbId' => 'Bb ID',
            'studentId' => 'Student ID',
            'bookId' => 'Book ID',
            'borrowDate' => 'Borrow Date',
            'expectedreturnDate' => 'Expectedreturn Date',
            'actualreturnDate' => 'Actualreturn Date',
        ];
    }
}
