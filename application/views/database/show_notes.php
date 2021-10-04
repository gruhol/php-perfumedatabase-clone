<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1 class="my-3"><?php echo $h1; ?></h1>

<div class="row">
	<div class="col-md-12">
		<?php
		if ($category_notes == FALSE) 
		{
			echo $this->lang->line('database_there_are_not_brands');
		} 
		else 
		{	
			foreach ($category_notes as $value) {
				echo '<h3>'.$value->name_category.'</h3>';
				echo '<hr>';	
				echo '<div class="mb-3 d-flex flex-wrap">';	
				$category = 'category'.$value->id_category_note;
				
				foreach ($$category as $data) {
					echo '<a type="button" class="btn btn-outline-dark mb-1 mr-1" href="'.base_url().'database/note/'.$data['id_note'].'">'.$data['name_note'].'</a> ';
				}	
				echo '</div>';
			}
		}
		?>
	</div>
</div>