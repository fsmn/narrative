<?php
?>
<script src="//tinymce.cachefly.net/4.3/tinymce.min.js"></script>

<script>

</script> 
<form id="narrative_inline_editor" name="narrative_inline_editor"
	action="<?=site_url("narrative/update_inline");?>" method="post">
	<input type="hidden"
	name="kNarrative" id="kNarrative" value='<?="$narrative->kNarrative"; ?>' />
	<input type="hidden"
    name="kTeach" id="kTeach" value='<?="$narrative->kTeach"; ?>' />

<div><textarea id="narrText" name="narrText" class="tinymce"
	style="width: 99.75%;" rows="19" cols="107"><?=stripslashes($narrative->narrText);?></textarea></div>
<p><span class="button new save_narrative_inline">Save</span>&nbsp;<a href="#" class="enable-rich-text button" id="rtf_<?php echo $narrative->kNarrative;?>">Enable Rich Text</a></p>
</form>
