<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>

<h3>Administer Preference Types</h3>
<? $buttons[] = array("item"=>"preference_type", "text"=>"New", "class"=>"button new create_preference_type");
echo create_button_bar($buttons);

		?>
<? foreach($preferences as $preference): 
$buttons = array();?>
<h4 id="<?=$preference->type;?>">
	<?=$preference->name;?>
</h4>
<? $buttons[] = array("item"=>"preference_type", "text"=>"Edit","class"=>"button edit edit_preference_type","id"=>"pt-$preference->type");
echo create_button_bar($buttons);?>

<div 
<? if($type == $preference->type): echo "class='highlight'"; endif;?>>

	<p>
		<label>Machine Name (type): </label>
		<?=$preference->type;?>
	</p>
	<p>
		<label>Description: </label>
		<?=$preference->description;?>
	</p>
	<p>
		<label>Options: </label>
		<?=$preference->options;?>
	</p>
	<p>
		<label>Format: </label>
		<?=$preference->format;?>
	</p>
</div>




<? endforeach; ?>