<?php$year = get_value($template, "year", get_current_year());$message = "";if($action == "update"){	if(get_value($template, "isActive") == 0){		$message = "<span class='highlight'>This is an Inactive Template</span> <span class='button reactivate_template'>Reactivate</span>";	}}$buttons[] = array("text"=>"Save &amp; Continue","class"=>"button template_save_continue edit");$buttons[] = array("text"=>"<input type='submit' class='button edit template_save_close' value='Save &amp; Close'/>","type"=>"pass-through");$buttons[] = array("text"=>"Cancel","class"=>"button cancel_template");if($template){    $buttons[] = array("text"=>"Disable Template","title"=>"Remove template from active use","class"=>"delete delete_template button","enclosure" => array("type" => "span","class"=>"delete-container"));}?><form id="template_editor" action="<?php  echo site_url("template/$action");?>"	method="post" name="template_editor">	<input type="hidden" id="kTeach" name="kTeach" value="<?php  echo $kTeach;?>" />	<input type="hidden" id="kTemplate" name="kTemplate"		value="<?php  echo get_value($template,"kTemplate"); ?>" /> <input		type="hidden" id="action" name="action" value="<?php  echo $action;?>" /> <input		type="hidden" id="isActive" name="isActive"		value="<?php  echo get_value($template,"isActive",1);?>" /> <input		type="hidden" id="ajax" name="ajax" value="0" />	<?php  echo create_button_bar($buttons,array("id"=>"editing-buttons"));?>			<div id='message' class="alert"><?php  echo $message;?> </div>		<p>		<label for='subject'>Subject:</label>		<?php  echo form_dropdown("subject", $subjects, get_value($template,"subject"),"id='subject'");?>		&nbsp; <label for="term">Term: </label>		<?php  echo get_term_menu("term", get_value($template,"term",get_current_term()));?>		&nbsp; <label for="year">School Year: </label>		<?php  echo form_dropdown("year", $years, $year ,"id='year'"); ?>		- <input type="text" id="yearEnd" name="yearEnd" size="5"			maxlength="4" readonly value="<?php  echo $year + 1?>" />	</p>	<p>		<label for="gradeStart">Grade Range: </label>		<?php  echo form_dropdown("gradeStart",$grade_list,get_value($template,"gradeStart",$gradeStart),"id='gradeStart'");?>		-		<?php  echo form_dropdown("gradeEnd",$grade_list,get_value($template,"gradeEnd",$gradeEnd),"id='gradeEnd'");?>	</p>	<p>		<label for="type">OPTIONAL Description</label><br/><input type="text" id="type" name="type"			value="<?php  echo get_value($template,"type");?>" placeholder="Fill this out only if you create more than one template per term and grade range." size="85" /> <span			class='help button' id="Templates_Template Titles"			title="What is the purpose of the title?">Help</span>	</p>	<div class='message' style="width:100%;">NOTICE: Always use the word &quot;STUDENT&quot; in		all caps where you want an actual student's name to appear. ALWAYS use		the Masculine 3rd person pronouns (He, His, Him, Himself) here so that		the the computer can insert the correct gender pronouns in the actual		reports. <span class='help link' id='Templates_Pronoun Substitution'		 title="Why the bias?">Why the bias?</span></div>	<p>		<textarea name="template" id="template" class="tinymce"			cols="95" style="width:100%;">			<?php  echo get_value($template,"template");?>		</textarea>	</p></form><script type="text/javascript">window.setInterval(function(){	tinyMCE.triggerSave();	save_continue_template();}, 60000);</script>