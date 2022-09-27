<?php

namespace Drupal\calculator\Controller;


class CalculatorController {

    public function add(int $first_digit,int $second_digit) {
        $sum = $first_digit + $second_digit;
        return array(
            '#title' => 'Sum',
            '#markup' => sprintf('Them sum of <strong>%s</strong> and <strong>%s</strong> is <strong>%s</strong>',$first_digit,$second_digit,$sum)
        );
    }
}
?>