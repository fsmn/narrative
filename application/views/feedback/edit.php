<?php$levels = array("","Low","Medium","High");$level_options = "";foreach($levels as $level){	$selected = "";	if($level == $urgency){		$selected = " selected";	}	$level_options .= "<option value='$level' $selected>$level</option>";}?><div id="feedback-div"><form id="feedback-editor" action="<?php  echo site_url("feedback/add");?>"	method="post"  name="feedback-editor">	<p>		<label for="subject">Current Page:</label>		<input type="text" name="subject" id="subject" class="required" style="width: 95%" value="<?php  echo $subject;?>"/>	</p>	<p>		<label for="rank">Urgency</label>		<select name="rank" id="rank" size="1">			<?php  echo $level_options;?>		</select>	</p>	<p>		<textarea name="feedback" id="feedback" rows="13" style="width: 95%"><?php print $feedback; ?></textarea>	</p>	<p>		<input type="submit" class="button send_feedback" value="Submit"/>	</p></form></div>