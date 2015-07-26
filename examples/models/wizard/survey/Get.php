<?php
namespace beastbytes\wizard\models\wizard\survey;

class Get extends \yii\base\Model
{
    public $otherType;
    public $type;
    public $when;

    public function attributeLabels()
    {
        return [
            'otherType' => 'Please specify',
            'type'      => 'What type of animal will you get?',
            'when'      => 'When will you get a pet?'
        ];
    }

    /**
    * Method description
    *
    * @return mixed The return value
    */
    public function beforeValidate()
    {
        if (!empty($this->otherType)) {
            $this->type = $this->otherType;
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['type', 'otherType'], 'string'],
            ['when', 'date']
        ];
    }
}
