<?php #student_search.inc$saved_grades = array();if($refine && get_cookie("grades") ){	$saved_grades = explode(",",get_cookie("grades"));}$lower_school = implode("\r", create_grade_checklist(0, 4,"grades", $saved_grades));$middle_school = implode("\r", create_grade_checklist(5,8,"grades", $saved_grades));$needs_checked = "";if($refine && get_cookie("hasNeeds")){	$needs_checked = "checked";}$former_students_checked = "";if($refine && get_cookie("includeFormerStudents")){	$former_students_checked = "checked";}$sorting = "last_first";if($refine && get_cookie("sorting")){	$sorting = get_cookie("sorting");}?><div id="student-search">	<h2>Student Search</h2>	<h4>Search for groups of students by class &amp; year</h4>	<form id="searchForm"		action="<?php  echo site_url("student/search");?>" method="get"		name="searchForm">		<fieldset><legend>School Year</legend>		<p class="center">			School Year<br />			<?php  echo form_dropdown('year', $yearList, $currentYear,"id='year' class='year'"); ?>			- <input type="text" id='yearEnd' name="yearEnd" size="5"				maxlength="4" readonly value="<?php  echo $currentYear + 1?>" />		</p>		</fieldset>				<fieldset>			<legend>Grades</legend>			<ul class="search">				<?php  echo $lower_school;?>			</ul>			<ul class="search">				<?php  echo $middle_school;?>			</ul>			<div id="stuGroup-menu">			<label for="stuGroup">Middle School Specialist Group:</label><?php echo form_dropdown("stuGroup",array("0"=>"","A"=>"A","B"=>"B"),$refine?get_cookie("stuGroup"):"");?></div><div id="kTeach-menu"><label for="kTeach">Classroom Teacher/Advisor</label><?php echo form_dropdown("kTeach",$teachers,$refine?get_cookie("kTeach"):"");?></div ><div id="humanitiesTeacher-menu"><label for="humanitiesTeacher">Humanities Teacher</label><?php echo form_dropdown("humanitiesTeacher",$humanitiesTeachers,$refine?get_cookie("humanitiesTeacher"):"");?></div>		</fieldset>		<fieldset>			<legend>Sorting</legend>			<label for="sorting">Sorting Order: </label>			<?php  echo form_dropdown("sorting",$student_sort,$sorting,"id='sorting'");?>		</fieldset>				<fieldset class='advanced'>			<legend>Advanced</legend>			<div class='advanced'>				<input type="checkbox" name="hasNeeds" id="hasNeeds" value="1"				<?php  echo $needs_checked;?> /> <label for="hasNeeds">Only Show Students					with Learning Support</label><br />					<input type="checkbox"					name="includeFormerStudents" id="includeFormerStudents" value="1"					<?php  echo $former_students_checked;?> /> <label					for="includeFormerStudents">Include Former Students</label>					<br/>					<input type="checkbox" name="grouping" id="grouping" value="1" checked="checked"/>					<label for="grouping">Group by Grade</label><br/>								</div>			<p>			<label for="baseYear">Year Enrolled</label>			<input type="text" length=4 name="baseYear" size="5" class="year" value="<?php echo $refine?get_cookie("baseYear"):"" ?>" id="baseYear"/>			- <input type="text" id='yearEnd' size="5"				maxlength="4" readonly value="" /><a href="<?php echo base_url("help/get/10")?>" class="dialog help button">Help			title="What does this do?">Help</a>			</p>		</fieldset>		<p style="text-align: center;">			<input type="submit" class="button" value="Search" />		</p>	</form></div>