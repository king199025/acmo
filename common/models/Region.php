<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $coordLatitude
 * @property string $coordLongitude
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'string', 'max' => 255],
            [['name', 'url'], 'required'],
            ['url', 'url'],
            [['coordLatitude', 'coordLongitude'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'URL сервера',
            'coordLatitude' => 'Координаты широты',
            'coordLongitude' => 'Координаты долготы',
        ];
    }
}
