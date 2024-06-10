<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $name
 * @property int $userId
 * @property string|null $imagePath
 * @property string|null $location
 * @property string|null $otherDetails
 *
 * @property User $user
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'userId'], 'required'],
            [['userId'], 'integer'],
            [['otherDetails'], 'string'],
            [['name', 'imagePath', 'location'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'userId' => 'User ID',
            'imagePath' => 'Image Path',
            'location' => 'Location',
            'otherDetails' => 'Other Details',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
