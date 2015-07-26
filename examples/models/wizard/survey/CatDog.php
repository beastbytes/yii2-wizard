<?php
namespace beastbytes\wizard\models\wizard\survey;

class CatDog extends Pet
{
    public $breed;
    public $microchipped;
    public $neutered;

    public function attributeLables()
    {
        $class = strtolower(get_class($this));
        $pet = substr($class, strrpos($class, '\\') + 1);
        $labels = array_merge([
            'breed'        => 'What breed is your pet?',
            'microchipped' => 'Is your pet microchipped?',
            'neutered'     => 'Is your pet neutered?',
        ], parent::attributeLables());

        foreach ($labels as &$label) {
            $label = strtr($label, compact('pet'));
        }

        return $labels;
    }

    public function rules()
    {
        return array_merge([
            [['breed', 'microchipped', 'neutered'], 'required'],
            [['breed'], 'string'],
            [['microchipped', 'neutered'], 'boolean']
        ], parent::rules());
    }

    public function getBreeds()
    {
        return $this->breeds;
    }

    /**
    * Method description
    *
    * @return mixed The return value
    */
    public function beforeValidate()
    {
        $this->breed = $this->breeds[$this->breed];
        return parent::beforeValidate();
    }
}
