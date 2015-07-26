
<?php
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

$this->title = 'Survey Wizard';

//echo $event->sender->menu->run();

$form = ActiveForm::begin(['options' => ['id' => 'wizard-form']]);
echo $form->field($model, 'when')->widget(DatePicker::className(), [
    'clientOptions' => [
        'changeMonth' => true,
        'changeYear'  => true,
        'minDate'     => 0,
        'showAnim'    => 'fade',
        'yearRange'   => 'c0:+5'
    ]
]);
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
$this->registerCss('#wizard-form .form-group{float:none;margin:0 10%;width:50%}#wizard-form .field-get-othertype{display:none;}');
$this->registerJs('jQuery(".field-get-type input").change(function(){if(jQuery(this).val()==="Other"){jQuery(".field-get-othertype").show();}else{jQuery(".field-get-othertype").hide();}});');
