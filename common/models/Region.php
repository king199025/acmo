<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRegions()
    {
        return $this->hasMany(UserRegion::className(), ['region_id' => 'id']);
    }

    public static function getRegionList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    public static function getUserRegionList($user_id)
    {
        $regions = self::find()->joinWith('userRegions')->where(['user_id' => $user_id])->all();

        return ArrayHelper::map($regions, 'id', 'name');
    }
}
