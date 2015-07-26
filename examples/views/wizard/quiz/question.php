<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Quiz Wizard';

//echo $event->sender->menu->run();
echo Html::tag('h2', strtr('Question {n} of {t}', [
    '{n}' => $event->n + 1,
    '{t}' => $t
]));

$form = ActiveForm::begin();
echo $form->field($model, 'answer');
echo Html::beginTag('div', ['class' => 'form-row buttons']);
echo Html::submitButton('Submit', ['class' => 'button']);
echo Html::endTag('div');
ActiveForm::end();

echo Html::tag('div', Html::tag('div', '', [
    'id'    => 'meter',
    'style' => 'position:absolute;top:0;left:0;height:100%;width:100%;background:#0f0;z-index:-1;'
]).Html::tag('span', $event->sender->timeout, ['id' => 'time-left']) . ' seconds', ['style' => 'height:1.5em;position:relative;text-align:center;']);


$this->registerJs('function timeout(t) {
    var w;
    if (t) {
        jQuery("#time-left").text(t-1);
        w = t * 100 / 30;
        jQuery("#meter").css("width", w.toString()+"%");
        if (w < 25) {
            jQuery("#meter").css("background", "#f60");
        }
	} else {
	    jQuery("#question-answer").attr("readonly", true).css("background", "#fcc");
        jQuery("#meter").css("width", "100%");
    }
}', View::POS_END);
$this->registerJs('
	window.setInterval("timeout(parseInt(jQuery(\"#time-left\").text()));",1000);'
);
