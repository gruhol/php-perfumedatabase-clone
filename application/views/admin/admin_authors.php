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
            <?php echo $this->lang->line('admin_currently_in_the_database').' '.$howmany.' '.$this->lang->line('admin_perfumers');?>
            </div>
            <div class="col-md-3">
                <a href="<?php echo base_url().'admin/add_author';?>" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_add_new_person');?></a>
            </div>
            <div class="col-md-5">
                <?php
                $data = array('class' => 'form-inline my-lg-0');
                echo form_open('admin/search_note', $data);
                ?>
                <?php
                $search = array(
                    'name' => 'search',
                    'aria-label' => 'Search',
                    'id' => 'inputSearch',
                    'placeholder' => $this->lang->line('admin_go_search'),
                    'value' => set_value('search'),
                    'class' => 'form-control mr-sm-2'
                );
                echo form_input($search);
                ?>
                <button class="btn btn-warning mb-2 my-sm-0" type="submit"><?php echo $this->lang->line('admin_go_search');?></button>
                </form>
            </div>
        </div>
		<?php
		if ($authors == FALSE) {
			echo $this->lang->line('database_there_are_not_authors');
		} 
		else {
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col"><?php echo $this->lang->line('admin_id_author');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_author');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_edit');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                    </tr>
                </thead>
            <?php
			foreach ($authors  as $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row">'.$value->id_author.'</th>';
                echo '<td>'.$value->author_name.'</td>';
                echo '<td><a class="btn btn-outline-dark btn-sm" href="/admin/edit_author/'.$value->id_author.'" role="button">'.$this->lang->line('admin_edit').'</a></td>';
                echo '<td><a class="btn btn-outline-danger btn-sm" href='.site_url("admin/delete_author/$value->id_author").' onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$value->author_name.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
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
