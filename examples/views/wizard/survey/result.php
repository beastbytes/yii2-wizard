<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

if ($data['havePet'][0]->answer == 1) {
    $catIndex = $dogIndex = $petIndex = 0;

    echo Html::tag('div', \Yii::t('app', 'You have {n, plural, =1{# pet} other{# pets}}', [
        'n' => count($data['type'])
    ]));

    foreach ($data['type'] as $type) {
        switch ($type->type) {
            case 'Cat':
                echo DetailView::widget([
                    'model'      => $data['cat'][$catIndex],
                    'attributes' => [
                        [
                            'label' => 'Type',
                            'value' => ucwords($type->type)
                        ],
                        'name',
                        'gender',
                        'colour',
                        'age',
                        'breed',
                        'when',
                        'microchipped:boolean',
                        'neutered:boolean'
                    ]
                ]);
                $catIndex++;
                break;
            case 'Dog':
                echo DetailView::widget([
                    'model'      => $data['dog'][$dogIndex],
                    'attributes' => [
                        [
                            'label' => 'Type',
                            'value' => ucwords($type->type)
                        ],
                        'name',
                        'gender',
                        'colour',
                        'age',
                        'breed',
                        'when',
                        'microchipped:boolean',
                        'neutered:boolean'
                    ]
                ]);
                $dogIndex++;
                break;
            default:
                echo DetailView::widget([
                    'model'      => $data['pet'][$petIndex],
                    'attributes' => [
                        [
                            'label' => 'Type',
                            'value' => ucwords($type->type)
                        ],
                        'name',
                        'colour',
                        'age',
                        'when'
                    ]
                ]);
                $petIndex++;
                break;
        }
    }
} else {
    echo Html::tag('div', 'You do not have any pets');
    if ($data['getPet'][0]->answer == 1) {
         echo Html::tag('div', strtr('You will get a pet on date', [
            'pet'  => $data['get'][0]['type'],
            'date' => $data['get'][0]['when']
         ]));
    } else {
         echo Html::tag('div', 'You do not plan to have any pets');
    }
}

echo Html::a('Choose Another Demo', '/wizard');
