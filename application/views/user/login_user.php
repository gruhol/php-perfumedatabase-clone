<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$css_style = $this->config->item('css_style_error', 'cms');
?>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 my-3">

		<?php
			if (isset($message))  echo "<div class=\"$css_style\">".$message.'</div>';
			echo validation_errors();
			$attributes = array('class' => 'form-horizontal');
			echo form_open('user/login', $attributes);
		?>
	</div>
	<div class="col-md-2"></div>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-4">
		<h4 class="display-5"><?php echo $this->lang->line('users_do_you_have_an_account_login_in'); ?></h3>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-user"></i></div>
	        </div>
			<?php
				$login = array('name' => 'login', 'id' => 'InputLogin', 'placeholder' => $this->lang->line('users_login'), 'class' => 'form-control');
				echo form_input($login);
			?>
		</div>

		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-key"></i></div>
			</div>
			<?php
				$password = array('name' => 'password','id' => 'InputPassword','type' => 'password','placeholder' => $this->lang->line('users_password'), 'class' => 'form-control');
				echo form_password($password);
			?>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<div class="checkbox">
					<label>
						<?php
						echo form_checkbox('autologin', 'ok');
						echo $this->lang->line('users_remember_me');
						?>
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-success"><?php echo $this->lang->line('users_do_login');?> </button>
			</div>
			<div class="col-sm-12">
				<!-- <a href="user/remember_password"><?php echo $this->lang->line('users_dont_remeber_the_password');?></a>-->
				<?php echo anchor('user/remember_password', $this->lang->line('users_dont_remeber_the_password'));?>
			</div>
		</div>

		<?php
		//echo form_hidden('start_url', $start_url);
		echo form_close();
		?><!--end form-->

	</div>
	<div class="col-md-1"></div>
	<div class="col-md-4">
		<br /><br />
		<h4 class="display-5"><?php echo $this->lang->line('users_you_are_new_user');?></h3>
		<p><?php echo $this->lang->line('users_free_account_info');?></p>
		<?php
			$users_register = $this->lang->line('users_register');
			echo anchor('user/add_user',$users_register, array('class' => 'btn btn-success'));
		?>

	</div>
	<div class="col-md-1"></div>
</div>
