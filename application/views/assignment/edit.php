<?php defined('BASEPATH') OR exit('No direct script access allowed');
$year = get_value($assignment,"year",get_current_year());
$date = "";
if($date = get_value($assignment,"date")){
	$date = format_date($date,"standard");
}
?>

<form id="edit-assignment" name="edit-assignment" action="<?=base_url("assignment/$action");?>" method="post">
<input type="hidden" name="kTeach" id="kTeach" value="<?=get_value($assignment,"kTeach",$this->session->userdata("userID"));?>"/>
<input type="hidden" name="kAssignment" id="kAssignment" value="<?=get_value($assignment,"kAssignment");?>"/>
<p>
<label for="assignment">Assignment: </label>
<input type="text" name="assignment" id="assignment" value="<?=get_value($assignment,"assignment");?>" size="25"/>
</p>
<p>
<label for="category">Category: </label>
<span id="cat_span">
<?=form_dropdown("category",$categories,get_value($assignment,"category"),"id='category'");?>
</span>
</p>
<p>
<label for="points">Points: </label>
<input type="text" name="points" id="points" value="<?=get_value($assignment,"points");?>"/>
</p>
<p>
<label for="date">Date: </label>
<input type="text" name="date" id="date" class="datefield" value="<?=$date;?>"/>
</p>
<p>
<label for="semester">Semester: </label>
<input type="text" name="semester" id="semester" value="<?=get_value($assignment,"semester");?>" size="2"/>
</p>
<p>
<label for="gradeStart">Grade: </label>
<input type="text" id="gradeStart" name="gradeStart" value="<?=get_value($assignment,"gradeStart"); ?>" size="3"
	maxlength="1"> -<input type="text" id="gradeEnd" name="gradeEnd"
	value="<?=get_value($assignment,"gradeEnd");?>" size="3" maxlength="1"> </p>
<p>	<label for="term">Term:
</label><?=get_term_menu('term', get_value($assignment,"term",get_current_term()));?></p>
<p> <label for="year">Year: </label>
<?=form_dropdown('year',get_year_list(), get_value($assignment,"year",get_current_year()), "id='year' class='searchYear'");?>
-<input id="yearEnd" type="text" name="yearEnd" class='yearEnd' readonly
	maxlength="4" size="5" value="<? $yearEnd=$year+1;print $yearEnd; ?>" /></p>
<p>
<input type="submit" class="button" value="Save"/>
</p>

</form>