<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<h3><?php echo $title;?></h3>
<form id="missing_narratives_search" name="missing_narratives_search" method="get" action="<?php  echo site_url("narrative/show_missing");?>">
<input type="hidden" name="kTeach" id="kTeach" value="<?php  echo $kTeach;?>"/>
<label for="subject">Subject: </label>
<?php  echo form_dropdown("subject", $subjects, $subject, "id='subject'"); ?>
<br/>
<p><label for="gradeStart">Grade Range: </label><?php  echo form_dropdown("gradeStart", $grades, $gradeStart, "id='gradeStart'") . "-" . form_dropdown("gradeEnd", $grades, $gradeEnd, "id='gradeEnd'");?></p>
<input type="submit" class="button" value="Search"/>
</form>
