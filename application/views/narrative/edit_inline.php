<?php
?>
<form id="narrative_inline_editor" name="narrative_inline_editor"
	action="ajax.switch.php" method="post">
	<input type="hidden"
	name="kNarrative" id="kNarrative" value='<?="$narrative->kNarrative"; ?>' />
	<input type="hidden"
    name="kTeach" id="kTeach" value='<?="$narrative->kTeach"; ?>' />

<div><textarea id="narrText" name="narrText" class="tinymce"
	style="width: 99.75%;" rows="19" cols="107"><?=strip_slashes($narrative->narrText);?></textarea></div>
<p><span class="button new save_narrative_inline">Save</span></p>
</form>
