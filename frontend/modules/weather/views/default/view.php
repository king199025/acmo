<?php
/**
 * @var array $weather
 */
?>

<!-- start meteo-archive-pdk.html-->
<section class="meteo meteo-archive">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <button class="btn btn-left"></button>
            <button class="btn btn-right"></button>
            <span><?php echo $weather['WEATHER_DATA'][0]['METEO_NAME'] ?></span>
        </div>
        <div class="s-header__side">
            <button class="btn">Архив</button>
            <button class="btn">Текущие</button>
            <button class="btn">Прогноз</button>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <div class="filter">
            <span>Период с: </span><input type="date"><span>по: </span><input type="date">
        </div>

        <table>
            <thead>
            <tr>
                <th rowspan="2" class="ma-when">Время измерения</th>
                <th rowspan="2" class="ma-photo-ico"><img src="img/icons/table-photo-head.png" alt="photo"></th>
                <th rowspan="2" class="ma-weather-ico"><img src="img/icons/table-weather-head.png" alt="weather"></th>
                <th colspan="3" class="ma-fallout">Осадки</th>
                <th rowspan="2" class="ma-temp">Т возд., C</th>
                <th rowspan="2" class="ma-dew">Точка росы, С</th>
                <th rowspan="2" class="ma-wet">Влаж., %</th>
                <th rowspan="2" class="ma-pressure">Давл., гПа</th>
                <th colspan="2" class="ma-wind">Ветер</th>
                <th colspan="3" class="ma-coating">Поверхность</th>
                <th colspan="2" class="ma-road-body">Тело дороги</th>
                <th colspan="3" class="ma-layer-fallout">Слой осадков</th>
            </tr>
            <tr>
                <th class="ma-fallout-type">Тип</th>
                <th class="ma-fallout-sum">Сумма,мм</th>
                <th class="ma-fallout-intensity">Интен., мм/час</th>
                <th class="ma-wind-ms">Скор., м/с</th>
                <th class="ma-wind-grd">Напр., грд</th>
                <th class="ma-coating-temp">Темп., С</th>
                <th class="ma-coating-compos">Сост</th>
                <th class="ma-coating-clutch">К.сцепл.</th>
                <th class="ma-road-body-temp-min">Т.тела,С(6см)</th>
                <th class="ma-road-body-temp-max">Т.тела,С(30см)</th>
                <th class="ma-layer-fallout-water">Вода</th>
                <th class="ma-layer-fallout-snow">Снег</th>
                <th class="ma-layer-fallout-ice">Град</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($weather['WEATHER_DATA'] as $item): ?>
                <?php \common\models\AcmoApi::check($item) ?>
                <tr>
                    <td class="ma-when"><?php echo $item['WEATHER_DATE'] ?></td>
                    <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                    <td class="ma-weather-ico"><img src="img/icons/table-weather.png"
                                                    alt=""><?php echo \common\models\AcmoApi::$weather[$item['weather']] ?>
                    </td>
                    <td class="ma-fallout-type"><?php echo \common\models\AcmoApi::$prec_type[$item['prec_type']] ?></td>
                    <td class="ma-fallout-sum"><?php echo $item['prec_sum'] ?></td>
                    <td class="ma-fallout-intensity"><?php echo $item['prec_intensity'] ?></td>
                    <td class="ma-temp"><?php echo $item['T'] ?></td>
                    <td class="ma-dew"><?php echo $item['dewpoint'] ?></td>
                    <td class="ma-wet"><?php echo $item['U'] ?></td>
                    <td class="ma-pressure"><?php echo $item['PO'] ?></td>
                    <td class="ma-wind-ms"><?php echo $item['FF'] ?></td>
                    <td class="ma-wind-grd"><?php echo $item['DD'] ?></td>
                    <td class="ma-coating-temp"><?php echo $item['T_ROAD'] ?></td>
                    <td class="ma-coating-compos"><?php echo \common\models\AcmoApi::$road_state[$item['road_state']] ?></td>
                    <td class="ma-coating-clutch"></td>
                    <td class="ma-road-body-temp-min"></td>
                    <td class="ma-road-body-temp-max"></td>
                    <td class="ma-layer-fallout-water"></td>
                    <td class="ma-layer-fallout-snow"></td>
                    <td class="ma-layer-fallout-ice"></td>
                </tr>
            <?php endforeach; ?>
            <!--<tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>
            <tr>
                <td class="ma-when">23.03.2017 11:44:26</td>
                <td class="ma-photo-ico"><img src="img/icons/table-photo.png" alt=""></td>
                <td class="ma-weather-ico"><img src="img/icons/table-weather.png" alt=""></td>
                <td class="ma-fallout-type"></td>
                <td class="ma-fallout-sum"></td>
                <td class="ma-fallout-intensity"></td>
                <td class="ma-temp"></td>
                <td class="ma-dew"></td>
                <td class="ma-wet"></td>
                <td class="ma-pressure">752</td>
                <td class="ma-wind-ms">2,5</td>
                <td class="ma-wind-grd">178</td>
                <td class="ma-coating-temp">3,9</td>
                <td class="ma-coating-compos">Влажно</td>
                <td class="ma-coating-clutch"></td>
                <td class="ma-road-body-temp-min"></td>
                <td class="ma-road-body-temp-max"></td>
                <td class="ma-layer-fallout-water"></td>
                <td class="ma-layer-fallout-snow"></td>
                <td class="ma-layer-fallout-ice"></td>
            </tr>-->
            </tbody>
        </table>
    </div>

</section>
<!-- end meteo-archive-pdk.html-->
