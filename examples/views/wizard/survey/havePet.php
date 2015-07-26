<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Survey Wizard';

//echo $event->sender->menu->run();

$form = ActiveForm::begin(['options' => ['id' => 'wizard-form']]);
echo $form->field($model, 'answer')->radiolist(['No', 'Yes']);
echo Html::beginTag('div', ['class' => 'form-group buttons']);
echo Html::submitButton('Submit', ['class' => 'button']);
echo Html::endTag('div');
ActiveForm::end();

$this->registerCss('#wizard-form .form-group{float:none;margin:0 10%;width:50%}');
