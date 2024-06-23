<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $author
 * @property string $name
 * @property string $publisher
 * @property string $date
 * @property int $price
 * @property int $status
 *
 * @property Request[] $requests
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'name', 'publisher', 'date', 'price'], 'required'],
            [['date'], 'safe'],
            [['price', 'status'], 'integer'],
            [['status'], 'in', 'range' => [0, 1]],
            [['author', 'name', 'publisher'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Автор',
            'name' => 'Название',
            'publisher' => 'Издание',
            'date' => 'Дата выхода',
            'price' => 'Цена',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['book_id' => 'id']);
    }

    public function getStatusText()
    {
        switch ($this->status){
            case 0: return 'Отсутствует';
            case 1: return 'В наличии';
        }
    }

    public function buy($userId)
    {
        $request = new Request();
        $request->user_id = $userId;
        $request->book_id = $this->id;
        return $request->save();
    }

}
