<?php  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class='student_list'>
<?php foreach($students as $student):
	$student_style = "studentName";
	$name = format_name($student->stuFirst,$student->stuLast,$student->stuNickname);
	?>
	<p>
		<span class='button <?=$js_class;?>'
			id='ss_<?=$student->kStudent;?>'><?="$name";?> </span>
	</p>
<? endforeach; ?>
</div>
