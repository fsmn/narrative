<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
if (count ( $reports ) > 0) :
	// list.php Chris Dart Nov 20, 2014 2:48:08 PM chrisdart@cerebratorium.com
	$sortTerm = sprintf ( "%s %s (Grade %s)", $narrTerm, format_schoolyear ( $narrYear ), $stuGrade );
	$div_classes [] = "block";
	
	if ($narrTerm == "Mid-Year") {
		$div_classes [] = "even";
	} else {
		$div_classes [] = "odd";
	}
	
	?>

<div class="<?php  echo implode(" ",$div_classes);?>">

	<h4><?php  echo $sortTerm; ?></h4>

<?php 

	$print_buttons [] = array (
			"selection" => "print",
			"class" => "button small",
			"text" => "Preview &amp; Print Report",
			"href" => site_url ( "narrative/print_student_report/$kStudent/$narrTerm/$narrYear" ),
			"target" => "_blank" 
	);
	
	if ($stuGrade >= 6) {
		$print_buttons [] = array (
				"selection" => "print",
				"text" => "Print Grades",
				"title" => "Print Grades",
				"class" => "button small",
				"href" => site_url ( sprintf ( "grade/report_card?kStudent=%s&year=%s&term=%s&subject=0", $kStudent, $narrYear, $narrTerm ) ),
				"target" => "_blank" 
		);
	}
	if ($stuGrade >= 5) {
		$print_buttons [] = array (
				"selection" => "print",
				"text" => "Print Benchmarks",
				"title" => "Print Benchmarks",
				"class" => "button small",
				"href" => site_url ( "student_benchmark/select/?kStudent=$kStudent&year=$narrYear&term=$narrTerm&subject=&student_grade=$stuGrade" ),
				"target" => "_blank" 
		);
	}
	?>
<?php  echo create_button_bar($print_buttons); ?>

        <table class='list'>
		<thead>
			<tr>
				<th>
					<strong>Subject</strong>
				</th>
				<th>
					<strong>Author</strong>
				</th>
				<th>Last Modified</th>
				<th></th>
			</tr>
		</thead>
		<tbody>

<?php foreach($reports as $narrative):?>
<tr>
				<td>

					<strong><?php  echo $narrative->narrSubject;?></strong>
				</td>
				<td>
					<a href="<?php  echo site_url("narrative/teacher_list/$narrative->kTeach");?>"><?php  echo format_name($narrative->teachFirst,$narrative->teachLast);?></a>
				</td>
				<td><?php  echo format_timestamp($narrative->recModified);?></td>
				<td>
					<a class="button small" href="<?php  echo site_url("narrative/view/$narrative->kNarrative");?>">View/Edit</a>

				</td>
			</tr>

<?php endforeach; ?>

</tbody>
	</table>
</div>




<?php endif;
