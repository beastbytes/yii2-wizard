<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Registration Wizard Cancelled';

echo Html::tag('h1', $this->title);
echo Html::tag('div', 'The Registration Wizard has been cancelled');
echo Html::a('Choose Another Demo', '/wizard');
