<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h3 class="display-4"><?php echo $this->lang->line('users_create_account');?></h3>
		<?php	
			echo validation_errors();
		?>						
		<p><?php echo $this->lang->line('users_create_account_info');?></p>
		<?php
			$data = array('class' => 'form-horizontal');
			echo form_open('user/add_user', $data);
		?>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-user"></i></div>
	        </div>
	        <?php
	        	$login = array('name' => 'login','id' => 'inputLogin','placeholder' => 'Login','value' => set_value('login'), 'class' => 'form-control');
	        	echo form_input($login);
			?>
		</div>
		
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="far fa-envelope"></i></div>
			</div>
			<?php
				$email = array('name' => 'email', 'id' => 'inputEmail','placeholder' => 'Adres Email','value' => set_value('email'), 'class' => 'form-control');
				echo form_input($email);
			?>
		</div>
		<div class="g-recaptcha" data-sitekey="<?php echo $recaptchasite; ?>"></div>
		<div class="form-group my-3">
			<input class="btn btn-success" type="submit" name="submit" id="Rejestruj" value="<?php echo $this->lang->line('users_next');?>">
		</div>
		
		</form><!--end form-->
	</div>
	<div class="col-md-4"></div>
</div>