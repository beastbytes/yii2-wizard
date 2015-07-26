<?php
namespace beastbytes\wizard\models\wizard\survey;

class Type extends \yii\base\Model
{
    public $otherType;
    public $type;

    public function attributeLabels()
    {
        return [
            'type'      => 'What type of animal is your pet',
            'otherType' => 'Please specify'
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
        return [[['type', 'otherType'], 'string']];
    }
}
