<?php
namespace beastbytes\wizard\models\wizard\registration;

use yii\base\Model;

class PhoneNumber extends Model
{
	public $value;
    public $type;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['value', 'type'], 'safe']
        ];
    }
}
