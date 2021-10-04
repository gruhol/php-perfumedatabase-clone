<div class="container">
			<div class="row">

				<div class="span9">
					<div class="register">

						<div class="titleHeader clearfix">
							<h3>Zmień hasło</h3>
						</div><!--end titleHeader-->
						<?php	
							if (isset($message))  echo '<div class="alert alert-error">'.$message.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
							echo validation_errors();
						?>
						
						<p>Wprowadź swoje obecne hasło, a nastepnie dwa razy nowe.</p>
						<?php
						$data = array('class' => 'form-horizontal');
						echo form_open('user/edit_password', $data);?>

							<h4>&nbsp;&nbsp;&nbsp;&nbsp;1. Obecne dane:</h4>
							
							<div class="control-group <?php $oldpassword_error = form_error('oldpassword'); if (!$oldpassword_error == '') echo 'error';?>">
							    <label class="control-label" for="inputOldPassword">Obecne hasło: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								$oldpassword = array(
									'name' => 'oldpassword',
									'maxlength' => '80',
									'size' => '30',
									'type' => 'password',
									'id' => 'inputOldPassword',
									'placeholder' => 'OldPassword'
								);
								echo form_input($oldpassword);
								?>
							    </div>
							</div><!--end control-group-->
							
							<h4>&nbsp;&nbsp;&nbsp;&nbsp;2. Nowe dane:</h4>

							<div class="control-group <?php $password_error = form_error('password'); if (!$password_error == '') echo 'error';?>">
							    <label class="control-label" for="inputPassword">Nowe hasło: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								$password = array(
									'name' => 'password',
									'maxlength' => '80',
									'size' => '30',
									'type' => 'password',
									'id' => 'inputPassword',
									'placeholder' => 'Password'
								);
								echo form_input($password);
								?>
							    </div>
							</div><!--end control-group-->

							<div class="control-group" <?php $passconf_error = form_error('passconf'); if (!$passconf_error == '') echo 'error';?>">
							    <label class="control-label" for="inputPassconf">Potwórz nowe hasło: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								$passconf = array(
									'name' => 'passconf',
									'maxlength' => '80',
									'size' => '30',
									'type' => 'password',
									'id' => 'inputPassword',
									'placeholder' => 'Password'
								);
								echo form_input($passconf);
								?>
							    </div>
							</div><!--end control-group-->

							<div class="control-group">
							    <div class="controls">
								    <input class="btn btn-primary" type="submit" name="submit" id="Zmień hasło" value="Zmień hasło">
							    </div>
							</div><!--end control-group-->

						</form><!--end form-->

					</div><!--end register-->
				</div><!--end span9-->


				<div class="span3">
					<div class="titleHeader clearfix">
						<h3>Menu użytkownika</h3>
					</div><!--end titleHeader-->
					<ul class="unstyled my-account">
						<li><a class="invarseColor" href="../user/index"><i class="icon-caret-right"></i> Moje dane</a></li>
						<li><a class="invarseColor" href="../user/edit_password"><i class="icon-caret-right"></i> Zmień hasło</a></li>
						<li><a class="invarseColor" href="../user/logout"><i class="icon-caret-right"></i> Wyloguj</a></li>
					</ul>
				</div><!--end span3-->

			</div><!--end row-->

		</div><!--end conatiner-->