<?php

if($print): ?>
	<style type="text/css">
	body{
	font-size: 13px !important;
	font-family: georgia, serif;
	}
	a {
	display: none;
	}
	
	</style>
	
<?php endif;
// support/view.php

$has_iep = "No";

if ($entry->hasIEP == 1) {
	$has_iep = "Yes";
}

$has_spps = "No";

if ($entry->hasSPPS == 1) {
	$has_spps = "Yes";
}
$files_array = array ();
if ($support_files) {
	foreach ( $support_files as $file_item ) {
		if ($file_item->kSupport == $entry->kSupport) {
			$files_array [] = $file_item;
		}
	}
}

$year = $entry->year;
$year_end = $year + 1;
$test_date = $entry->testDate;
if ($test_date) {
	$test_date = format_date ( $test_date, "standard" );
} else {
	$test_date = "None";
}

?>

<fieldset class="support-view">
	<legend><?php  echo $year . "-" . $year_end?></legend>
	<!--  grade preferences are only used for middleschoolers and enrolled students.  -->
				<?php $this->load->view("course_preference/list",array('course_preferences' => $entry->course_preferences,'student'=>$student, 'kStudent'=>$entry->kStudent));?>
<?php 

if (! $print) {
	
	$buttons [] = array (
			"selection" => "support",
			"href" => site_url ( "support/edit/$entry->kSupport" ),
			"text" => "Edit",
			"class" => "button edit small" 
	);
	
	$buttons [] = array (
			"selection" => "print",
			"href" => site_url ( "support/view/$entry->kSupport/print" ),
			"target" => "_blank",
			"text" => "Print" ,
			"class"=>"small button print"
	);
	print create_button_bar ( $buttons );
}
?>
<?php if($entry->strengths):?>
<h4>Strengths</h4>
<p><?php echo $entry->strengths; ?></p>
<?php endif;?>
<?php if($entry->strategies):?>
<h4>Strategies</h4>
<p><?php echo $entry->strategies; ?></p>
<?php endif;?>
<h4>Diagnosis/Description</h4>
	<p><?php  echo $entry->specialNeed;?></p>
	<p>
		Meeting(s) held: <strong><?php echo get_value($entry, "meetingNotes", "No");?></strong>
	</p>
	<p>
		Test Date: <strong><?php  echo $test_date;?></strong>
        <?php $this->load->view("support/test_dates",array("current_year"=>$year, "dates"=>$entry->testDates));?>
	</p>
	<h4>Outside Support/Treatments</h4>
	<div><?php  echo $entry->outsideSupport?></div>
	<p>
		IEP on File: <strong><?php  echo $has_iep;?></strong>
	</p>
	<p>
		Saint Paul Public Schools Support: <strong><?php  echo $has_spps;?></strong>
	</p>
<?php if($entry->modification): ?>
<h4>Accommodations</h4>
	<div><?php  echo $entry->modification; ?></div>
<?php endif;?>

<?php if(!empty($files_array) && !$print):?>
<div class='file-attachments'>
		<h4>File Attachments</h4>
		<table class="list files">
			<thead>
				<tr>
					<th>
						<strong>File Name</strong>
					</th>
					<th>
						<strong>Description</strong>
					</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach($files_array as $file):?>
	<tr>
					<td class='file-name'>
						<a href='<?php  echo base_url("uploads/$file->file_name");?>' target='_blank'><?php  echo $file->file_display_name;?></a>
					</td>
					<td class='file-description'><?php  echo $file->file_description;?></td>
				</tr>
	<?php endforeach; ?>
	</tbody>
		</table>
	</div>
		
<?php	endif; ?>

</fieldset>
