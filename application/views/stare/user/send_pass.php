	<div class="container">
			<div class="row">
				<div class="span9">
					<div class="login">
						<table>
							<tr>
								<td>
									<div class="alert alert-block"><h2>Odzyskiwanie </h2></div>
									<p>Wprowadź swój adres email a my wyślemy Ci dane do zalogowania.</p>

									<?php if (isset($message))  echo '<div class="alert alert-info">'.$message.'</div>';?>
									<?php echo validation_errors(); ?>
									<?php echo form_open('user/send_password', array('class' => 'form-horizontal'))?>
										<div class="control-group">
											<label class="control-label" for="inputEmail">E-mail:</label>
											<div class="controls">
												<input type="text" name="email" id="inputemial" placeholder="E-mail">
											</div>
									  	</div>
									  	<div class="control-group">
											<div class="controls">
												<input class="btn" type="submit" name="submit" id="remeber_pass" value="Przypomnij hasło">
											</div>
										</div>
									<?php echo form_close();?>
								</td>
							</tr>
						</table>
					</div><!--end login-->
				</div><!--end span9-->

				<div class="span3">
				</div><!--end span3-->

			</div><!--end row-->
		</div><!--end conatiner-->