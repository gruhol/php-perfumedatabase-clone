<div class="container">
			<div class="row">

				<div class="span9">
					<div class="register">

						<div class="titleHeader clearfix">
							<h3>Utwórz konto</h3>
						</div><!--end titleHeader-->
						<?php	
							if (isset($message))  echo '<div class="alert alert-error">'.$message.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
							echo validation_errors();
						?>
						
						<p>Wprowadź następujące informacje a my wyślemy Ci instrukcje jak potwierdzić Twoje konto.</p>
						<?php
						$data = array('class' => 'form-horizontal');
						echo form_open('user/add_user', $data);?>

							<h4>&nbsp;&nbsp;&nbsp;&nbsp;1. Podstatowe dane:</h4>
							
							<div class="control-group <?php $login_error = form_error('login'); if (!$login_error == '') echo 'error';?>">
								<label class="control-label" for="inputLogin">Login: <span class="text-error">*</span></label>
								<div class="controls">
								<?php
								$login = array('name' => 'login','maxlength' => '80','size' => '30','id' => 'inputLogin','placeholder' => 'Login','value' => set_value('login'),);
								echo form_input($login);
								?>
								</div>
							</div>

							<div class="control-group <?php $email_error = form_error('email'); if (!$email_error == '') echo 'error';?>">
							    <label class="control-label" for="inputMail">Adres email: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								$email = array('name' => 'email','maxlength' => '80','size' => '30','id' => 'inputEmail','placeholder' => 'Email','value' => set_value('email'),);
								echo form_input($email);
								?>
							    </div>
							</div><!--end control-group-->

							<div class="control-group <?php $password_error = form_error('password'); if (!$password_error == '') echo 'error';?>">
							    <label class="control-label" for="inputPassword">Hasło: <span class="text-error">*</span></label>
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
							    <label class="control-label" for="inputPassconf">Potwórz hasło: <span class="text-error">*</span></label>
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
							        <label class="checkbox">
								      <input type="checkbox"> Akceptuję <a href="#">Regulamin serwisu</a>
								    </label>
								    <br>
								    <input class="btn btn-primary" type="submit" name="submit" id="Rejestruj" value="Zarejestruj się">
							    </div>
							</div><!--end control-group-->

						</form><!--end form-->

					</div><!--end register-->
				</div><!--end span9-->


				<div class="span3">
					
				</div><!--end span3-->

			</div><!--end row-->

		</div><!--end conatiner-->