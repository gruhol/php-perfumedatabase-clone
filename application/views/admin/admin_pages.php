<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
        <?php
            if ($message !== FALSE) {
                echo '<div class="'.$alert.'" role="alert">'.$message;
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            }
        ?>
        <div class="row">
            <div class="col-md-4">
                <?php echo $this->lang->line('admin_currently_in_the_database');?>
                <?php 
                    echo $howmany;
                    if ($howmany == 1) { 
                        echo ' '.$this->lang->line('admin_one_page');
                    } elseif ($howmany > 1  AND  $howmany < 5) {
                        echo ' '.$this->lang->line('admin_two_pages');
                    } else {
                        echo ' '.$this->lang->line('admin_more_pages');
                    }
                ?>
            </div>
            <div class="col-md-8">
                <a href="<?php echo base_url().'admin/add_page';?>" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_add_page');?></a>
            </div>
        </div>
		<?php
		if ($page == FALSE) {
			echo $this->lang->line('database_there_are_not_brands');
		} 
		else {
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col"><?php echo $this->lang->line('admin_id_page');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_page_name');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_edit');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                    </tr>
                </thead>
            <?php
			foreach ($page  as $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<td scope="row">'.$value->id_page.'</td>';
                echo '<td>'.$value->page_name.'</td>';
                echo '<td><a class="btn btn-outline-dark btn-sm" href="/admin/edit_page/'.$value->id_page.'" role="button">'.$this->lang->line('admin_edit').'</a></td>';
                echo '<td><a class="btn btn-outline-danger btn-sm" href='.site_url("admin/delete_page/$value->id_page").' onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$value->page_name.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
                echo '</tr>';
                echo '</tbody>';
            }
            echo '</table>';
		}
		?>
		<nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php echo $pagination;?>
            </ul>
        </nav>
	</div>
</div>
