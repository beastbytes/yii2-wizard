<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);

$form = ActiveForm::begin();
echo $form->field($model, 'username');
echo $form->field($model, 'password')->passwordInput();
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Prev', ['class' => 'button', 'name' => 'prev', 'value' => 'prev']);
echo Html::submitButton('Done', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
ActiveForm::end();
