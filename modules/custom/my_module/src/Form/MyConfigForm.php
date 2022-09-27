<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

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
           '#required' => TRUE,
        );
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Quy đổi'),
        );
        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if($form_state->getValue('input') < 0) {
          $form_state->setErrorByName('input', $this->t('Vui lòng nhập giá trị hợp lệ ( lớn hơn 0) !'));
        }
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
      $op_input = $form_state->getValue('unit_input');
      $op_output = $form_state->getValue(('unit_output'));
      $number = $form_state->getValue('input');
      $form_state->setRedirect('my_module_sugarConvert',['conversion_type_input'=>$op_input,'number'=>$number,'conversion_type_input'=>$op_output]);
    }
}