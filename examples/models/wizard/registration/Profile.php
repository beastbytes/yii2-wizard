<?php
namespace beastbytes\wizard\models\wizard\registration;

use yii\base\Model;

class Profile extends Model
{
	public $honorific_prefix;
    public $given_name;
    public $family_name;
    public $date_of_birth;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['honorific_prefix', 'given_name', 'family_name', 'date_of_birth'], 'safe']
        ];
    }
}
