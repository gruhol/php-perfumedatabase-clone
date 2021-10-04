<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h3 class="display-4"><?php echo $this->lang->line('users_password_recovery');?></h3>
		<p><?php echo $this->lang->line('users_password_recovery_description');?></p>
	
		<?php if (isset($message))  echo '<div class="alert alert-info">'.$message.'</div>';?>
		<?php echo validation_errors(); ?>
		<?php echo form_open('user/remember_password', array('class' => 'form-horizontal'))?>
		
		<div class="row">
			<div class="col-md-8 input-group my-3">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-envelope"></i></div>
				</div>
				<?php
					$email = array('name' => 'email', 'id' => 'inputEmail','placeholder' => $this->lang->line('users_adres_email'),'value' => set_value('email'), 'class' => 'form-control');
					echo form_input($email);
				?>
			</div>
			
			<div class="col-md-4 form-group my-3">
				<input class="btn btn-primary main-button" type="submit" name="submit" id="<?php echo $this->lang->line('users_remember_password');?>" value="<?php echo $this->lang->line('users_remember_password');?>">
			</div>
		</div>
	
		<?php echo form_close();?>
	</div>
	<div class="col-md-3"></div>
</div>