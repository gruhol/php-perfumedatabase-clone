<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-3"></div>
<div class="col-md-6 my-3">
	<h4><?php if (isset($msg_info)) echo $msg_info;?></h4>
	<p>Session id: <?php echo $session_id; ?></p>
	<p>Session login: <?php echo $session_login; ?></p>
	<p>Cookie id: <?php echo $cookie_sesion; ?></p>
	<p>Cookie login: <?php echo $cookies_login; ?></p>
	
	<?php echo anchor('user/logout','Wyloguj', array('class' => 'btn'));?>
</div>
<div class="col-md-3"></div>			