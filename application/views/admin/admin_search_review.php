<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
        <?php
            if ($message !== FALSE) {
                echo '<div class="'.$alert.'" role="alert">'.$message.'</div>';
            }
        ?>
        <div class="row">
            <div class="col-md-5">
                <?php echo $this->lang->line('admin_found').':<br />'.$howmany.' '.$this->lang->line('admin_one_review').' '.$this->lang->line('admin_for_word')."<strong><?php echo $search_keyword; ?></strong>.";?>
            </div>
            <div class="col-md-7">
                <?php
                $data = array('class' => 'form-inline my-lg-0');
                echo form_open('admin/search_review', $data);
                ?>
                <?php
                $search = array('name' => 'search','aria-label' => 'Search','id' => 'inputSearch','placeholder' => $this->lang->line('admin_go_search'),'value' => set_value('search'), 'class' => 'form-control mr-sm-2');
                echo form_input($search);
                ?>
                <button class="btn btn-warning mb-2 my-sm-0" type="submit"><?php echo $this->lang->line('admin_go_search');?></button>
                </form>
            </div>
        </div> 
		<?php
		if ($review== FALSE) {
			echo $this->lang->line('database_there_are_not_brands');
		} 
		else {
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col"><?php echo $this->lang->line('admin_id_review');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_data');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_user');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_product');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_edit');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                    </tr>
                </thead>
            <?php
			foreach ($review  as $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<td scope="row"><small>'.$value->id_review.'</small></td>';
                echo '<td><small>'.$value->data_review.'</small></td>';
                echo '<td><small>'.$value->login.'</small></td>';
                echo '<td><small>'.$value->product_name.'</small></td>';
                echo '<td><small>'.$value->textreview.'</small></td>';
                echo '<td><a class="btn btn-outline-danger btn-sm" href='.site_url("admin/delete_review/$value->id_review").' onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$value->id_user.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
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
