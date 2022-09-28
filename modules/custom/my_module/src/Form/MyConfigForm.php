<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

// Use for Ajax.
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\my_module\Controller\flourConvertTo;
use Drupal\my_module\Controller\honeyConvertTo;
use Drupal\my_module\Controller\milkConvertTo;
use Drupal\my_module\Controller\sugarConvertTo;

class MyConfigForm extends ConfigFormBase {

    public function getFormId()
    {
        return 'my_module_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'my_module.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['ing_change'] = array (
          '#type' => 'select',
          '#title' => ('Nguyên liệu quy đổi: '),
          '#options' => array(
              'sugar' => $this->t('Đường'),
              'honey' => $this->t('Mật ông'),
              'flour' => $this->t('Bột'),
              'milk' => $this->t('Sữa'),
          ),
        );
        $form['unit_input'] = array (
          '#type' => 'select',
          '#title' => ('Kiểu đầu vào: '),
          '#options' => array(
              'cup' => $this->t('Cups'),
              'tbsp' => $this->t('Tablespoons'),
              'tsp' => $this->t('Teaspoon'),
              'kg' => $this->t('Kilogram'),
              'oz' => $this->t('Ounces'),
              'lb' => $this->t('Pounds'),
          ),
        );
        $form['unit_output'] = array (
          '#type' => 'select',
          '#title' => ('Kiểu đầu ra: '),
          '#options' => array(
              'cup' => $this->t('Cups'),
              'tbsp' => $this->t('Tablespoons'),
              'tsp' => $this->t('Teaspoon'),
              'kg' => $this->t('Kilogram'),
              'oz' => $this->t('Ounces'),
              'lb' => $this->t('Pounds'),
          ),
        );
        $form['input']=array(
           '#type'=>'textfield',
           '#title'=>('Giá trị đổi: '),
           '#placeholder'=>('Vui lòng nhập số lớn 0 !'),
           '#required' => TRUE,
        );
         $form['message'] = array (
          '#type' => 'markup',
          '#markup' => '<div class="result_message"></div>',
        );
        $form['actions']['submit'] = array (
          '#type' => 'submit',
          '#value' => $this->t('Quy đổi'),
          '#ajax' => [
              'callback' => '::setMessage',
          ],
        );
        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if($form_state->getValue('input') < 0) {
          $form_state->setErrorByName('input', $this->t('Vui lòng nhập giá trị hợp lệ ( lớn hơn 0) !'));
        }
    }
    public function setMessage(array $form, FormStateInterface $form_state) {
      $op_change = $form_state->getValue('ing_change');
      $op_input = $form_state->getValue('unit_input');
      $op_output = $form_state->getValue('unit_output');
      $number = $form_state->getValue('input');
      switch ($op_change) {
        case 'sugar':
          $result = sugarConvertTo::sugarConvert($op_input,$number,$op_output);
          break;
        case 'honey':
          $result = honeyConvertTo::honeyConvert($op_input,$number,$op_output);
          break;
        case 'flour':
          $result = flourConvertTo::flourConvert($op_input,$number,$op_output);
          break;
        case 'milk':
          $result = milkConvertTo::milkConvert($op_input,$number,$op_output);
          break;
      }
      $response = new AjaxResponse();
      $response->addCommand(
          new HtmlCommand(
              '.result_message',
              '<div class="my_message "> Ket qua la: ' . $result . '</div>')
          );
      return $response;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
      // Nothing to do. Use Ajax.
    }
}