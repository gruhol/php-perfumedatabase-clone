	<div class="container">
			<div class="row">
				<div class="span9">
					<div class="register">
					<?php foreach($user as $row) { ?>
					<div class="titleHeader clearfix">
						<h3>Konto użytkownika <?php echo $row->login; ?></h3>
					</div><!--end titleHeader-->
					
					<?php 
						$data = array('class' => 'form-horizontal');
						echo form_open("user/edit_user", $data); 
						if (isset($message))  echo '<div class="alert alert-error">'.$message.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
						if (isset($massage_sukcess))  echo '<div class="alert alert-success">'.$massage_sukcess.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
						echo validation_errors();
					?>
							<h4>&nbsp;&nbsp;&nbsp;&nbsp;1. Moje dane:</h4>

							<div class="control-group <?php $log_error = form_error('login'); if (!$log_error == '') echo 'error';?>">
							    <label class="control-label" for="inputFirstName">First Name: <span class="text-error">*</span></label>
							    <div class="controls">
							     <?php 
									$email = array('name' => 'login', 'id' => 'inputLogin', 'placeholder' => 'Login', 'value' => $row->login);
									echo form_input($email);
								  ?>
							      <!-- <span class="help-inline"><i class="icon-ok"></i> Avaliable input!</span> -->
							    </div>
							</div><!--end control-group-->

							<div class="control-group  <?php $email_error = form_error('email'); if (!$email_error == '') echo 'error';?>">
							    <label class="control-label" for="inputEmail">Adres e-mail: <span class="text-error">*</span></label>
							    <div class="controls">
							    
							    <?php 
									$email = array('name' => 'email', 'id' => 'inputEmail', 'placeholder' => 'emial', 'value' => $row->email);
									echo form_input($email);
								?>
							    </div>
							</div><!--end control-group-->

							<div class="control-group <?php $name_error = form_error('name'); if (!$name_error == '') echo 'error';?>">
							    <label class="control-label" for="inputName">Imię: <span class="text-error">*</span></label>
							    <div class="controls">
							      <input name="name" type="text" id="inputImie" placeholder="Imię" value="<?php if (isset($row->name)) echo $row->name ?>">
							    </div>
							</div><!--end control-group-->

							<div class="control-group <?php $surename_error = form_error('surename'); if (!$surename_error == '') echo 'error';?>">
							    <label class="control-label" for="inputTele">Nazwisko: <span class="text-error">*</span></label>
							    <div class="controls">
							      <input name="surename" type="text" id="inputNazwisko" placeholder="Nazwisko" value="<?php if (isset($row->surename)) echo $row->surename ?>">
							    </div>
							</div><!--end control-group-->

							<div class="control-group">
							    <label class="control-label" for="inputConPass">Newslatter: <span class="text-error">*</span></label>
							   	<div class="controls">
								    <label class="radio inline">
										<input type="radio" name="sex" id="optionsRadios1" value="k" <?php if ($row->sex == 'k') echo 'checked';?>>
										Kobieta	
									</label>
									<label class="radio inline">
										<input type="radio" name="sex" id="optionsRadios2" value="m" <?php if ($row->sex == 'm') echo 'checked';?>>
										Facet
									</label>
								</div>
							    
							</div><!--end control-group-->

							<div class="control-group">
							    <div class="controls">
								    <button type="submit" class="btn btn-success">Zapisz zmiany</button>
							    </div>
							</div><!--end control-group-->

						</form><!--end form-->
						<?php } ?>

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