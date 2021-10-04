<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row my-3">
	<div class="col-md-6">
		<h3>Wyszukiwarka</h3><p>Znaleziono <?php echo $howmany;?> produktów dla wyszukiwania "<?php echo $search_keyword;?>"</p>
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
	
	<div class="col-md-12">
		<?php 
		if ($this->session->userdata('search') !== null) {
			echo '<a  class="btn btn-outline-danger btn-sm" href="'.base_url().'search/del_search">Zresetuj wyszukiwarkę</a><hr>';
		}
		?>
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

