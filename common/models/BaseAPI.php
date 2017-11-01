<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 31.10.2017
 * Time: 19:17
 */

namespace common\models;


class BaseAPI
{
    public static function check(&$array)
    {
        foreach ($array as &$item){
            if(is_array($item) && empty($item)){
                $item = '';
            }
        }
    }

    public static function parsePdkName($name){
        $parse = '';
        $result = [];

        if(is_string($name)){
            $name = str_replace('км', 'км ', $name);
            $name = preg_replace("/  +/", " ", trim($name));
            $parse = explode(' ', $name);
            $result['id'] = $parse[0];
            if(strpos($parse[1], 'км') !== false){
                if(strpos($parse[2], '+')!== false){
                    $result['distance'] = implode([$parse[1], $parse[2]], ' ');
                }elseif(strlen($parse[2] > 2)){
                    $result['distance'] = $parse[2];
                }elseif(strlen($parse[1] > 2)){
                    $result['distance'] = $parse[1];
                }

                if (!empty($parse[3]) && !empty($parse[4])){
                    $result['name'] = implode([$parse[3], $parse[4]], ' ');
                }elseif (!empty($parse[3])){
                    $result['name'] = $parse[3];
                }
            }else {
                if(!empty($parse[1]) && !empty($parse[2])){
                    $result['name'] = implode([$parse[1], $parse[2]], ' ');
                }elseif (!empty($parse[1])){
                    $result['name'] = $parse[1];
                }
            }
        }
        if(empty($result['distance'])){
            $result['distance'] = '';
        }

        return $result;
    }
}