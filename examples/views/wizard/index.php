
<p style="font-size:120%;font-weight: bold;">Welcome to the Wizard Behavior Demo</p>

<p>Wizard Behavior is an extension for the Yii PHP Framework that simplifies the handling of multi-step forms. It features data persistence, Plot-Branching Navigation (PBN), step repetition, Forward Only navigation, optional step timeout, invalid step handling, pause and restart between sessions, and has utility methods for use in views to assist navigation; the demos below demonstrate these features.</p>

<div id="demos">
<h2>The Demos</h2>
<ul>
<li><a href="/wizard/registration">Registration Wizard&nbsp;&raquo;</a><p>A Four step registration wizard.</p><p>You can return to previous steps either using the "Previous" button or the menu; note that $autoAdvance===TRUE, so if you go back two steps the "Next" button goes to the first uncompleted step.</p><p>You can save your registration by clicking the Save button, and then resume it later by going to the provided URL.</p></li>
<li><a href="/wizard/quiz">Quiz Wizard&nbsp;&raquo;</a><p>10 General knowledge questions, but you need to be quick with your answers.</p><p>This demonstrates the step timeout feature &ndash; you have 30 seconds to answer each question, and step repetition &ndash; the quiz only has one step.</p></li>
<li><a href="/wizard/survey">Survey Wizard&nbsp;&raquo;</a><p>A short survey about your pets that demonstrates the Plot-Branching Navigation (PBN) feature of the Wizard Behavior.</p><p>PBN allows the wizard to present different forms depending on the results of previous steps; an "if this then that" mechanism.</p><p>Give different answers to see what happens.</p></li>
</ul>
<p><b>Note:</b> No data is stored on completion of the Wizards; they either display what you have entered, or in the case of the quiz, how well you did.</p>
</div>

<p><a href="http://www.yiiframework.com/extension/wizard-behaviour/">Download The Wizard Behavior and/or the code for this demo</a></p>
<p><a href="/documents/wizard_behavior_manual.pdf">The Wizard Behavior manual (PDF - 1.5MB)</a></p>
<p><a href="http://www.yiiframework.com/forum/index.php?/topic/16471-wizard-behavior/">Comments, suggestions, &amp; bug reports</a></p>
