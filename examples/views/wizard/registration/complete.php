<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Registration Wizard Complete';

//echo $event->sender->menu->run();

echo Html::beginTag('div', ['class' => 'section']);
echo Html::tag('h2', 'Profile');
echo DetailView::widget([
    'model' => $data['profile'][0],
    'attributes' => [
        'honorific_prefix',
        'given_name',
        'family_name',
        'date_of_birth'
    ]
]);
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'section']);
echo Html::tag('h2', 'Address');
echo DetailView::widget([
    'model' => $data['address'][0],
    'attributes' => [
        'street_address',
        'locality',
        'region',
        'postal_code'
    ]
]);
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'section']);
echo Html::tag('h2', 'Phone Number(s)');
foreach ($data['phoneNumber'] as $phoneNumber) {
    echo DetailView::widget([
        'model' => $phoneNumber,
        'attributes' => [
            'type',
            'value'
        ]
    ]);
}
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'section']);
echo Html::tag('h2', 'User');
echo DetailView::widget([
    'model' => $data['user'][0],
    'attributes' => [
        'username',
        'password'
    ]
]);
echo Html::endTag('div');

echo Html::a('Choose Another Demo', '/wizard');
