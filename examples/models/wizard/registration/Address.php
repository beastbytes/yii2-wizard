<?php
namespace beastbytes\wizard\models\wizard\registration;

use yii\base\Model;

class Address extends Model
{
    public $street_address;
    public $locality;
    public $region;
    public $postal_code;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['street_address', 'locality', 'region', 'postal_code'], 'safe']
        ];
    }
}
