<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1 class="my-3">Perfumy <?php echo $name_brand; ?></h1>

<div class="row">
	<div class="col-md-12">
		<?php echo $description; ?>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<h3>Lista perfum marki <?php echo $name_brand; ?></h3> Znaleziono <?php echo $howmany;?> produktów.
	</div>
	<div class="col-md-6 text-right">
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<?php echo $pagination;?>
			</ul>
		</nav>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
	<?php 
	if (($this->session->userdata('b_wheretype') !== null) OR ($this->session->userdata('b_sex') !== null)) {
			echo '<a  class="btn btn-outline-danger btn-sm" href="'.base_url().'database/del_brand_filters">Usuń wszystkie filtry</a><hr>';
		}
	?> 
	<h5 class="display-4">Fitry:</h5>
	<hr>
		<p class="lead"><strong>Rodzaj:</strong></p>
		<?php
		echo validation_errors();
		$attributes = array('class' => 'form-horizontal');
		echo form_open("database/brand/$id_brand", $attributes);
		foreach($types as $datatypes) {
			if ($wheretype !== FALSE) {
				$i = 0;
				while ($i < count($wheretype)) {
					if ($wheretype[$i] === $datatypes->short_type) {
						$checked = 'checked';
					}
					$i++;
				}
			}
			echo '<div class="form-check">';
			echo '<input class="form-check-input" type="checkbox" name="type[]" value="'.$datatypes->short_type.'" id="type" ';
			echo isset($checked) ? $checked : '';
			echo '>';
			echo '<label class="form-check-label" for="type">';
			echo $datatypes->name_type;
			echo '</label>';
			echo '</div>';
			$checked = NULL;
		}?>

		<hr>
		<p class="lead"><strong>Zapach:</strong></p>
		<?php
		if (!empty($sex)) {
			foreach($sex as $sexdata) {
				if ($sexdata == 1) {
					$female = 1;
				} elseif ($sexdata == 2) {
					$male = 2;
				} elseif ($sexdata == 3) {
					$unisex = 3;
				}
			}
		}

		$y = 0;
			while ($y < count($sexbrand)) {
				if ($sexbrand[$y]['sex'] == 1) {
					?>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="sex[]"  value="1" id="defaultCheck1" <?php if (isset($female)) echo 'checked';?>>
						<label class="form-check-label" for="defaultCheck1">Damski</label>
					</div>
					<?php
				} elseif ($sexbrand[$y]['sex'] == 2) {
					?>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="sex[]" value="2" id="defaultCheck1" <?php if (isset($male)) echo 'checked';?>>
						<label class="form-check-label" for="defaultCheck1">Męski</label>
					</div>
					<?php
				} elseif ($sexbrand[$y]['sex'] == 3) {
					?>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="sex[]" value="3" id="defaultCheck1" <?php if (isset($unisex)) echo 'checked';?>>
						<label class="form-check-label" for="defaultCheck1">Unisex</label>
					</div>
					<?php
				}
			$y++;
			}

		?>
		<button type="submit" type="button" class="my-3 btn btn-success btn-block btn-lg">Filtruj</button>
		<?php echo form_close(); ?>

	</div>
	<div class="col-md-9">

		
		<div class="row">
			<?php
			foreach($products as $data) { 
			?>

			<div class="card mb-3 col-md-12">
			<div class="row no-gutters">
				<div class="col-md-3">
				<?php
					if ($data->url_image == NULL OR !isset($data->url_image)) {
						echo '<img src="'.base_url().'img/no-photo.png" class="card-img" alt="">';
					} else {
						echo '<img src="'.base_url().'img/products/'.$data->url_image.'"  style="width:150px" class="card-img" alt="'.$data->alt_image.'">';
					}
					?>
				</div>
				<div class="col-md-9">
				<div class="card-body">
					<h3 class="card-title"><a class="product-link" href="<?php echo base_url().'database/product/'.$data->id_product;?>"><?php echo $data->name_brand.' '.$data->product_name;?></a></h3>
					<p class="card-text"><small class="text-muted"><?php echo $data->name_type.' ('.$data->short_type.')';?></small></p>
					<a href="<?php echo base_url().'database/product/'.$data->id_product;?>" class="btn btn-secondary btn-sm">Zobacz produkt</a>
				</div>
				</div>
			</div>
			</div>
		
			<?php } ?>
		</div>
		<hr>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<?php echo $pagination;?>
			</ul>
		</nav>
		
	</div>
</div>