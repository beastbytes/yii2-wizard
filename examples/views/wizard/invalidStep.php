<?php
use yii\helpers\Html;

$this->title = 'Invalid Step';

echo Html::tag('h1', $this->title);
echo Html::tag('div', strtr('An invalid step ({step}) was detected.', [
    '{step}' => $event->step
]));
echo Html::a('Choose Another Demo', '/wizard');
