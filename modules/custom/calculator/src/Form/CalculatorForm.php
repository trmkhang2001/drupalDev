<?php

namespace Drupal\calculator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

// Use for Ajax.
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class CalculatorForm extends ConfigFormBase {

    public function getFormId()
    {
        return 'calculator_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'calculator.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // $form['first_digit'] = array(
        //   '#type' => 'textfield',
        //   '#title' => $this->t('First Digit: '),
        //   '#required' => TRUE
        // );
        // $form['second_digit'] = array(
        //   '#type' => 'textfield',
        //   '#title' => $this->t('Second Digit: '),
        //   '#required' => TRUE
        // );
        // $form['type'] = array (
        //   '#type' => 'select',
        //   '#title' => ('Type: '),
        //   '#options' => array(
        //       'add' => $this->t('Add'),
        //       'subtract' => $this->t('Subtract'),
        //       'multiply' => $this->t('Multiply'),
        //       'divide' => $this->t('Divide'),
        //   ),
        //   '#required' =>TRUE,
        // );
        // $form['actions']['submit'] = array(
        //     '#type' => 'submit',
        //     '#value' => $this->t('Tính'),
        // );
        // return $form;

        // Add input field called title.
        $form['title'] = array (
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#description' => $this->t('Title must be at least 15 characters in length.'),
          '#required' => TRUE,
      );

      // Attach Ajax callback to the Submit button.
      $form['actions']['submit'] = array (
          '#type' => 'submit',
          '#value' => $this->t('Submit'),
          '#ajax' => [
              'callback' => '::setMessage',
          ],
      );

      // Placeholder to put the result of Ajax call, setMessage().
      $form['message'] = array (
          '#type' => 'markup',
          '#markup' => '<div class="result_message"></div>',
      );

      return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if($form_state->getValue('first_digit') < 0) {
            $form_state->setErrorByName('first_digit', $this->t('Vui lòng nhập giá trị hợp lệ !'));
          }
        if($form_state->getValue('second_digit') < 0) {
            $form_state->setErrorByName('second_digit', $this->t('Vui lòng nhập giá trị hợp lệ !'));
        }
    }
    public function setMessage(array $form, FormStateInterface $form_state) {

      $response = new AjaxResponse();
      $response->addCommand(
          new HtmlCommand(
              '.result_message',
              '<div class="my_message">Ket qu la: ' . $form_state->getValue('title') . '</div>')
          );
      return $response;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // $op = $form_state->getValue('type');
        // $first_digit = $form_state->getValue('first_digit');
        // $second_digit = $form_state->getValue('second_digit');
        // switch ($op) {
        //   case 'add':
        //     $form_state->setRedirect('calculator_add',['first_digit'=>$first_digit, 'second_digit'=>$second_digit]);
        //     break;

        //   default:
        //     break;
        // }
    }
}