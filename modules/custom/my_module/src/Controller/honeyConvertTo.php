<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Render\Element\Value;

class honeyConvertTo{
    public static $unit = array (
        "cup" => "335.9553",
        "tbsp" => "20.9972",
        "tsp" => "6.9991",
        "kg" => "1000",
        "oz"=> "28.3495",
        "lb"=> "453.5924",
    );
    public static function convertTo($unit,$number){
        foreach(self::$unit as $name => $value){
            if($unit == $name){
                return ($number * $value);
            }
        }
    }
    public static function revertTo($unit,$number){
        foreach(self::$unit as $name => $value){
            if($unit == $name){
                return ($number / $value);
            }
        }
    }
    public static function honeyConvert($conversion_type_input,$number,$conversion_type_output){
        $number_output = honeyConvertTo::convertTo($conversion_type_input,$number);
        $result = honeyConvertTo::revertTo($conversion_type_output,$number_output);
        return $result;
    }
}
?>