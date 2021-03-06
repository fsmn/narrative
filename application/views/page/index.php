<?php

if (isset ( $print ) && $print == TRUE) {
	$print = TRUE;
} else {
	$print = FALSE;
}
if (! isset ( $body_classes )) {
	$body_classes = array (
			"not-front" 
	);
}
$body_classes [] = "browser";
$body_classes [] = $this->uri->segment ( 1 );
?>
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('page/head');?>
</head>
<body class="<?php  echo implode(" ",$body_classes);?>">
	<div id="page">
        <div id="printable-header">Friends School of Minnesota Student Academic Reporting System, <?php echo date('M d, Y');?></div>
        <?php if(!$print): ?>
<div id='header'>

<?php if($_SERVER['HTTP_HOST'] != "reports.fsmn.org"): ?>
<div id="site-name" class="warning"><div>
				WARNING: THIS IS THE STAGING SERVER. CHANGES MADE HERE ARE IMAGINARY!</div></div>
<?php else: ?>
<div id='site-name'>Friends School Student Information System</div>
<?php endif;?>
<div id="top-nav">
				<div id='utility'><?php $this->load->view('page/utility');?></div>

			</div>
		</div>
<?php else:?>
<?php endif; ?>
<?php $this->load->view("page/messages");?>
<div id="main">
<nav id='navigation'>
<?php  $this->load->view('page/navigation'); ?>
</nav>
			<!-- content -->
			<div id="content-wrapper">
			<div id="content">
				<h1 id="page-title"><?php echo $title;?></h1>
<?php $this->load->view ( $target ); ?>
</div>
			<!-- end content -->
			<div id="sidebar"></div>
			<!-- end sidebar -->
		</div>
		</div>
		<div id='search_list'></div>
		<div id="footer"><?php $this->load->view('page/footer');?>
</div>
	</div>
</body>
</html>
