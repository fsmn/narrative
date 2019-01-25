<?php defined('BASEPATH') OR exit('No direct script access allowed');//define variables outside the html for less clutter.$currentYear = get_current_year();$stuDOB = format_date($student->stuDOB, 'standard');//create a human-friendly version of the enrollment status.$enrollmentStatus = "Enrolled";if ($student->isEnrolled == 0) {    $enrollmentStatus = sprintf("Not Enrolled<br/>Year Departed: %s-%s", $student->yearDeparted, $student->yearDeparted + 1);}$graduateStatus = FALSE;if ($student->isGraduate == 1 && $student->stuGrade > 8) {    $graduateStatus = "Yes";}$teacherLabel = "Classroom Teacher";if ($student->stuGrade > 4) {    $teacherLabel = "Middle School Advisor";}?><?php $this->load->view("student/navigation", array("kStudent" => $student->kStudent)); ?><div class='content inner'>    <?php    if ($this->session->userdata("dbRole") != 3):        $edit_buttons[] = array("href" => site_url("student/edit/$student->kStudent"), "class" => "student_edit dialog button edit", "id" => "es_$student->kStudent", "text" => "Edit Info");        print create_button_bar($edit_buttons);    endif;    ?>    <div class="column-group">        <div class="block column-main" id="student-info">            <h3>General Info</h3>            <p>                <input type="hidden" name="target" value="student">            </p>            <p>                <label>First Name: </label>                <?php echo $student->stuFirst; ?>            </p>            <p>                <label>Last Name: </label>                <?php echo $student->stuLast; ?>            </p>            <p>                <label>Nickname: </label>                <?php echo $student->stuNickname; ?>            </p>            <p>                <label>Birthdate: </label>                <?php echo $stuDOB; ?>            </p>            <p>                <label>Grade at Enrollment:</label>                <?php echo format_grade($student->baseGrade); ?>            </p>            <p>                <label>School Year of Enrollment: </label>                <?php echo $student->baseYear; ?>                -                <?php echo $student->baseYear + 1; ?>            </p>            <p>                <label>Enrollment Status: </label>                <?php echo $enrollmentStatus; ?>            </p>            <p>                <label>Current Grade: </label>                <?php echo format_grade($student->stuGrade); ?>            </p>            <?php if ($student->stuGrade > 4): ?>                <p>                    <label>Group: </label>                    <?php if ($student->stuGrade < 7):                        print "5/6 $student->stuGroup";                    else:                        print "7/8 $student->stuGroup";                    endif; ?>                </p>            <?php endif; //current grade > 4?>            <p>                <label>Perferred Pronouns: </label>                <?php echo $student->pronouns; ?>            </p>            <p>                <label>Library ID</label>                    <?php echo get_value( $student, "stuLibraryID"); ?>            </p>            <?php if ($graduateStatus == "Yes") : ?>                <p>                    <label>Is a Graduate:</label>                    <?php echo $graduateStatus; ?>                </p>            <?php endif; ?>            <?php if ($student->isEnrolled == 1): ?>                <p>                    <label><?php echo $teacherLabel; ?>: </label>                    <?php echo format_name($student->teachFirst, $student->teachLast); ?>                </p>                <?php if ($student->stuGrade > 4): ?>                    <p>                        <label>Humanities Teacher: </label>                        <?php echo format_name($student->humanitiesFirst, $student->humanitiesLast); ?>                    </p>                <?php endif; //end if grade > 4 ?>            <?php endif; ?>        </div>        <div class="column-secondary">            <div class="block">                <h3>Email</h3>                <p>                    <label>Address: </label>                    <?php echo format_email(get_value($student, "stuEmail"), "TRUE"); ?>                </p>                <p>                    <label>Parent Permission to Use Email: </label>                    <?php if (get_value($student, 'stuEmailPermission') == 1):                        echo "Yes";                    else:                        echo "No";                    endif; ?>                </p>                <div class='password-box'>                    <label class='link' title='click to toggle'>Show Password</label>&nbsp;                    <span class='password-field'> <?php echo get_value($student, 'stuEmailPassword'); ?>				</span>                </div>            </div>            <!--  grade preferences are only used for middleschoolers and enrolled students.  -->            <?php if (get_value($student, "isEnrolled") == 1 && get_current_grade($student->baseGrade, $student->baseYear) > 4): ?>                <?php $this->load->view("course_preference/list", array('course_preferences' => $course_preferences)); ?>            <?php endif; ?>        </div>    </div></div>