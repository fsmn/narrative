<?php
$current_year = get_current_year();
?>
<h3><?php echo $title;?></h3>
<form id="legend_search" name="legend_search" action="<?php  echo site_url("benchmark_legend/list_all");?>" method="get">
<input type="hidden" name="kTeach" id="kTeach" value="<?php  echo $kTeach;?>" />
<p>
<label for="subject">Subject: </label>
<?php  echo form_dropdown("subject", $subjects, get_cookie("benchmark_subject"), "id='subject'");?></p>
<p>
<label for="gradeStart">Grade Range: </label>
<input type="text" id="gradeStart" name="gradeStart" size="2" maxlength="1" value="<?php echo $grades->gradeStart;?>"/>-
<input type="text" id="gradeEnd" name="gradeEnd" size="2" maxlength="1" value="<?php echo $grades->gradeEnd;?>"/>
</p>
<p>
<label for="term">Term: </label><?php  echo get_term_menu("term", get_current_term(),TRUE);?>
</p>
<p>
<label for="year">School Year: </label><?php  echo form_dropdown("year", $years, $current_year ,"id='year' class='year'"); ?>-
<input type="text" id="yearEnd" name="yearEnd" class='yearEnd' size="5" maxlength="4"
	readonly value="<?php  echo $current_year + 1?>" />
	</p>
<p><input type="submit" class="button" value="Find" />

</form>
