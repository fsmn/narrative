<?php
$grades = "All Grades";
if(array_key_exists("grades", $criteria)){
	foreach($criteria["grades"] as $grade){
		$grade_list[] = format_grade_text($grade);
	}
	$grades = grammatical_implode(", ", $grade_list);
}

?>

<fieldset class='search_fieldset'><legend>Showing Student Search Results</legend>

<ul>
	<li>Year: <strong><?php  echo format_schoolyear($criteria["year"]);?></strong></li>
	<li>Grades: <strong><?php  echo $grades?></strong></li>
	<?php if(array_key_exists("grouping",$criteria)):?>
		<li><strong>Grouping by Grade</strong></li>
	<?php endif; ?>
	<?php if(array_key_exists("hasNeeds", $criteria)): ?>
		<li><strong>Showing only students with additional support requirements</strong></li>
	<?php endif; ?>

	<?php if(array_key_exists("includeFormerStudents", $criteria)): ?>
		<li><strong>Including former students</strong></li>
	<?php endif; ?>

	<?php if(array_key_exists("stuGroup",$criteria)):?>
	    <li>Specialist Group:<strong> <?php  echo $criteria["stuGroup"];?></strong>
    <?endif;?>
    
    <?php if(array_key_exists("kTeach",$criteria)):?>
    <li>Classroom Teacher or Advisor: <strong><?php echo $criteria['teacher']; ?></strong></li>
    <?php endif; ?>
        <?php if(array_key_exists("humanitiesTeacher",$criteria)):?>
    <li>Humanities Teacher: <strong><?php echo $criteria['humanitiesName'];?></strong></li>
    <?php endif; ?>
       <li>Found Count: <strong><?php  echo count($students);?></strong></li>
</ul>
<?php 
$buttons[] = array("text"=>"Modify Search","title"=>"Modify Search","class"=>"button search", "href"=>site_url("/home?refine=1"));
$buttons[] = array("text"=>"Export List","href"=>$_SERVER['REQUEST_URI']. "&export=true","title"=>"Export this list as a comma-separated list","class"=>"button export","type"=>"a");
echo create_button_bar($buttons);
?>
</fieldset>

<div class="page-list">
	<?php 
	$this->load->view("student/list"); ?>
</div>