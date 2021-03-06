<?php
$category_list = array();
foreach ($categories as $c) {
    $category_list[] = sprintf("'%s'", $c->category);
}
?>
<h3><?php echo $title; ?></h3>
<form
        id="benchmark"
        action="<?php echo site_url("benchmark/$action"); ?>"
        method="post"
        name="benchmark">
    <input
            type="hidden"
            name="submitted"
            value="true"/>
    <input
            type="hidden"
            id="target"
            name="target"
            value="benchmark"/>
    <input
            type="hidden"
            id="kBenchmark"
            name="kBenchmark"
            value="<?php print $kBenchmark; ?>"/>
    <p>
        <label for="gradeStart">Grade Range: </label><input
                type="text"
                id="gradeStart"
                name="gradeStart"
                required
                value="<?php echo $gradeStart; ?>"
                size="3"
                maxlength="1"/> -<input
                type="text"
                id="gradeEnd"
                name="gradeEnd"
                value="<?php echo $gradeEnd; ?>"
                size="3"
                required
                maxlength="1"/>&nbsp;
    </p>
    <p>
        <label
                for="year">Year: </label>
        <?php echo form_dropdown('year', get_year_list(), $year, "id='year' class='year' required"); ?>
        -<input
                id="yearEnd"
                type="text"
                name="yearEnd"
                class='yearEnd'
                readonly
                maxlength="4"
                size="5"
                value="<?php $yearEnd = $year + 1;
                print $yearEnd; ?>"/>
    </p>
    <label for="subject">Subject:</label><?php echo form_dropdown('subject', $subjects, $subject, "id='subject' required"); ?>
    <p class="ui-widget">
        <label for="category">Category:</label><input
                type="text"
                id="category"
                name="category"
                required
                value="<?php echo $category; ?>"/>
    </p>
    <p>
        <label for="benchmark">Benchmark:</label><br/>
        <textarea
                id='benchmark'
                name='benchmark'
                class='full-width'
                required><?php echo stripslashes($benchmark); ?></textarea>
    </p>
    <p>
        <label for="weight">Weight (bigger numbers sink to the bottom of the
            list)</label>
        <input
                type="text"
                size="5"
                id="weight"
                name="weight"
                value="<?php echo $weight; ?>"/>
    </p>
    <p>
        <input
                type="submit"
                class='button'
                value="Save"/>
    </p>
</form>

<script type="text/javascript">
    $(function () {
        let availableTags = [
            <?php echo implode(",", $category_list); ?>
        ];
        $("#category").autocomplete({
            source: availableTags
        });
    });
</script>

 