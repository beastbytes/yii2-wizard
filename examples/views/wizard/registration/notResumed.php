<?php
use yii\helpers\Html;

$this->title = 'Registration Wizard NOT Resumed';

echo Html::tag('h1', $this->title);
echo Html::tag('div', 'The Registration Wizard was not successfully resumed; the data could not be read');
echo Html::a('Choose Another Demo', '/wizard');
