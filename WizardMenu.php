<?php
/**
 * WizardMenu Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   Wizard
 */

namespace beastbytes\wizard;

use yii\base\Widget;
use yii\widgets\Menu;

/**
 * WizardMenu class.
 * Creates a menu from the wizard steps.
 */
class WizardMenu extends Widget
{
    /**
     * @var string The CSS class for the current step
     */
    public $currentStepCssClass = 'current-step';
    /**
     * @var array The item to be shown to indicate completion of the wizard.
     * e.g. ['label' => 'Done', 'url' => null]
     */
    public $finalItem;

    public $isShowEmptySteps = true;

    /**
     * @var string The CSS class for future steps
     */
    public $futureStepCssClass = 'future-step';
    /**
     * @var string The CSS class for past steps
     */
    public $pastStepCssClass = 'past-step';
    /**
     * @var string The current step
     */
    public $step;
    /**
     * @var \beastbytes\wizard\WizardBehavior The Wizard
     */
    public $wizard;

    public $widgetConfig = [];

    public $items = [];

    /**
     * Initialise the widget
     */
    public function init()
    {
        parent::init();
        $route  = ['/'.$this->wizard->owner->route];
        $params = $this->wizard->owner->actionParams;
        $steps  = $this->wizard->steps;
        $index  = array_search($this->step, $steps);

        foreach ($steps as $step) {
            $stepIndex = array_search($step, $steps);
            $params[$this->wizard->queryParam] = $step;

            if ($stepIndex == $index) {
                $active = true;
                $class  = $this->currentStepCssClass;
                $url    = array_merge($route, $params);
            } else if ($stepIndex < $index) {
                $active = false;
                $class  = $this->pastStepCssClass;
                $url    = ($this->wizard->forwardOnly
                    ? null : array_merge($route, $params)
                );
            } else {
                $active = false;
                $class  = $this->futureStepCssClass;
                if ($this->isShowEmptySteps) {
                    $url = null;
                } else {
                    $url = array_merge($route, $params);
                }
            }

            $this->items[] = [
                'label'   => $this->wizard->stepLabel($step),
                'url'     => $url,
                'active'  => $active,
                'options' => compact('class')
            ];

            if (!$this->isShowEmptySteps && !$this->wizard->read($step)) {
                break;
            }

            if (!empty($this->finalItem)) {
                $this->items[] = $this->finalItem;
            }
        }
    }

    public function run()
    {
        $widgetOptions = $this->widgetConfig;
        $widgetOptions['items'] = $this->items;
        if (empty($widgetOptions['class'])) {
            $widgetClass = Menu::class;
        } else {
            $widgetClass = $widgetOptions['class'];
        }

        $result = $widgetClass::widget($widgetOptions);

        return $result;
    }

    public function __set($name, $value)
    {
        $this->widgetConfig[$name] = $value;

        return $this;
    }
}
