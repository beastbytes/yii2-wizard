<?php
/**
 * StepEvent Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Wizard
 */

namespace beastbytes\wizard;
use yii\base\InvalidConfigException;

/**
 * StepEvent class.
 * Represents events raised while processing wizard steps.
 */
class StepEvent extends WizardEvent
{
    /**
     * @var mixed Branch directives for the step.
     * These are set by the event handler and only processed if
     * StepEvent::handled === TRUE
     */
    public $branches;
    /**
     * @var integer Repetition index of the step
     * WizardBehavior sets this value allowing the event handler to determine
     * whether a step should be repeated
     * @see $t
     */
    public $n;
    /**
     * @var integer|string The next step to be processed.
     * This is set by the event handler; it is only valid if
     * StepEvent::handled === TRUE
     * Integer values are:
     * WizardBehavior::DIRECTION_FORWARD (default) - moves to the next step
     * WizardBehavior::DIRECTION_BACKWARD - moves to the previous step (which may
     * be an earlier repeated step). If WizardBehavior::forwardOnly === TRUE
     * this results in an invalid step
     * WizardBehavior::DIRECTION_REPEAT - repeats the current step to get another
     * set of data
     *
     * If a string it is the name of the step to return to. This allows multiple
     * steps to be repeated. If WizardBehavior::forward === TRUE this results in
     * an invalid step. Note that WizardBehavior::autoAdvance must be FALSE to
     * use this feature.
     */
    public $nextStep = WizardBehavior::DIRECTION_FORWARD;
    /**
     * @var integer Total number of repetitions of the step
     * WizardBehavior sets this value allowing the event handler to determine
     * whether a step should be repeated
     * @see $n
     */
    public $t;

    /**
     * Set next step by direction constant or by step name
     *
     * @param integer|string $step
     * @throws InvalidConfigException
     * @see StepEvent::$nextStep for more info
     * @see WizardBehavior for direction constants
     */
    public function setNextStep($step)
    {
        /** @var WizardBehavior $wizardBehavior */
        $wizardBehavior = $this->sender;
        if (is_string($step) && $wizardBehavior->autoAdvance !== false) {
            throw new InvalidConfigException('WizardBehavior::autoAdvance must be FALSE to continue to named step');
        }

        // Assign next step
        $this->nextStep = $step;

        // Must be TRUE to continue to next step
        $this->handled = true;
    }
}
