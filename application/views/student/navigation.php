<?php

$buttons[] = array("item" => "student", "href" => site_url("student/view/$kStudent"), "text"=>"Student Info");

$buttons[] =array("item" => "narrative", "href"=>site_url("narrative/student_list/$kStudent"), "text"=>"Narratives");

$buttons[] = array("item" => "attendance", "href"=>  site_url("attendance/search/$kStudent"), "text" => "Attendance" );

$buttons[] = array("item" => "support", "href"=> site_url("support/list_all/$kStudent"), "text" => "Learning Support" );


$options["selection"] = $this->uri->segment(1);
$options["id"] = "student-buttons";
$button_bar = create_button_bar($buttons, $options);
echo $button_bar;
