<?php
namespace beastbytes\wizard\controllers;

use Yii;
use yii\web\Controller;
use beastbytes\wizard\WizardBehavior;

class WizardController extends Controller
{
    public $questions = [
        [
            'question' => 'What is the capital of England?',
            'answer'   => 'London'
        ],
        [
            'question' => 'What is the lightest metal?',
            'answer'   => 'Lithium'
        ],
        [
            'question' => 'Against which disease did Edward Jenner discover a vaccine?',
            'answer'   => 'Smallpox'
        ],
        [
            'question' => 'In which year was the Great Fire of London?',
            'answer'   => '1666'
        ],
        [
            'question' => "What was the name of Yuri Gagarin's 1961 spaceship?",
            'answer'   => 'Vostock'
        ],
        [
            'question' => 'Which creatures live in a formicary?',
            'answer'   => 'Ants'
        ],
        [
            'question' => 'The Muses were the goddesses of poetry and song; how many Muses were there?',
            'answer'   => '9'
        ],
        [
            'question' => 'What nationality was explorer Ferdinand Magellan?',
            'answer'   => 'Portuguese'
        ],
        [
            'question' => 'What is the name of the probe that landed on comet 67P on 12 November 2014?',
            'answer'   => 'Philae'
        ],
        [
            'question' => 'Which part of the world was once known as the "Dark Continent"?',
            'answer'   => 'Africa'
        ]
    ];

    public function beforeAction($action)
    {
        $config = [];
        switch ($action->id) {
            case 'quiz':
                $config = [
                    'steps'       => ['question'],
                    'timeout'     => 30,
                    'forwardOnly' => true,
                    'events'      => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id.'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id.'AfterWizard'],
                        WizardBehavior::EVENT_STEP_EXPIRED => [$this, $action->id.'StepExpired']
                    ]
                ];
                break;
            case 'registration':
                $config = [
                    'steps' => ['profile', 'address', 'phoneNumber', 'user'],
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id.'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id.'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;
            case 'survey':
                $config = [
                    'steps' => [
                        'havePet',
                        [
                            'hasPet' => [
                                'type',
                                [
                                    'cat' => ['cat'],
                                    'dog' => ['dog'],
                                    'pet' => ['pet']
                                ]
                            ],
                            'noPet' => [
                                'getPet',
                                [
                                    'willGet' => [
                                        'get'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'autoAdvance'   => false,
                    'defaultBranch' => false,
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id.'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id.'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;
            case 'resume':
                $config = ['steps' => []]; // force attachment of WizardBehavior
            default:
                break;
        }

        if (!empty($config)) {
            $config['class'] = WizardBehavior::className();
            $this->attachBehavior('wizard', $config);
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegistration($step = null)
    {
        //if ($step===null) $this->resetWizard();
        return $this->step($step);
    }

    public function actionSurvey($step = null)
    {
        //if ($step===null) $this->resetWizard();
        return $this->step($step);
    }

    public function actionQuiz($step = null)
    {
        //if ($step===null) $this->resetWizard();
        return $this->step($step);
    }

    /**
    * Process wizard steps.
    * The event handler must set $event->handled=true for the wizard to continue
    * @param WizardEvent The event
    */
    public function registrationWizardStep($event)
    {
        if (empty($event->stepData)) {
            $modelName = 'backend\\models\\wizard\\registration\\'.ucfirst($event->step);
            $model = new $modelName();
        } else {
            $model = $event->stepData;
        }

        $post = Yii::$app->request->post();
        if (isset($post['cancel'])) {
            $event->continue = false;
        } elseif (isset($post['prev'])) {
            $event->nextStep = WizardBehavior::DIRECTION_BACKWARD;
            $event->handled  = true;
        } elseif ($model->load($post) && $model->validate()) {
            $event->data    = $model;
            $event->handled = true;

            if (isset($post['pause'])) {
                $event->continue = false;
            } elseif ($event->n < 2 && isset($post['add'])) {
                $event->nextStep = WizardBehavior::DIRECTION_REPEAT;
            }
        } else {
            $event->data = $this->render('registration\\'.$event->step, compact('event', 'model'));
        }
    }

    /**
    * @param WizardEvent The event
    */
    public function invalidStep($event)
    {
        $event->data = $this->render('invalidStep', compact('event'));
        $event->continue = false;
    }

    /**
    * Registration wizard has ended; the reason can be determined by the
    * step parameter: TRUE = wizard completed, FALSE = wizard did not start,
    * <string> = the step the wizard stopped at
    * @param WizardEvent The event
    */
    public function registrationAfterWizard($event)
    {
        if (is_string($event->step)) {
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );

            $registrationDir = Yii::getAlias('@runtime/registration');
            $registrationDirReady = true;
            if (!file_exists($registrationDir)) {
                if (!mkdir($registrationDir) || !chmod($registrationDir, 0775)) {
                    $registrationDirReady = false;
                }
            }
            if ($registrationDirReady && file_put_contents(
                $registrationDir.DIRECTORY_SEPARATOR.$uuid,
                $event->sender->pauseWizard()
            )) {
                $event->data = $this->render('registration\\paused', compact('uuid'));
            } else {
                $event->data = $this->render('registration\\notPaused');
            }
        } elseif ($event->step === null) {
            $event->data = $this->render('registration\\cancelled');
        } elseif ($event->step) {
            $event->data = $this->render('registration\\complete', [
                'data' => $event->stepData
            ]);
        } else {
            $event->data = $this->render('registration\\notStarted');
        }
    }

    /**
    * Method description
    *
    * @return mixed The return value
    */
    public function actionResume($uuid)
    {
        $registrationFile = Yii::getAlias('@runtime/registration').DIRECTORY_SEPARATOR.$uuid;
        if (file_exists($registrationFile)) {
            $this->resumeWizard(@file_get_contents($registrationFile));
            unlink($registrationFile);
            $this->redirect(['registration']);
        } else {
            return $this->render('registration\\notResumed');
        }
    }

    /**
    * Process wizard steps.
    * The event handler must set $event->handled=true for the wizard to continue
    * @param WizardEvent The event
    */
    public function surveyAfterWizard($event)
    {
        $event->data = $this->render('survey\result', [
            'data' => $event->stepData
        ]);
    }

    /**
    * Process wizard steps.
    * The event handler must set $event->handled=true for the wizard to continue
    * @param WizardEvent The event
    */
    public function surveyWizardStep($event)
    {
        $modelName = 'backend\\models\\wizard\\survey\\'.ucfirst($event->step);
        $model = new $modelName();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $event->data    = $model;
            $event->handled = true;

            switch ($event->step) {
                case 'cat':
                case 'dog':
                case 'pet':
                    if (isset($post['add'])) {
                        $event->nextStep = 'type';
                    }
                    break;
                case 'havePet':
                    $event->branches = ($model->answer == 1
                        ? [
                            'hasPet' => WizardBehavior::BRANCH_SELECT,
                            'noPet'  => WizardBehavior::BRANCH_DESELECT,
                        ]
                        : [
                            'hasPet' => WizardBehavior::BRANCH_DESELECT,
                            'noPet'  => WizardBehavior::BRANCH_SELECT,
                        ]
                    );
                    break;
                case 'type':
                    switch ($model->type) {
                        case 'Cat':
                            $event->branches = [
                                'cat' => WizardBehavior::BRANCH_SELECT,
                                'dog' => WizardBehavior::BRANCH_DESELECT,
                                'pet' => WizardBehavior::BRANCH_DESELECT
                            ];
                            break;
                        case 'Dog':
                            $event->branches = [
                                'cat' => WizardBehavior::BRANCH_DESELECT,
                                'dog' => WizardBehavior::BRANCH_SELECT,
                                'pet' => WizardBehavior::BRANCH_DESELECT
                            ];
                            break;
                        default:
                            $event->branches = [
                                'cat' => WizardBehavior::BRANCH_DESELECT,
                                'dog' => WizardBehavior::BRANCH_DESELECT,
                                'pet' => WizardBehavior::BRANCH_SELECT
                            ];
                            break;
                    }
                    break;
                case 'getPet':
                    $event->branches = ($model->answer == 1
                        ? ['willGet' => WizardBehavior::BRANCH_SELECT]
                        : ['willGet' => WizardBehavior::BRANCH_SKIP]
                    );
                    break;
                default:
                    break;
            }
        } else {
            $view = ($model instanceof \backend\models\wizard\survey\CatDog
                ? 'catDog'
                : $event->step
            );
            $event->data = $this->render('survey\\'.$view, compact('event', 'model'));
        }
    }

    /**
    * Quiz step expired
    * @param WizardEvent The event
    */
    public function quizAfterWizard($event)
    {
        $event->data = $this->render('quiz\result', ['models' => $event->stepData['question']]);
    }

    /**
    * Quiz step expired
    * @param WizardEvent The event
    */
    public function quizStepExpired($event)
    {
        $n = count($event->stepData) - 1;
        $event->stepData[$n]->expired = true;
    }

    /**
    * Process steps from the quiz
    * @param WizardEvent The event
    */
    public function quizWizardStep($event)
    {
        $modelName = 'backend\\models\\wizard\\quiz\\Question';
        $model = new $modelName(['question' => $this->questions[$event->n]]);
        $t = count($this->questions);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $event->data     = $model;
            $event->nextStep = ($event->n < $t - 1
                ? WizardBehavior::DIRECTION_REPEAT
                : WizardBehavior::DIRECTION_FORWARD
            );
            $event->handled  = true;
        } else {
            $event->data = $this->render('quiz\question', compact('event', 'model', 't'));
        }
    }
}
