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
				echo '<li class="page-item"><a class="page-link" href="'.base_url().'/database/authors/'.$litera.'">'.$litera.'</a></li>';
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
		if ($authors == FALSE) 
		{
			echo $this->lang->line('database_there_are_not_authors');
		} 
		else 
		{
			foreach ($authors  as $value) {
				echo '<li class="list-group-item"><a href="'.base_url().'/database/author/'.$value->id_author.'" title="'.$value->author_name.'">'.$value->author_name.'</a></li>';
			}
		}
		?>
		</ul>
	</div>
</div>