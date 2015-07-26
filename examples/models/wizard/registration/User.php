<?php
namespace beastbytes\wizard\models\wizard\registration;

use yii\base\Model;

class User extends Model
{
	public $username;
    public $password;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['username', 'password'], 'safe']
        ];
    }
}
