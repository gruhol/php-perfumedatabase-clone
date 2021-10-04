<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    width : '95%',
    height : 300,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar_items_size: 'small',
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<div class="container">
			<div class="row">

				<div class="span9">
					<div class="register">
						<?php $data = array('class' => 'form-horizontal'); echo form_open('admin/add_news', $data);?>
						<div class="titleHeader clearfix">
							<h3>Dodaj wiadomość</h3>
						</div><!--end titleHeader-->
						<?php	
							if (isset($message))  echo '<div class="alert alert-error">'.$message.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
							echo validation_errors();
						?>
						
						<p>Dodaj nową wiadomość na portalu.</p>

							<h4>&nbsp;&nbsp;&nbsp;&nbsp;1. Podstawowe informacje:</h4>
							
							<div class="control-group <?php $title_news_error = form_error('title_news'); if (!$title_news_error == '') echo 'error';?>">
							    <label class="control-label" for="inputTitleNews">Tytuł wiadomości: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								$title_news = array(
									'name' => 'title_news',
									'maxlength' => '80',
									'size' => '30',
									'id' => 'inputTitleNews',
									'placeholder' => 'Tytuł wiadomości'
								);
								echo form_input($title_news);
								?>
							    </div>
							</div><!--end control-group-->
							<?php
							$category_news = array(
								'Legionowo'  	=> 'Oszczędzanie',
								'Jablonna'  	=> 'Zakupy',
								'Nieporet'  	=> 'Wyprzedaże',
								'Serock'  		=> 'Lokaty',
								'Wieliszew'  	=> 'Konta bankowe',
								'Warszawa'  	=> 'Kredyty',
								'Swiat'  		=> 'Ubezpieczenia',
							);?>
							<div class="control-group">
							    <label class="control-label" for="inputTitleNews">Kategoria: <span class="text-error">*</span></label>
							    <div class="controls">
							    <?php
								if (!$category_news1) $category_news1 = 'brak';
								echo form_dropdown('category_news', $category_news, $category_news1);
								?>
							    </div>
							</div><!--end control-group-->
							
							<h4>&nbsp;&nbsp;&nbsp;&nbsp;2. Treść wiadomości:</h4>

							<div class="control-group <?php $content_news_error = form_error('content_news'); if (!$content_news_error == '') echo 'error';?>">
							    <label class="control-label" for="inputPassword">Zajawka: <span class="text-error">*</span></label>
							    <div class="controls">
							    <textarea name="content_news" rows="10" cols="80" style="width: 90%"><?php echo $content_news;?></textarea>
							    </div>
							</div><!--end control-group-->

							<div class="control-group" <?php $add_content_news_error = form_error('add_content_news'); if (!$add_content_news_error == '') echo 'error';?>">
							    <label class="control-label" for="inputPassconf">Treść wiadomości: <span class="text-error">*</span></label>
							    <div class="controls">
							    <textarea name="add_content_news" rows="15" cols="80" style="width: 90%"><?php echo $add_content_news;?></textarea>
							    </div>
							</div><!--end control-group-->

							<div class="control-group">
							    <div class="controls">
								    <input class="btn btn-primary" type="submit" name="submit" id="Dodaj newsa" value="Dodaj newsa">
							    </div>
							</div><!--end control-group-->

						<?php echo form_close();?><!--end form-->

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