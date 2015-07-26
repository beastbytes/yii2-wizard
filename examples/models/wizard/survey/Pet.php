<?php
namespace beastbytes\wizard\models\wizard\survey;

class Pet extends \yii\base\Model
{
    public $age;
    public $colour;
    public $gender;
    public $name;
    public $when;

    public function attributeLabels()
    {
        $class = strtolower(get_class($this));
        $pet = substr($class, strrpos($class, '\\') + 1);
        return [
            'age'          => strtr('How old is your pet?',       compact('pet')),
            'breed'        => strtr('What breed is your pet?',    compact('pet')),
            'colour'       => strtr('What colour is your pet?',   compact('pet')),
            'gender'       => strtr('What gender is your pet?',   compact('pet')),
            'microchipped' => strtr('Is your pet microchipped?',  compact('pet')),
            'name'         => strtr("What is your pet's name?",   compact('pet')),
            'neutered'     => strtr('Is your pet neutered?',      compact('pet')),
            'when'         => strtr('When did you get your pet?', compact('pet'))
        ];
    }

    public function rules()
    {
        return [
            [['age', 'colour', 'gender', 'name', 'when'], 'required'],
            ['age', 'integer'],
            [['colour', 'gender', 'name'], 'string'],
            ['when', 'date']
        ];
    }
}
