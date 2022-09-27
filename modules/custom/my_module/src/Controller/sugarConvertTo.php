<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Render\Element\Value;
use ReflectionClass;

class sugarUnit{
    const cup = 194.7121;
    const tbsp = 12.1695;
    const tsp = 4.0565;
    const kg = 1000;
    const oz = 28.3495;
    const lb = 453.5924;
}

class sugarConvertTo{
    public static function convertTo($unit,$number){
        $sugarUnitClass = new ReflectionClass('sugarUnit');
        $constants = $sugarUnitClass->getConstants();
        foreach($constants as $name => $value){
            if($unit == $name){
                return ($number * $value);
            }
        }
    }
    public static function revertTo($unit,$number){
        $sugarUnitClass = new ReflectionClass('sugarUnit');
        $constants = $sugarUnitClass->getConstants();
        foreach($constants as $name => $value){
            if($unit == $name){
                return ($number / $value);
            }
        }
    }
    public function sugarConvert($conversion_type_input,$number,$conversion_type_output){
        $number_output = sugarConvertTo::convertTo($conversion_type_input,$number);
        $result = sugarConvertTo::revertTo($conversion_type_output,$number_output);
        return [
            '#title' => 'Result',
            '#markup' => sprintf('Result = <strong>%s</strong> '),
        ];
    }
}
?>