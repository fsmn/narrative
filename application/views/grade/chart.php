<?php defined('BASEPATH') OR exit('No direct script access allowed');
$table = array();
?>
<input
	type="hidden" name="kTeach" id="kTeach" value="<?=$kTeach;?>" />
<table class='grade-chart'>
	<thead>
		<tr>
			<th></th>
			<? foreach($assignments as $assignment){ ?>

			<th id="as_<?=$assignment->kAssignment;?>" class="assignment-edit"><?=$assignment->assignment;?><br />
				<?=$assignment->category;?><br /> <?=$assignment->points;?> Points</th>


			<? } ?>
		</tr>
	</thead>
	<tbody>
		<? $current_student = FALSE; ?>
		<? foreach($grades as $grade){ 
			if($current_student != $grade->kStudent){
				$rows[$grade->kStudent]["name"] = "<td><span class='student edit_student_grades' id='eg_$grade->kStudent'>$grade->stuNickname $grade->stuLast</span></td>";
				$current_student = $grade->kStudent;
			}
			//$rows[$grade->kStudent]["grades"][$grade->kAssignment] = "<td><input type='text' id='sag_" . $grade->kAssignment . "_" . $grade->kStudent . " name='grade' value='$grade->points' size='3' /></td>";
			$rows[$grade->kStudent]["grades"][$grade->kAssignment] = "<td>$grade->points</td>";
		}

		foreach($rows as $row){
			print "<tr>";
			print $row["name"];
			print implode("",$row["grades"]);
			print "</tr>";
		}

		?>

		<tr>
			<td><span class='button new grade_chart_add_student'>Add Student</span>
			</td>
		</tr>
	</tbody>
</table>

