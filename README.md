# yii2-wizard
Yii2 Extension to handle multi-form wizards.

## Features

- All forms submit to the same route - user friendly URLs
- Next/Previous or Forward Only navigation - registration forms will probably use Next/Previous navigation; tests will probably use Forward Only
- Looping - repeat one or more steps on a form as many times as needed
- Plot Branching Navigation (PBN) - allows the form to decide which path to take depending on a user's response to questions
- Step timeout - steps can have a timeout to ensure a user responds within a given time
- Save/Restore - save partially completed forms then restore and continue from that point later
- Event driven - write the handler functions and hook them up to events

For license information see the [LICENSE](LICENSE.md)-file.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist beastbytes/yii2-wizard
```

or add

```json
"beastbytes/yii2-wizard": "*"
```

to the require section of your composer.json.

## Usage

Below is a very short overview of how to use the extension; the examples folder shows how to implement PBN, looping, forward only navigation, and step timeout in examples of a quiz, survey, and registration.

Attach WizardBehavior to a controller.

The controller contains the event handlers; the two most important events are WizardBehavior::EVENT_WIZARD_STEP and WizardBehavior::EVENT_AFTER_WIZARD, these are responsible for handling the steps of the wizard and processing the data at the end of the wizard respectively.

### Controller Action

The controller action is very simple:
```php
public function actionWizard($step = null)
{
    return $this->step($step);
}
```

### WizardBehavior::EVENT_WIZARD_STEP

This event's handler is responsible for validating submitted data and deciding in what direction the Wizard should proceed; this and the data to be stored is placed into the event. When the event is marked as handled by handler the wizard will take the appropriate action.

### WizardBehavior::EVENT_AFTER_WIZARD

The handler for this event is responsible for taking the required action once the Wizard has completed; this could be rendering a page based on the user input and/or saving the data to persistant storage.