<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Render\Element\Value;

class milkConvertTo{
    public static $unit = array (
        "cup" => "244.8688",
        "tbsp" => "15.3043",
        "tsp" => "5.1014",
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
    public static function milkConvert($conversion_type_input,$number,$conversion_type_output){
        $number_output = milkConvertTo::convertTo($conversion_type_input,$number);
        $result = milkConvertTo::revertTo($conversion_type_output,$number_output);
        return $result;
    }
}
?>