<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Render\Element\Value;

class sugarConvertTo{
    public static $unit = array (
        "cup" => "194.7121",
        "tbsp" => "12.1695",
        "tsp" => "4.0565",
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
    public static function sugarConvert($conversion_type_input,$number,$conversion_type_output){
        $number_output = sugarConvertTo::convertTo($conversion_type_input,$number);
        $result = sugarConvertTo::revertTo($conversion_type_output,$number_output);
        return $result;
    }
}
?>