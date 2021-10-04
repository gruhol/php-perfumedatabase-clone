<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row my-3">
	<div class="col-md-6">
		<h3>Lista produktów</h3><p>Znaleziono <?php echo $howmany;?> produktów.</p>
	</div>
	<div class="col-md-6 text-right">
		<br/>
		<nav aria-label="Page navigation">
			<ul class="pagination justify-content-end">
				<?php echo $pagination;?>
			</ul>
		</nav>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
		<?php 
		if (($this->session->userdata('wheretype') !== null) OR
		($this->session->userdata('sex') !== null) OR
		($this->session->userdata('tester') !== null) OR
		($this->session->userdata('brands_input') !== null)) {
			echo '<a  class="btn btn-outline-danger btn-sm" href="'.base_url().'database/del_filters">Usuń wszystkie filtry</a><hr>';
		}
		?>
		<h5 class="display-4">Fitry</h5>
		<hr>
		<p class="lead"><strong>Rodzaj:</strong></p>
		<?php
		echo validation_errors();
		$attributes = array('class' => 'form-horizontal');
		echo form_open('database/index', $attributes);
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
		?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="sex[]"  value="1" id="defaultCheck1" <?php if (isset($female)) echo 'checked';?>>
			<label class="form-check-label" for="defaultCheck1">Damski</label>
		</div>

		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="sex[]" value="2" id="defaultCheck1" <?php if (isset($male)) echo 'checked';?>>
			<label class="form-check-label" for="defaultCheck1">Męski</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="sex[]" value="3" id="defaultCheck1" <?php if (isset($unisex)) echo 'checked';?>>
			<label class="form-check-label" for="defaultCheck1">Unisex</label>
		</div>
		
		<hr>
		<p class="lead"><strong>Marka:</strong></p>
		<div class="scrolling">
			<div class="scrollbrands">
			<?php 
			foreach ($brands as $brands_value) {
				if ($brands_input !== FALSE) {
					$i = 0;
					while ($i < @count($brands_input)) {
						if ($brands_input[$i] == $brands_value->id_brand) {
							$checked = 'checked';
						}
						$i++;
					}
				}
				echo '<div class="form-check">';
				echo '<input class="form-check-input" type="checkbox" name="brands[]" value="'.$brands_value->id_brand.'" id="defaultCheck1" ';
				echo isset($checked) ? $checked : '';
				echo '>';
				echo '<label class="form-check-label" for="defaultCheck1">'.$brands_value->name_brand.'</label>';
				echo '</div>';
				$checked = NULL;
			}
			?>
			</div>
		</div>

		<button type="submit" type="button" class="my-3 btn btn-success btn-block btn-lg">Filtruj</button>
		<?php echo form_close();
		?>
		
	</div>
	<div class="col-md-9">

		
		<div class="row">
			<?php
			if (empty($products)) {
				echo '<p>Brak produktów';
			} else {
				foreach($products as $data) { 
			?>

				<div class="card mb-3 col-md-12">
				<div class="row no-gutters">
					<div class="col-md-3">
					<?php
						if ($data->url_image == NULL OR !isset($data->url_image)) {
							echo '<img src="'.base_url().'img/no-photo.png" class="card-img mx-200" alt="">';
						} else {
							echo '<img src="'.base_url().'img/products/'.$data->url_image.'" style="width:150px" class="card-img" alt="'.$data->alt_image.'">';
						}
					?>

					</div>
					<div class="col-md-9">
					<div class="card-body">
						<h3 class="card-title"><a class="product-link" href="<?php echo base_url().'database/product/'.$data->id_product;?>"><?php echo $data->name_brand.' '.$data->product_name;?></a></h3>
						<p class="card-text"><small class="text-muted">
							<?php echo $data->name_type.' ('.$data->short_type.') ';?></small></p>
						<a href="<?php echo base_url().'database/product/'.$data->id_product;?>" class="btn btn-info btn-sm">Zobacz produkt</a>
					</div>
					</div>
				</div>
				</div>
		
			<?php 
				} 
			}
			?>
		</div>
		<hr>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-end">
				<?php echo $pagination;?>
			</ul>
		</nav>
		
	</div>
</div>

