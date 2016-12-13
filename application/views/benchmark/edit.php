<?php 
//$categories = array("one","two","three");
foreach($categories as $c){
	$category_list[] = sprintf("'%s'", $c->category);
}
?>
<h3><?php echo $title;?></h3>
<form
	id="benchmark"
	action="<?=site_url("benchmark/$action");?>"
	method="post"
	name="benchmark">
	<input
		type="hidden"
		name="submitted"
		value="true">
		<input
		type="hidden"
		id="target"
		name="target"
		value="benchmark" />
		<input
		type="hidden"
		id="kBenchmark"
		name="kBenchmark"
		value="<? print $kBenchmark;?>" />
	<p>
		<label for="gradeStart">Grade Range: </label><input
			type="text"
			id="gradeStart"
			name="gradeStart"
			required
			value="<?=$gradeStart; ?>"
			size="3"
			maxlength="1"/> -<input
			type="text"
			id="gradeEnd"
			name="gradeEnd"
			value="<?=$gradeEnd;?>"
			size="3"
			required
			maxlength="1"/>&nbsp;
<!-- 			<label for="quarter">Quarter</label> -->
 <?php //echo form_dropdown('quarter',array(1=>1,2=>2,3=>3,4=>4), get_cookie('benchmark_quarter'),"id='quarter'" );?>
			<!-- <label for="term">Term: </label><?php //get_term_menu('term', $term);?>  -->
			<label
			for="year">Year: </label>
<?=form_dropdown('year',get_year_list(), $year, "id='year' class='year' required");?>
-<input
			id="yearEnd"
			type="text"
			name="yearEnd"
			class='yearEnd'
			readonly
			maxlength="4"
			size="5"
			value="<? $yearEnd=$year+1;print $yearEnd; ?>" />
	</p>
	<label for="subject">Subject:</label><?=form_dropdown('subject',$subjects,$subject,"id='subject' required");?>
<p class="ui-widget">
		<label for="category">Category:</label><input
			type="text"
			id="category"
			name="category"
			required
			value="<?=$category;?>" />
	</p>
	<p>
		<label for="benchmark">Benchmark:</label><br />
		<textarea
			id='benchmark'
			name='benchmark'
			required
			style="width: 100%"><?=$benchmark;?></textarea>
	</p>
	<p>
		<label for="weight">Weight (bigger numbers sink to the bottom of the
			list)</label> <input
			type="text"
			size="5"
			id="weight"
			name="weight"
			value="<?=$weight;?>" />
	</p>
	<p>
		<input
			type="submit"
			class='button'
			value="Save" />
	</p>
</form>

 <script type="text/javascript">
  $( function() {
    var availableTags = [
       <?php echo implode(",",$category_list); ?>
                         
    ];
    $( "#category" ).autocomplete({
      source: availableTags
    });
  } );
  </script>

 