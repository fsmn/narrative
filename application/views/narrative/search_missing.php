<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<form id="teacher_narratives_search" name="teacher_narratives_search" method="get" action="<?=site_url("narrative/show_missing");?>">
<input type="hidden" name="kTeach" id="kTeach" value="<?=$kTeach;?>"/>
<label for="subject">Subject: </label>
<?=form_dropdown("subject", $subjects, $subject, "id='subject'"); ?>
<br/>
<p><label for="gradeStart">Grade Range: </label><?=form_dropdown("gradeStart", $grades, $gradeStart, "id='gradeStart'") . "-" . form_dropdown("gradeEnd", $grades, $gradeEnd, "id='gradeEnd'");?></p>
<input type="submit" class="button" value="Search"/>
</form>
