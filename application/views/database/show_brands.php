<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1 class="my-3"><?php echo $h1; ?></h1>
<div class="row">
	<div class="col-md-12">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
			<?php
			foreach (range('a', 'z') as $litera) 
			{
				echo '<li class="page-item"><a class="page-link" href="'.base_url().'database/brands/'.$litera.'">'.$litera.'</a></li>';
			} 
		    ?>
		  </ul>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<ul class="list-group">
		<?php
		if ($brands == FALSE) 
		{
			echo $this->lang->line('database_there_are_not_brands');
		} 
		else 
		{
			echo '<div class="row">';
			//foreach ($brands  as $value) {
				
				echo '<div class="col-md-3">';		
				echo '<ul class="list-group">';
				$howmany = @count($brands) / 3;
				if ($howmany <= 1) $howmany = 1;
				$table = array_chunk($brands, $howmany);
				if (isset($table[0])) {
					foreach ($table[0] as $value0) {
						echo '<li class="list-group-item"><a href="'.base_url().'database/brand/'.$value0->id_brand.'" title="'.$value0->name_brand.'">'.$value0->name_brand.'</a></li>';
					}
				}
				echo '</ul>';
				echo '</div>';
					if (isset($table[1])) {
						echo '<div class="col-md-3">';		
						echo '<ul>';
						foreach ($table[1] as $value1) {
							
							echo '<li class="list-group-item"><a href="'.base_url().'database/brand/'.$value1->id_brand.'">'.$value1->name_brand.'</a></li>';
							
						}
						echo '</ul></div>';
					}
					if (isset($table[2])) {
						echo '<div class="col-md-3">';		
						echo '<ul>';
						foreach ($table[2] as $value2) {
							
							echo '<li class="list-group-item"><a href="'.base_url().'database/brand/'.$value2->id_brand.'">'.$value2->name_brand.'</a></li>';
							
						}
						echo '</ul></div>';
					}
					if (isset($table[3])) {
						echo '<div class="col-md-3">';		
						echo '<ul>';
						foreach ($table[3] as $value3) {
							
							echo '<li class="list-group-item"><a href="'.base_url().'database/brand/'.$value3->id_brand.'">'.$value3->name_brand.'</a></li>';
							
						}
						echo '</ul></div>';
					}
			//}
			echo '</div>';
		}
		?>
		</ul>
	</div>
</div>