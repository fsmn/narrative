<?php #login.inc$classes = "";$error_text = FALSE;if($errors){	$classes = "errors";	if(is_array($errors)){		foreach($errors as $msg){			$error_text =  " -$msg<br/>\n";		}	}else{		$error_text =  "$errors";	}}?><div class="login <?php echo $classes;?>">	<div class="login-title">Login</div>	<?php 	if($error_text):	?>	<div class="error-text">		<?php  print $error_text; ?>	</div>	<?php 	endif;	?>	<form action="<?php echo site_url("auth/login"); ?>" method="post"		name="login_form" id="login_form" >		<div class='login-inputs'>			<p>				<label for="username">Username</label><br /> <input type="text" placeholder="username"					name="username" id="username" autofocus="autofocus" required  value="<?php  $username; ?>"					class="login-text" />			</p>			<p>				<label for="password">Password</label> <br /> <input type="password" placeholder="password"					name="password" id="password" required class="login-text" autocomplete="off"/>			</p>			<div class="button-bar">				<input type="submit" name="submit" class="button" value="Login" />				&nbsp; <a href='<?php echo site_url("auth/start_reset");?>' class="button">Forgot					Password?</a>			</div>		</div>	</form></div><datalist></datalist>