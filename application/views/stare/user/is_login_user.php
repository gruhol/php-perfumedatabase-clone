	<div class="container">
			<div class="row">
				<div class="span9">
					<div class="login">
						<table>
							<tr>
								<td>
									<div class="alert alert-block"><h2>Dostęp tylko dla zalogowanych</h2></div>
									<br />
									<p>Jeśli nie masz jeszcze konta?</p>
									<?php echo anchor('user/add_user','Zarejestruj się', array('class' => 'btn'));?>
								</td>

								<td>
									<h3>Masz już konto? Zaloguj się!</h3>
									<?php 
										if (isset($message))  echo '<div class="alert alert-info">'.$message.'</div>';
										echo validation_errors();
										$attributes = FALSE;
										echo form_open('user/login', $attributes); 
									?>
										<div class="controls">
											<label>Twój login: <span class="text-error">*</span></label>
											<?php 
												$login = array('name' => 'login','maxlength' => '80','size' => '30', 'id' => 'inputEmail', 'placeholder' => 'Twój login');
												echo form_input($login);
											?>
										</div>
										<div class="controls">
											<label>Hasło: <span class="text-error">*</span></label>
											<?php
												$password = array('name' => 'password','maxlength' => '80','size' => '30','id' => 'inputPassword','type' => 'password','placeholder' => 'Password');
												echo form_password($password);
											?>
										</div>
										<div class="controls">
											<label class="checkbox">
										      <?php echo form_checkbox('autologin', 'ok');?> Zapamiętaj mnie na tym komputerze.
										    </label>
										    <button type="submit" class="btn btn-primary">Zaloguj się</button>
										</div>
										<input type="hidden" name="start_url" value="<?php echo $start_url;?>" />
									<?php echo form_close(); ?><!--end form-->
									<a href="../user/send_password">Nie mogę się zalogować.</a>
								</td>
							</tr>
						</table>
					</div><!--end login-->
				</div><!--end span9-->


				<div class="span3">
					
				</div><!--end span3-->

			</div><!--end row-->

		</div><!--end conatiner-->