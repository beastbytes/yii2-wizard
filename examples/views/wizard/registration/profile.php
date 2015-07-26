<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);

$form = ActiveForm::begin();
echo $form->field($model, 'honorific_prefix')->dropDownList([
    'Mr'  => 'Mr',
    'Mrs' => 'Mrs',
    'Ms'  => 'Ms'
]);
echo $form->field($model, 'given_name');
echo $form->field($model, 'family_name');
echo $form->field($model, 'date_of_birth')->widget(DatePicker::className(), [
    'clientOptions' => [
        'changeMonth' => true,
        'changeYear'  => true,
        'maxDate'     => 0,
        'showAnim'    => 'fade'
    ]
]);
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'pause']);
echo Html::endTag('div');
ActiveForm::end();
