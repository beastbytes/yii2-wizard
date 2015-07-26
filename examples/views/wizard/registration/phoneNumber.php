<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);

$form = ActiveForm::begin();
echo $form->field($model, 'value');
echo $form->field($model, 'type')->radiolist([
    'Home'   => 'Home',
    'Mobile' => 'Mobile',
    'Work'   => 'Work'
]);
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Prev', ['class' => 'button', 'name' => 'prev', 'value' => 'prev']);
if ($event->n === 0) {
    echo Html::submitButton('Add Another', ['class' => 'button', 'name' => 'add', 'value' => 'add']);
}
echo Html::submitButton('Next', ['class' => 'button', 'name' => 'next', 'value' => 'next']);
echo Html::submitButton('Pause', ['class' => 'button', 'name' => 'pause', 'value' => 'pause']);
echo Html::submitButton('Cancel', ['class' => 'button', 'name' => 'cancel', 'value' => 'cancel']);
echo Html::endTag('div');
ActiveForm::end();
