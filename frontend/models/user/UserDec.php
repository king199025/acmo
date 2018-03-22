<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 06.05.2016
 * Time: 14:05
 */

namespace frontend\models\user;

use common\models\UserRegion;
use dektrium\user\models\Token;
use dektrium\user\models\User;
use common\models\Region;
use Yii;

class UserDec extends User
{
    private $regionIds;

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['regionIds', 'safe']
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'regionIds' => 'Доступные Источники'
        ]);
    }

    /**
     * Attempts user confirmation.
     *
     * @param string $code Confirmation code.
     *
     * @return boolean
     */
    public function attemptConfirmation($code)
    {
        $token = $this->finder->findTokenByParams($this->id, $code, Token::TYPE_CONFIRMATION);

        if ($token instanceof Token && !$token->isExpired) {
            $token->delete();
            if (($success = $this->confirm())) {
                Yii::$app->user->login($this, $this->module->rememberFor);
                $message = Yii::t('user', 'Thank you, registration is now complete.');
            } else {
                $message = Yii::t('user', 'Something went wrong and your account has not been confirmed.');
            }
        } else {
            $success = false;
            $message = Yii::t('user', 'The confirmation link is invalid or expired. Please try requesting a new one.');
        }

        //Yii::$app->session->setFlash($success ? 'success' : 'danger', $message);

        return $success;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRegions()
    {
        return $this->hasMany(UserRegion::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['id' => 'region_id'])->viaTable('user_region', ['user_id' => 'id']);
    }

    public function getRegionIds()
    {
        if (empty($this->regionIds)) {
            $this->regionIds = $this->getRegions()->select('id')->column();
        }

        return $this->regionIds;
    }

    public function setRegionIds(array $value)
    {
        $this->regionIds = $value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveRegions();

        parent::afterSave($insert, $changedAttributes);
    }

    private function saveRegions()
    {
        if(!empty($this->regionIds)) {
            $oldRegions = $this->getRegions()->select('id')->column();
            $toInsert = array_diff($this->regionIds, $oldRegions);
            $toDelete = array_diff($oldRegions, $this->regionIds);

            foreach ($toInsert as $insert) {
                $userRegion = new UserRegion([
                    'user_id' => $this->id,
                    'region_id' => $insert
                ]);
                $userRegion->save();
            }
            UserRegion::deleteAll(['user_id' => $this->id, 'region_id' => $toDelete]);
        }
    }
}