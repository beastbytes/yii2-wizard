<?php
use yii\helpers\Html;

$correctAnswers = 0;
$tbody = '<tbody>';
foreach ($models as $model):
	if ($model->isAnswerCorrect)
		$correctAnswers++;

	$tbody .= '<tr>';
	$tbody .= '<th>'.$model->getAttributeLabel('answer').'</th>';
	$tbody .= '<td>'.$model->correctAnswer.'</td>';
    $tbody .= '<td>'.htmlentities($model->answer).'</td>';
    $tbody .= '<td>'.($model->isAnswerCorrect?'Yes':'No').'</td>';
    $tbody .= '<td>'.($model->expired?'Yes':'No').'</td>';
    $tbody .= '</tr>';
endforeach;
$tbody .= '</tbody>';
?>
<h2>Quiz Results</h2>
<table>
<thead><tr><th>Question</th><th>Correct Answer</th><th>Your Answer</th><th>Correct</th><th>Expired</th></tr></thead>
<tfoot><tr><th colspan="3" style="font-weight:bold;padding-right:1em;text-align:right;">Your Score</th><td style="font-weight:bold;"><?php echo $correctAnswers.'/'.count($models); ?></td><td></td></tr></tfoot>
<?php echo $tbody; ?>
</table>
<?php
echo Html::a('Choose Another Demo', '/wizard');
