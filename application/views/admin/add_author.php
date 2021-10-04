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
        echo form_open('admin/add_author', $attributes);
        ?>
            <div class="form-group">
                <label for="NameAuthor"><?php echo $this->lang->line('admin_author_name');?>:</label>
                <input type="text" name="author_name" value="<?php set_value('author_name');?>" class="form-control" id="NameAuthor">
            </div>
            <div class="form-group">
                <label for="page_content"><?php echo $this->lang->line('admin_author_description');?></label>
                <textarea class="form-control" name="author_description" id="editor" rows="5"><?php set_value('author_description');?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/authors');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
