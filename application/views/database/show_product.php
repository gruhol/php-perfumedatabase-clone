<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1 class="my-3"><?php echo $name_brand.' '.$product_name;?></h1>
<h3><?php echo $name_type.' ('.$short_type.')' ?></h3>
<div>Ocena użytkowników: <?php echo $stars; ?> (<?php echo $starsint; ?> / 5)</div>
<div class="row">
	<div class="col-md-5">
		<?php
		if ($image == FALSE) {
			echo '<img src="'.base_url().'img/products/no-photo.png" class="img-fluid" alt="">';
		} else {
			foreach($image as $row) {
				echo '<img src="'.base_url().'img/products/'.$row->url_image.'" class="img-fluid" alt="'.$row->alt_image.'">';
				$json_img = base_url().'img/products/'.$row->url_image;
			}
		}
		?>
	</div>
	<div class="col-md-7">

		<h3><?php echo $this->lang->line('database_product_stats');?></h3>
		<div class="row">
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_love'); ?> <span id="intlove" class="badge badge-light"><?php echo $int_love;?></span>
				</button>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_like'); ?> <span id="intlike" class="badge badge-light"><?php echo $int_islike;?></span>
				</button>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_dislike'); ?> <span id="intdislike" class="badge badge-light"><?php echo $int_dislike;?></span>
				</button>
			</div>
		</div>
		<?php if ($logged == 1) {
		?>


		<div class="col-md-12 alert alert-secondary votespace">
			<?php echo $this->lang->line('database_yourschoice'); ?>
			<div class="form-check form-check-inline" style="margin-left: 10px;">
				<input class="form-check-input" type="radio" name="loveradio" id="loveradio-love" value="love" <?php if ($love == 1) echo "checked"; ?>>
				<label class="form-check-label" for="loveradio"><?php echo $this->lang->line('database_love'); ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="loveradio" id="loveradio-like" value="like" <?php if ($like == 1) echo "checked"; ?>>
				<label class="form-check-label" for="likeradio"><?php echo $this->lang->line('database_like'); ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="loveradio" id="loveradio-dislike" value="dislike" <?php if ($dislike == 1) echo "checked"; ?>>
				<label class="form-check-label" for="dislikeradio"><?php echo $this->lang->line('database_dislike'); ?></label>
			</div>
			<!-- <div id="successMessage" class="alert alert-success myalert d-nine" role="alert"></div> -->
			<span id="successMessage" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
			<span id="falseMessage" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
	    $("#successMessage").hide();
			$("#falseMessage").hide();
			$("input[name='loveradio']").on('click', function()
			{
				var loveradio = $("input[name='loveradio']:checked").val();
				console.log(loveradio);
				$.ajax ({
					url: "<?php echo base_url();?>database/savevoteradio",
					type: "POST",
					data: {loveradio:loveradio, id_product:<?php echo $id_product;?> },
					dataType: 'json',
					success: function(data) {
						console.log(data.value['love']);
						console.log(data.value['like']);
						console.log(data.value['dislike']);
						
							$('#successMessage').fadeIn('slow', function(){
								$('#successMessage').delay(1000).fadeOut();
							});
							//setTimeout(function(){ location.reload(); }, 2000);
							$("#intlove").html(data.value['love']);
							$("#intlike").html(data.value['like']);
							$("#intdislike").html(data.value['dislike']);
						
					},
					error: function(data) {

						console.log('nie działa');
						console.log(data.love);
						$('#falseMessage').fadeIn('slow', function(){
							$('#falseMessage').delay(1000).fadeOut();
						});
					},
				});
			})
		});
		</script>
		<?php
 			}
		?>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_ihave'); ?> <span id="intihave" class="badge badge-light"><?php echo $int_ihave;?></span>
				</button>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_ihad'); ?> <span id="intihad" class="badge badge-light"><?php echo $int_ihad;?></span>
				</button>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_iwant'); ?> <span id="intiwant" class="badge badge-light"><?php echo $int_iwant;?></span>
				</button>
			</div>
		</div>

		<?php if ($logged == 1) { ?>
			<div class="col-md-12 alert alert-secondary votespace">
				<?php echo $this->lang->line('database_yourschoice'); ?>
					<div class="form-check form-check-inline" style="margin-left: 10px;">
						<input class="form-check-input" type="checkbox" name="ihave" id="ihave" value="ihave" <?php if ($ihave == 1) echo "checked"; ?>>
						<label class="form-check-label" for="ihave"><?php echo $this->lang->line('database_ihave'); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="ihave" id="ihave" value="ihad" <?php if ($ihad == 1) echo "checked"; ?>>
						<label class="form-check-label" for="ihad"><?php echo $this->lang->line('database_ihad'); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="ihave" id="ihave" value="iwant" <?php if ($iwant == 1) echo "checked"; ?>>
						<label class="form-check-label" for="iwant"><?php echo $this->lang->line('database_iwant'); ?></label>
					</div>
					<span id="successMessage2" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
					<span id="falseMessage2" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
			</div>

		<?php } ?>
		<hr>
		<div class="row">
			<div class="col-md-3">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_winter'); ?> <span id="intwinter" class="badge badge-light"><?php echo $int_winter;?></span>
				</button>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_spring'); ?> <span id="intspring" class="badge badge-light"><?php echo $int_spring;?></span>
				</button>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_summer'); ?> <span id="intsummer" class="badge badge-light"><?php echo $int_summer;?></span>
				</button>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-info">
					<?php echo $this->lang->line('database_autumn'); ?> <span id="intautumn" class="badge badge-light"><?php echo $int_autumn;?></span>
				</button>
			</div>

		</div>

		<?php if ($logged == 1) { ?>
			<div class="col-md-12 alert alert-secondary votespace">
				<?php echo $this->lang->line('database_yourschoice'); ?>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="season" id="season" value="winter" <?php if ($winter == 1) echo "checked"; ?>>
						<label class="form-check-label" for="winter"><?php echo $this->lang->line('database_winter'); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="season" id="season" value="spring" <?php if ($spring == 1) echo "checked"; ?>>
						<label class="form-check-label" for="spring"><?php echo $this->lang->line('database_spring'); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="season" id="season" value="summer" <?php if ($summer == 1) echo "checked"; ?>>
						<label class="form-check-label" for="summer"><?php echo $this->lang->line('database_summer'); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="season" id="season" value="autumn" <?php if ($autumn == 1) echo "checked"; ?>>
						<label class="form-check-label" for="autumn"><?php echo $this->lang->line('database_autumn'); ?></label>
					</div>
					<span id="successMessage3" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
					<span id="falseMessage3" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
			</div>

		<?php } ?>
		<hr>
		<div class="row">
			<div class="col-md-6"><div class="alert alert-success">Dzień: <span id="intday"><?php echo $int_day;?></span></div></div>
			<div class="col-md-6"><div class="alert alert-success">Wieczór: <span id="intnight"><?php echo $int_night;?></span></div></div>
		</div>
		<?php if ($logged == 1) { ?>

		<div class="col-md-12 alert alert-secondary votespace">
		<?php echo $this->lang->line('database_yourschoice'); ?>
			<div class="form-check form-check-inline" style="margin-left: 10px;">
				<input class="form-check-input" type="checkbox" name="daynight" id="daynight" value="day" <?php if ($day == 1) echo "checked"; ?>>
				<label id="intday" class="form-check-label" for="inlineRadio1"><?php echo $this->lang->line('database_day'); ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" name="daynight" id="daynight" value="night" <?php if ($night == 1) echo "checked"; ?>>
				<label class="form-check-label" for="inlineRadio1"><?php echo $this->lang->line('database_night'); ?></label>
			</div>
			<span id="successMessage4" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
			<span id="falseMessage4" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
		</div>
		<?php } ?>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<p><?php echo $description;?></p>
	</div>

	<div class="col-md-6">
		<div class="card">
		  <div class="card-body">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col"><?php echo $this->lang->line('database_capacity');?></th>
			      <th scope="col"><?php echo $this->lang->line('database_ean');?></th>
			    </tr>
			  </thead>
			  <tbody>
				
				<?php 
				foreach ($capacity as $value) {
					 echo '<tr>';
				     echo '<td>'.$value->capacity_value.'ml</td>';
					 echo '<td>'.$value->ean.'</td>';
					 echo '</tr>';
					 $ean = $value->ean;
				}
			   	?>
			  </tbody>
			</table>
		  </div>
		</div>

	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
				  <div class="card-body">
					<h5><?php echo $this->lang->line('database_composition');?></h5>
					<hr>
					<h6>Głowa</h6>

					<p>
						<?php
						if ($base_note == FALSE) 
						{
							echo '<p>Brak danych</p>';
						} else 
						{
							foreach ($base_note as $value)
							{
								echo '<div class="btn-group m-2">';
								echo '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$value->name_note.'</button>';
								echo '<div class="dropdown-menu p-3 form-vote-note shadow p-3 rounded">'; 
								echo '<div class="row">';
								echo '<h5 class="p-2">Oceń moc składnika:</h5>';
								if ($logged == 1) 
								{
									if ($user_vote_base_note==FALSE) 
									{
										$checked = 0;
									} else 
									{
										foreach ($user_vote_base_note as $notedata) 
										{
											$checked = $notedata->vote_value;
										}
									}
									?>
									<div class="col-sm-12">
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="3" <?php if($checked == 3) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Bardzo intensywny (3)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="2" <?php if($checked == 2) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">intensywny (2)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="1" <?php if($checked == 1) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Wyczuwalny (1)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="0" <?php if($checked == 0) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Neutralny (0)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="-1" <?php if($checked == -1) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Nie istnieje (-1)</label>
										</div>
										<span id="success-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
										<span id="false-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
									</div>			
								<?php		
									
								} else  
								{ 
									echo '<div class="col-sm-12">Aby zagłosować musisz być zalogowany.</div>';
								} 
								
								echo '</div></div></div>';
								
							}
						}
						?>
					</p>
					
					<h6><?php echo $this->lang->line('database_basis');?></h6>
					
					<p>
						<?php
						if ($head_note == FALSE) 
						{
							echo '<p>Brak danych</p>';
						} else 
						{
							foreach ($head_note as $value)
							{
								echo '<div class="btn-group m-2">';
								echo '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$value->name_note.'</button>';
								echo '<div class="dropdown-menu p-3 form-vote-note shadow p-3 rounded">'; 
								echo '<div class="row">';
								echo '<h5 class="p-2">Oceń moc składnika:</h5>';
								if ($logged == 1) 
								{
									if ($user_vote_head_note==FALSE) 
									{
										$checked = 0;
									} else 
									{
										foreach ($user_vote_head_note as $notedata) 
										{
											$checked = $notedata->vote_value;
										}
									}
									?>
										<div class="col-sm-12">
											<div class="form-check">
												<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="3" <?php if($checked == 3) { echo "checked";} ?>>
												<label class="form-check-label" for="voteradio">Bardzo intensywny (3)</label>
											</div>
											<div class="form-check">
												<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="2" <?php if($checked == 2) { echo "checked";} ?>>
												<label class="form-check-label" for="voteradio">intensywny (2)</label>
											</div>
											<div class="form-check">
												<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="1" <?php if($checked == 1) { echo "checked";} ?>>
												<label class="form-check-label" for="voteradio">Wyczuwalny (1)</label>
											</div>
											<div class="form-check">
												<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="0" <?php if($checked == 0) { echo "checked";} ?>>
												<label class="form-check-label" for="voteradio">Neutralny (0)</label>
											</div>
											<div class="form-check">
												<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="-1" <?php if($checked == -1) { echo "checked";} ?>>
												<label class="form-check-label" for="voteradio">Nie istnieje (-1)</label>
											</div>
											<span id="success-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
											<span id="false-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
											</div>
										<?php
								} else  
								{ 
									echo '<div class="col-sm-12">Aby zagłosować musisz być zalogowany.</div>';
								} 
								
								echo '</div></div></div>';
								
							}
						}
						?>
					</p>
					<h6><?php echo $this->lang->line('database_heart');?></h6>
					
					<p>
						<?php
						if ($heart_note == FALSE) 
						{
							echo '<p>Brak danych</p>';
						} else 
						{
							foreach ($heart_note as $value)
							{
								echo '<div class="btn-group m-2">';
								echo '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$value->name_note.'</button>';
								echo '<div class="dropdown-menu p-3 form-vote-note shadow p-3 rounded">'; 
								echo '<div class="row">';
								echo '<h5 class="p-2">Oceń moc składnika:</h5>';
								if ($logged == 1) 
								{
									if ($user_vote_heart_note==FALSE) 
									{
										$checked = 0;
									} else 
									{
										foreach ($user_vote_heart_note as $notedata) 
										{
											$checked = $notedata->vote_value;
										}
									}
									?>
									<div class="col-sm-12">
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="3" <?php if($checked == 3) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Bardzo intensywny (3)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="2" <?php if($checked == 2) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">intensywny (2)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="1" <?php if($checked == 1) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Wyczuwalny (1)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="0" <?php if($checked == 0) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Neutralny (0)</label>
										</div>
										<div class="form-check">
											<input class="form-user-note-vote" type="radio" name="voteradio<?php echo $value->id_note; ?>" id="<?php echo $value->id_note; ?>" value="-1" <?php if($checked == -1) { echo "checked";} ?>>
											<label class="form-check-label" for="voteradio">Nie istnieje (-1)</label>
										</div>
											<span id="success-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-success" style="display: none;"><?php echo $this->lang->line('database_thanks_for_vote'); ?></span>
											<span id="false-info-vote-note-<?php echo $value->id_note; ?>" class="badge badge-warning" style="display: none;"><?php echo $this->lang->line('database_error_save_vote'); ?></span>
										</div>
										<?php
									
								} else  
								{ 
									echo '<div class="col-sm-12">Aby zagłosować musisz być zalogowany.</div>';
								} 
								
								echo '</div></div></div>';
								
							}
						}
						?>
					</p>
					


				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
				  <div class="card-body">
					<h5>Zapach według użytkowników</h5>
					<hr>
					<div id="ranking">
					<?php
					if ($ranking == FALSE) {
						echo 'Brak głosów użytkowników.';
					} else {
						foreach($ranking as $value) {
							echo '<button type="button" class="btn btn-info m-1">';
							echo '<small>'.$value->name_note.'</small> <span class="badge badge-light">'.$value->total_value.'</span></button>';
						}
					}
					?>
					</div>
					</div>
				</div>
			</div>
			</div>
	</div>
	<div class="col-md-4">
		<div class="card">
		  <div class="card-body">
		    <table class="table table-striped">
			  <tbody>
			    <tr>
			      <td><?php echo $this->lang->line('database_brand');?></td>
			      <td scope="row"><?php echo $name_brand;?></td>
			    </tr>
			    <tr>
			      <td><?php echo $this->lang->line('database_author');?></td>
			      <td scope="row"><?php echo $author_name;?></td>
			    </tr>
			    <tr>
			      <td><?php echo $this->lang->line('database_creation_date');?></td>
			      <td scope="row"><?php echo $creation_date;?></td>
			    </tr>
			    <tr>
			      <td><?php echo $this->lang->line('database_sex');?></td>
			      <td scope="row"><?php echo $sex;?></td>
			    </tr>
			    <tr>
			      <td><?php echo $this->lang->line('database_type');?></td>
			      <td scope="row"><?php echo $name_type;?></td>
			    </tr>
			  </tbody>
			</table>

		  </div>
		</div>
	</div>
</div>

<hr>

<?php if ($logged == 1) { ?>
<div class="row" id="formreview">
	<div class="col-md-12">
		<?php
			echo validation_errors();
			if (!$this->session->flashdata('message') === FALSE) {
				echo '<div class="alert alert-'.$this->session->flashdata('style').'". role="alert">'.$this->session->flashdata('message');
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
		?>

		<div class="card">
		  <div class="card-body">
				<?php
					$review = array('class' => 'form-horizontal');
					echo form_open("database/product/$id_product/#formreview", $review);
					if (set_value('uservote')) {
						$scorecheck = set_value('uservote');
					} else {
						$scorecheck = $score;
					}
				?>
				
				<h3><?php 
				if (!isset($textreview)) {
					echo $this->lang->line('database_write_review');
				} else {
					echo $this->lang->line('database_update_review');
				}
				echo $product_name; 
				?></h3>
				<div class="form-check form-check-inline">
					<p><?php echo $this->lang->line('database_your_review');?></p>
				</div>
				<div class="form-check form-check-inline">
				  <input name="uservote" class="form-check-input" type="radio" id="uservote" value="1" <?php if ($scorecheck == 1) echo "checked"; ?>>
				  <label class="form-check-label" for="inlineCheckbox1">1</label>
				</div>
				<div class="form-check form-check-inline">
				  <input name="uservote" class="form-check-input" type="radio" id="uservote" value="2" <?php if ($scorecheck == 2) echo "checked"; ?>>
				  <label class="form-check-label" for="inlineCheckbox2">2</label>
				</div>
				<div class="form-check form-check-inline">
				  <input name="uservote" class="form-check-input" type="radio" id="uservote" value="3" <?php if ($scorecheck == 3) echo "checked"; ?>>
				  <label class="form-check-label" for="inlineCheckbox2">3</label>
				</div>
				<div class="form-check form-check-inline">
				  <input name="uservote" class="form-check-input" type="radio" id="uservote" value="4" <?php if ($scorecheck == 4) echo "checked"; ?>>
				  <label class="form-check-label" for="inlineCheckbox2">4</label>
				</div>
				<div class="form-check form-check-inline">
				  <input name="uservote" class="form-check-input" type="radio" id="uservote" value="5" <?php if ($scorecheck == 5) echo "checked"; ?>>
				  <label class="form-check-label" for="inlineCheckbox2">5</label>
				</div>

				<div class="mb-3">
			    <label for="validationTextarea">Twoja recenzja</label>
			    <textarea name="userreview" class="form-control" id="userreview" rows="4"><?php
					if (!empty(set_value('userreview')))  {
						echo set_value('userreview');
					} else {
						echo $textreview;
					} ?></textarea>
			  </div>

				<button type="submit" class="btn btn-primary"><?php 
				if (!isset($textreview)) {
					echo $this->lang->line('database_save_review');
				} else {
					echo $this->lang->line('database_update_your_review');
				}
				?></button>
				<?php
				if (isset($textreview)) {
					echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Usuń wpis</button>';
				}
				?>
				</form><!--end form-->
			</div>
			
		</div>
	</div>
</div>

<!-- Button trigger modal -->

	<?php if (isset($textreview)) { ?>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><? echo $this->lang->line('database_are_you_sure'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>
				<div class="modal-body">
				<? echo $this->lang->line('database_do_you_want_delete_your_review'); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('database_cancel'); ?></button>
					<form>
					<button type="submit" formaction="<?php echo base_url(); ?>database/del_review/<?php echo $id_product; ?>" type="button" class="btn btn-danger"><?php echo $this->lang->line('database_delete_review'); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>


<script type="text/javascript">

	$(document).ready(function(){

		$('input.form-user-note-vote').change(function() {
			if ($(this).is(':checked')) {
				var vote_value = $(this).val();
				var id_note = $(this).attr('id');
			}
			$.ajax ({
				url: "<?php echo base_url();?>database/save_vote_note/",
				type: "POST",
				data: {id_note: id_note, vote_value: vote_value, id_product: <?php echo $id_product;?>},
				dataType: 'json',
				success: function(data) {
					var idInfoName = "#success-info-vote-note-" + id_note;
					$(idInfoName).fadeIn('xfast', function(){
						$(idInfoName).delay(1000).fadeOut();
					});
					
					var str = "";
					data.value.forEach(function(format) {               
						str+= '<button type="button" class="btn btn-info m-1"><small>';
						str+= format.name_note + '</small> <span class="badge badge-light">';
						str+= format.total_value + '</span></button>';             
					});
					$("div#ranking").html(str);
				},
				error: function() {
					var idInfoName = "#false-info-vote-note-" + id_note;
					$(idInfoName).fadeIn('xfast', function(){
						$(idInfoName).delay(1000).fadeOut();
					});
				},
			});
		})

		$('input#ihave, input#season, input#daynight').change(
				function () {
						if ($(this).is(':checked')) {
								var vote = $(this).val();
								var value = 1;
						} else if ($(this).not(':checked')) {
								var vote = $(this).val();
								var value = 0;
						}
						$.ajax ({
							url: "<?php echo base_url();?>database/savevote",
							type: "POST",
							data: {vote: vote, value: value, id_product: <?php echo $id_product;?>},
							dataType: 'json',
							success: function(data) {
								if (data.status)
								{
									if ((vote == 'ihave') || (vote == 'ihad') || (vote == 'iwant')) {
										$('#successMessage2').fadeIn('xfast', function(){
											$('#successMessage2').delay(1000).fadeOut();
										});

									}

									if ((vote == 'winter') || (vote == 'spring') || (vote == 'summer') || (vote == 'autumn')) {
										$('#successMessage3').fadeIn('xfast', function(){
											$('#successMessage3').delay(1000).fadeOut();
										});
									}

									if ((vote == 'day') || (vote == 'night')) {
										$('#successMessage4').fadeIn('xfast', function(){
											$('#successMessage4').delay(1000).fadeOut();
										});
									}
									var id 	 = <?php echo $id_product;?>;
									$.ajax ({
										url: "<?php echo base_url();?>database/get_vote_stat",
										type: "POST",
										data: {
											vote: vote, 
											id: id
										},
										dataType: 'json',
										success: function(data) {
												var ddd = "#int" + vote;
												$(ddd).html(data.value);
										},
										error: function() {

										},
									});

								}
							},
							error: function() {
								if ((vote == 'ihave') || (vote == 'ihad') || (vote == 'iwant')) {
									$('#falseMessage2').fadeIn('xfast', function(){
										$('#falseMessage2').delay(1000).fadeOut();
									});
								}

								if ((vote == 'winter') || (vote == 'spring') || (vote == '$summer') || (vote == 'autumn')) {
									$('#falseMessage3').fadeIn('xfast', function(){
										$('#falseMessage3').delay(1000).fadeOut();
									});
								}

								if ((vote == 'day') || (vote == 'night')) {
									$('#falseMessage4').fadeIn('xfast', function(){
										$('#falseMessage4').delay(1000).fadeOut();
									});
								}
							},
						});
		});
	});
</script>

<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?php echo $name_brand.' '.$product_name;?>",
      "image": [
        "<?php echo $json_img;?>"
       ],
      "description": "<?php echo $description;?>",
      "gtin8": "<?php echo $ean; ?>",
	  "sku": "<?php echo $id_product; ?>",
      "brand": {
        "@type": "Brand",
        "name": "<?php echo $name_brand; ?>"
      },
	  "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo $starsint; ?>",
        "reviewCount": "<?php echo $staruserint; ?>"
      }
    }
</script>

<!-- 
"review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "4",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "Fred Benson"
        }
      },
	  
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo $starsint; ?>",
        "reviewCount": "<?php echo $staruserint; ?>"
      },
      "offers": {
        "@type": "Offer",
        "url": "https://example.com/anvil",
        "priceCurrency": "USD",
        "price": "119.99",
        "priceValidUntil": "2020-11-20",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "Executive Objects"
        }
      }
-->