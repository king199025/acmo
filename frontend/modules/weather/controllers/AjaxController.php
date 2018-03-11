<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 01.11.2017
 * Time: 20:42
 */

namespace frontend\modules\weather\controllers;

use yii\helpers\ArrayHelper;

class AjaxController extends DefaultController
{
    public function actionDateInterval()
    {
        $post = \Yii::$app->request->post();
        $date_from = date('d-m-Y', time());
        $interval = 1440;

        if (!empty($post['date_from'])) {
            $date_from = date('d-m-Y H:i', strtotime($post['date_from']) + 3600);
        }

        if (!empty($post['date_to'])) {
            if (strtotime($post['date_to']) > strtotime($post['date_from'])) {
                $interval = (strtotime($post['date_to']) - strtotime($post['date_from'])) / 60;
            } else
                return json_encode(['error' => 'Дата окончания не может быть меньше даты начала']);
        }

        $weather = $this->getData(1, 'forecasta', ['id' => $post['id'], 'date' => $date_from, 'last' => $interval]);

        if(count($weather) > 1 && null !== $weather){
            ArrayHelper::multisort($weather, function ($item) {
                return strtotime($item['WEATHER_DATE']);
            }, SORT_ASC);

            return json_encode(['success' => $this->renderPartial('_date_interval_table', ['weather' => $weather])]);
        }
        return json_encode(['error' => 'По вашему запросу ничего не найдено']);
    }
}