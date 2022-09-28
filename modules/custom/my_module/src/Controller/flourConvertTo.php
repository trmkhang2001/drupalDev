<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Render\Element\Value;

class flourConvertTo{
    public static $unit = array (
        "cup" => "125.1552",
        "tbsp" => "7.8222",
        "tsp" => "2.6074",
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
    public static function flourConvert($conversion_type_input,$number,$conversion_type_output){
        $number_output = flourConvertTo::convertTo($conversion_type_input,$number);
        $result = flourConvertTo::revertTo($conversion_type_output,$number_output);
        return $result;
    }
}
?>