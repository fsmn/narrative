<?php #narrative/search.php ?><form id="search_replace" action="<?php  echo site_url("narrative/replace");?>" method="post"    name="search_replace">    <h3>Instructions</h3><p> All fields are required!</p><p>    The search string should be at least <span class='highlight'>three words long</span>     so you don't accidentally replace more occurrences than you intend.     Backups of each narrative will be generated when you conduct this search and    replace feature, but recovery from a disaster will require help from the database administrator.</p>    <p>Remember that computers are literal. The search and replace will do <i>exactly</i> as you tell it.     </p>    <h3>Search &amp; Replace</h3><p><label for='kTeach'>Select Teacher</label><?php  echo form_dropdown("kTeach",$teachers,"","id='kTeach' required");?></p><p><label for='narrYear'>School Year: </label><?php  echo form_dropdown("narrYear", $years, $currentYear,"id='narrYear', class='yearStart' required")?>&#45;<input type="text" id="yearEnd" readonly size="5" value="<?php  echo $currentYear + 1;?>" /></p><p><label for='narrTerm'>Term: </label> <?php  echo $terms;?> </p><p> <label for='gradeStart'>Select Grade Range: </label><span id="grade-range"><?php  echo form_dropdown("gradeStart",$grades,"0","id='gradeStart' required");?>to <?php  echo form_dropdown("gradeEnd",$grades,"0","id='gradeEnd' required");?></span></p><p><label for="search">Search String</label> <br/><input type="text"    id="search" name="search" style="width:300px;" value="" required/></p><p>To replace your search string with an underline, bold or italics, use the following chart:<ul><li>Underline = &lt;u&gt;<span style='text-decoration:underline'>word(s) to be underlined</span>&lt;&#47;u&gt;</li><li>Bold = &lt;strong&gt;<strong>word(s) to be bolded</strong>&lt;&#47;strong&gt;</li><li>Italics = &lt;em&gt;<em>word(s) to be italicized</em>&lt;&#47;em&gt;</li></ul><p>Note that the forward slash in the terminating tag (&lt;<span class='highlight'>&#47;</span>x&gt;) is very important. <br/>Also, underlines are not necessary for book titles, etc, when italics are available.</p><p><label for="replace">Replace String</label><br/> <input type="text"    id="replace" name="replace" style="width:300px;" value="" /></p><p><input type="submit" class="button" title="Replace" value="Replace" /></p></form>