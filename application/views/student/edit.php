<?php #student_edit.inc$baseGrade = get_value($student, 'baseGrade', 0);$baseYear = get_value($student, 'baseYear', get_current_year());$currentYear = get_current_year();$currentGrade = format_grade(get_current_grade($baseGrade, $baseYear, $currentYear));$stuDOB = get_value($student, 'stuDOB', NULL);$teacherLabel = get_teacher_type($currentGrade);?><h3><?php echo $title;?></h3><form id="studentEditor" action="<?php  echo site_url("student/$action");?>" method="post" name="studentEditor">	   <input type="hidden" id="kStudent" name="kStudent" value='<?php  echo get_value($student, 'kStudent'); ?>'>	<p><label for='stuFirst'>First Name</label>	<input  type="text" name="stuFirst"  id='stuFirst' required  value='<?php  echo get_value($student,'stuFirst'); ?>' size="24"/><!--	<span class='notice' id="stuFirstErr">-->	</p>	<p>	<label for='stuNickname'>Nickname</label>        <input type="text"  name="stuNickname"  id='stuNickname'  required value='<?php  echo get_value($student, 'stuNickname'); ?>' size="24"/>  </p>	<p><label for='stuLast'>Last Name</label>	<input  type="text" name="stuLast" id='stuLast' required value='<?php  echo get_value($student, 'stuLast');?>' size="24"/><!--	<span class='notice' id="stuLastErr">-->	</p>	<p><label for='stuDOB'>Birthdate: (mm/dd/yyyy)</label>		<input type="date" name="stuDOB" id='stuDOB' size="24"  required value='<?php  echo $stuDOB;?>' ><!--		<span class="notice" id="stuDOBErr"></span>-->		</p>	<p><label for='baseGrade'>Grade at Year of Enrollment</label>		<?php  echo form_dropdown('baseGrade', $gradePairs, get_value($student, 'baseGrade', 0), 'id="baseGrade" required');?><!--		<span class='notice' id="baseGradeErr"></span>-->		</p>	<p><label for='baseYear'>School Year of Enrollment</label>		<input type="text"  name="baseYear" id="baseYear" value="<?php  echo $baseYear; ?>" size="5" maxlength="4" required/>		<input type="text" id="baseYearEnd" name="baseYearEnd" readonly size="5" maxlength="4" value="<?php  echo $baseYear + 1; ?>"/><!--		<span class='notice' id="baseYearErr"></span>-->		</p>	<p><label for='stuGrade'>(Current Grade: <span id='gradeText'><?php  echo $currentGrade;?></span>)</label>	<input readonly type="hidden" name="stuGrade" id="stuGrade" value='<?php  echo $currentGrade; ?>'/></p>	<?php if($currentGrade > 4 ):?>		<p>		<label for="stuGroup">Middle School Group</label>		<?php  echo form_dropdown("stuGroup",array("A"=>"A","B"=>"B"), get_value($student,'stuGroup'),"id='stuGroup'");?><br/>		<span class='footnote highlight'>The grade part of this group (eg. 7/8, 5/6) is calculated by the student grade.</span>		</p>	<?php endif;?>	<p><label for='stuGender'>Preferred Pronouns:</label>		<?php  echo form_dropdown('stuGender', $genderPairs, get_value($student, 'stuGender', 0), 'id="stuGender"'); ?>		</p>		<fieldset><legend id='generate-email'>Email</legend>		<p><label for="stuEmail">Address&nbsp;</label>		<!-- &nbsp;<span class='link' id='generate-email'>Generate</span>  -->		<input type="text" name="stuEmail" id="stuEmail" value="<?php  echo get_value($student,'stuEmail');?>"/>		<br/><span id="valid-email"></span>		</p>		<p>		<label for="stuEmailPassword" id="stu-password-label">Password&nbsp;</label>		<input type="text" id="stuEmailPassword" name="stuEmailPassword" value="<?php  echo get_value($student, 'stuEmailPassword');?>"/>		</p>		<p>		<label for="stuEmailPermission">Parent Permission Received&nbsp;</label>		<input type="checkbox" id="stuEmailPermission" name="stuEmailPermission" value="1" <?php if(get_value($student, 'stuEmailPermission', 0) == 1){echo "checked";} ?>/>		</p>		</fieldset>		<p><label for='isEnrolled'>Is Enrolled</label>		<input type=checkbox value=1 id="isEnrolled" name="isEnrolled" <?php if(get_value($student, 'isEnrolled', 0) == 1){echo "checked";} ?>/></p>		<p><label for='isEnrolled'>Is Graduate</label>		<input type=checkbox value=1 id="isGraduate" name="isGraduate" <?php if(get_value($student, 'isGraduate', 0) == 1){echo "checked";} ?>/></p>		<p><label for='kTeach'><?php  echo $teacherLabel; ?></label><?php  echo form_dropdown('kTeach', $teacherPairs, get_value($student, 'kTeach', 0), 'id="kTeach"'); ?></p><?php if($action == "update" && $student->stuGrade > 4):?><p><label for="humanitiesTeacher">Humanities Teacher:</label><?php  echo form_dropdown("humanitiesTeacher",$humanitiesTeachers,get_value($student,"humanitiesTeacher"),"'id'='humanitiesTeacher'");?></p><?php endif;?><div class='button-box'><?php         $buttons[] = "<input type='submit' class='save_student button' value='Save'/>";        if($action == "update"){            $buttons[] = "<span class='delete_student delete button' id='delete-student_$student->kStudent'>Delete</span>";        }        $buttonBar=join("", $buttons);        echo $buttonBar;?></div></form>