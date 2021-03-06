<?php defined('BASEPATH') OR exit('No direct script access allowed');
//use first record for student name
?>
<input
	type="hidden" name="kStudent" id="kStudent" value="<?php  echo $kStudent;?>" />
<input
	type="hidden" name="kTeach" id="kTeach" value="<?php  echo $kTeach;?>" />
<h3>
	<?php  echo $title;?>
</h3>
<table class='grade-editor'>
	<thead>
		<tr>
			<th class='grade-date'>Date</th>
			<th class='grade-assignment'>Assignment</th>
			<th class='grade-category'>Category</th>
			<th class='grade-total-points'>Total Points</th>
			<th class='grade-points'>Points</th>
			<th class='grade-status'>Status</th>
			<th class='grade-footnote'>Footnote</th>
			<th class='grade-confirmation'></th>
		</tr>
	</thead>
	<tbody>
		<?php
		//tabindex is set to allow editors to tab down to the grade point value fields (see below)
		$tabindex = 1;
		foreach($grades as $grade){
			?>
		<tr id="<?php  echo get_value($grade, "kGrade",0);?>">
			<td class='grade-description'><?php  echo format_date($grade->date);?>
			</td>
			<td class='grade-description'><?php  echo $grade->assignment;?>
			</td>

			<td class='grade-description'><?php  echo $grade->category;?>
			</td>
			<td class='grade-description'><?php  echo $grade->total_points;?>
			</td>
			<td class='grade-value'><input type="text"
				id="g_<?php  echo $grade->kAssignment;?>_<?php  echo $kStudent;?>" name="points" size="2"
				class="assignment-grade assignment-string assignment-field"
				value="<?php  echo get_value($grade,"points");?>" autocomplete='off' tabindex="<?php  echo $tabindex;?>" />
			</td>
			<td class='grade-status'><?php  echo form_dropdown("status",$status, get_value($grade,"status"),sprintf("id='status_%s_%s' class='assignment-field'",$grade->kAssignment,$kStudent));?>
			</td>
			<td class='grade-footnote'><?php  echo form_dropdown("footnote",$footnotes, get_value($grade,"footnote"),sprintf("id='footnote_%s_%s'  class='assignment-field'",$grade->kAssignment,$kStudent));?>
			</td>
			<td class='grade-button'><span style='margin-left: 5px;'
				id='save_<?php  echo $grade->kAssignment;?>'></span>
			</td>
		</tr>

		<?php
		//increment the tabindex for the next row item.
		$tabindex++;
} ?>
	</tbody>
</table>
<div class='button-box'>
	<span class='button close_grade_editor small' tabindex="<?php  echo $tabindex;?>">Close</span>
</div>
