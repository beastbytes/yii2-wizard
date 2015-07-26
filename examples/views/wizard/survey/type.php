<?php
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

$this->title = 'Survey Wizard';

//echo $event->sender->menu->run();

$form = ActiveForm::begin(['options' => ['id' => 'wizard-form']]);
echo $form->field($model, 'type')->radiolist([
    'Cat'   => 'Cat',
    'Dog'   => 'Dog',
    'Other' => 'Other'
]);
echo $form->field($model, 'otherType');
echo Html::beginTag('div', ['class' => 'form-group buttons']);
echo Html::submitButton('Submit', ['class' => 'button']);
echo Html::endTag('div');
ActiveForm::end();

JqueryAsset::register($this);
$this->registerCss('#wizard-form .form-group{float:none;margin:0 10%;width:50%}#wizard-form .field-type-othertype{display:none;}');
$this->registerJs('jQuery(".field-type-type input").change(function(){if(jQuery(this).val()==="Other"){jQuery(".field-type-othertype").show();}else{jQuery(".field-type-othertype").hide();}});');
