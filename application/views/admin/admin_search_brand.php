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
                <?php echo $this->lang->line('admin_found').':<br />'.$howmany.' '.$this->lang->line('admin_brands_perfumes').' '.$this->lang->line('admin_for_word')."<strong><?php echo $search_keyword; ?></strong>.";?>
            </div>
            <div class="col-md-2">
                <a href="<?php echo base_url().'admin/add_brand';?>" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_add_new_brand');?></a>
            </div>
            <div class="col-md-5">
                <?php
                $data = array('class' => 'form-inline my-lg-0');
                echo form_open('admin/search_brand', $data);
                ?>
                <?php 
                $search = array('name' => 'search','aria-label' => 'Search','id' => 'inputSearch','placeholder' => 'Szukaj','value' => set_value('search'), 'class' => 'form-control mr-sm-2');
                echo form_input($search);
                ?>
                <button class="btn btn-warning mb-2 my-sm-0" type="submit"><?php echo $this->lang->line('admin_go_search');?></button>
                </form>
            </div>
        </div> 
		<?php
		if ($brand == FALSE) {
			echo $this->lang->line('database_there_are_not_brands');
		} 
		else {
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col"><?php echo $this->lang->line('admin_id_brand');?></th>
                    <th scope="col"><?php echo $this->lang->line('admin_brand_name');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_edit');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                    </tr>
                </thead>
            <?php
			foreach ($brand  as $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row">'.$value->id_brand.'</th>';
                echo '<td>'.$value->name_brand.'</td>';
                echo '<td><a class="btn btn-outline-dark btn-sm" href="/admin/edit_brand/'.$value->id_brand.'" role="button">'.$this->lang->line('admin_edit').'</a></td>';
                echo '<td><a class="btn btn-outline-danger btn-sm" href='.site_url("admin/delete_brand/$value->id_brand").' onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').' '.$value->name_brand.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
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
