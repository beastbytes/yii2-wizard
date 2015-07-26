<?php
namespace beastbytes\wizard\models\wizard\quiz;

use yii\base\Model;

class Question extends Model
{
	public $answer;
    public $question;
    public $expired = false;
	protected $_c;

    public function getCorrectAnswer() {
        return $this->question['answer'];
    }

    public function getIsAnswerCorrect() {
        if (is_null($this->_c))
        $this->_c = strtolower($this->answer) === strtolower($this->correctAnswer);
        return $this->_c;
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'answer' => $this->question['question']
        ];
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            ['answer', 'safe']
        ];
    }
}
