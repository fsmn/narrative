<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form id="log_search" name="log_search" action="<?php  echo site_url("admin/show_log");?>" method="get">
<p>
<label for="username">Users: </label>
<?php  echo form_dropdown("username",$users,NULL,"id='username'");?>
</p>
<p>
<label for="action">Action: </label><br/>
<input type="radio" name="action"  value="login" />Login<br/>
<input type="radio" name="action"  value="logout"/>Logout
</p>
<p>
<label for="start_time">Date Range</label>
<input type="date" name="time_start" id="time_start" value=""/>-
<input type="date" name="time_end" id="time_end" value=""/>

</p>
<p>
<input type="submit" class="button" value="search"/>
</p>

</form>


