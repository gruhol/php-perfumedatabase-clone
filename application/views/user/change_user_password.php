<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<p></p>
		<?php	
			echo validation_errors();
		?>						
		<p><?php echo $this->lang->line('set_your_password');?></p>
		<?php
			$data = array('class' => 'form-horizontal');
			echo form_open('user/change_password/'.$link.'/'.$login, $data);
		?>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><?php echo $this->lang->line('users_password'); ?></div>
	        </div>
	        <?php
	        	$password = array('name' => 'password','id' => 'inputPassword','placeholder' => '','value' => set_value('password'), 'class' => 'form-control');
	        	echo form_password($password);
			?>
		</div>
		
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<div class="input-group-text"><?php echo $this->lang->line('users_passconf'); ?></div>
			</div>
			<?php
				$passconf = array('name' => 'passconf', 'id' => 'inputPassconf','placeholder' => '','value' => set_value('passconf'), 'class' => 'form-control');
				echo form_password($passconf);
			?>
		</div>
		
		<div class="form-group">
			<input class="btn btn-primary main-button" type="submit" name="submit" value="<?php echo $this->lang->line('users_next');?>">
		</div>
		
		</form><!--end form-->
	</div>
	<div class="col-md-4"></div>
</div>