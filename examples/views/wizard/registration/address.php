<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);

$form = ActiveForm::begin();
echo $form->field($model, 'street_address');
echo $form->field($model, 'locality');
echo $form->field($model, 'region');
echo $form->field($model, 'postal_code');
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Prev', ['class' => 'button', 'name' => 'prev', 'value' => 'prev']);
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
ActiveForm::end();
