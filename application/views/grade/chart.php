<?php defined('BASEPATH') OR exit('No direct script access allowed');
#student grade chart;
$header = $grades[0];
$teacher = format_name($header->teachFirst,$header->teachLast);
$year = format_schoolyear($header->year);
$student_total = 0;
$assignment_count = 0;
$assignment_total = 0;
?>

<div class='report-header report-teacher report-<?=$count;?>'>
	<?="$header->subject, $teacher";?>
</div>
<div class='report-body'>
<table class="report-card">
	<thead>
		<tr>
			<th class='date-column'>Date</th>
			<th class='assignment-column'>Assignment</th>
			<th class='category-colunn'>Category</th>
			<th class='points-column'>Points</th>
			<th class='totals-column'>Possible</th>
			<th class='notes-column'></th>
		</tr>
	</thead>
	<tbody>
			<?	foreach($grades as $grade){
					?>
					<tr>
						<td><?=format_date($grade->date,"standard");?></td>
						<td><?=$grade->assignment; ?>
						</td>
						<td><?=$grade->category;?>
						</td>
						<td><?=$grade->status?$grade->status:$grade->points;?>
						</td>
						<td><?=$grade->total_points;?>
						</td>
						<td class='notes-column'><?=$grade->footnote != 0 ? $grade->label:"";?>
						</td>
					</tr>
					<?
					$student_total += $grade->points*$grade->weight;
			
					$assignment_total += $grade->total_points * $grade->weight;
					
			}//end foreach grade
		?>

	</tbody>
	
</table>
</div>
<div class='report-header report-summary'><?=$header->subject; ?> Category Summary</div>
<div class='report-body'>
<table class="report-card">
<thead>
<tr>
<th class="category-column">Category</th>
<th class="points-column">Points</th>
<th class="totals-column">Possible</th>
<th class="weight-column">Weight</th>
<th class="percent-column">Percent</th>
<th class="grade-column">Grade</th>
</thead>
<tbody>
<? foreach($categories as $category): ?>
<? $category_grade = round($category->grade_points/$category->total_points*100,2); ?>
<tr>
<td><?=$category->category;?>
</td>
<td><?=$category->grade_points;?>
</td>
<td><?=$category->total_points; ?>
</td>
<td><?=$category->weight?>%
</td>
<td><?=$category_grade;?>%
</td>
<td><?=calculate_letter_grade($category_grade);?>
</td>
</tr>
<? endforeach; ?>
</tbody>
<tfoot>
		<?
		$grade_total = 0;
		$category_count = 0;
		$total_grade = round($student_total/$assignment_total*100,2);
		echo sprintf("<tr class='final-grade'><td class='label' colspan=4>Grade</td><td colspan=2>%s&#37; (%s)</td><tr>",$total_grade,calculate_letter_grade($total_grade));

		?>

	</tfoot>
</table>
</div>