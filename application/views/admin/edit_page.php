<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-10">
        <?php
        if ($message !== FALSE) {
            echo '<div class="'.$alert.'" role="alert">'.$message.'</div>';   
        }
        ?>
		<ul class="list-group">
        <?php
		echo validation_errors();
		$attributes = array('class' => 'form-horizontal');
        echo form_open("admin/edit_page/$id_page", $attributes);
        ?>
            <div class="form-group">
                <label for="Name Page"><?php echo $this->lang->line('admin_page_name');?>:</label>
                <input type="text" name="page_name" value="<?php echo $page_name;?>" class="form-control" id="NamePage">
            </div>
            <div class="form-group">
                <label for="Name Page"><?php echo $this->lang->line('admin_page_title');?>:</label>
                <input type="text" name="page_title" value="<?php echo $page_title;?>" class="form-control" id="Nametitle">
            </div>
            <div class="form-group">
                <label for="page_content"><?php echo $this->lang->line('admin_page_content');?></label>
                <textarea class="form-control" name="page_content" id="editor" rows="5"><?php echo $page_content;?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/pages');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
