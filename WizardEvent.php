<?php
/**
 * WizardEvent Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Wizard
 */

namespace beastbytes\wizard;

use yii\base\Event;

/**
 * WizardEvent class.
 * Represents events raised by WizardBehavior.
 */
class WizardEvent extends Event
{
    /**
     * @var boolean Whether the wizard can continue to run
     * An event handler can set this to FALSE to end the wizard.
     *
     * The following summarises what happens if it is set TRUE for the types of
     * events:
     * - beforeWizard - the wizard starts and moves to the first step
     * wizardStep - if Event::handled === FALSE the wizard returns Event::data.
     * If Event::handled === TRUE the wizard saves Event::data and moves to the
     * next step
     * - afterwizard - the wizard clears all data collected and resets
     *
     * The following summarises what happens if it is set FALSE for the types of
     * events:
     * - beforeWizard - the wizard ends; an `afterWizard` event is raised with
     * WizardEvent::step = FALSE
     * - wizardStep - the wizard ends; an `afterWizard` event is raised with
     * StepEvent::step = <currentStep> if StepEvent::handled === TRUE, or
     * StepEvent::step = NULL if StepEvent::handled === FALSE
     * - afterwizard - the wizard does not clear the data collected or reset
     */
    public $continue = true;
    /**
     * @var boolean|null|string
     * boolean: TRUE if all steps were completed, FALSE if no steps were processed
     * NULL: The wizard was cancelled
     * string: Name of the step that raised the event
     */
    public $step;
    /**
     * @var mixed Step data
     */
    public $stepData;
}
