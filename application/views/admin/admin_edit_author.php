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
        echo form_open("admin/edit_author/$id_author", $attributes);
        ?>
            <div class="form-group">
                <label for="AuthorName"><?php echo $this->lang->line('admin_author_name');?></label>
                <input type="text" name="author_name" value="<?php echo $author_name;?>" class="form-control" id="NameBrand">
            </div>

            <div class="form-group">
                <label for="author_description"><?php echo $this->lang->line('admin_author_description');?></label>
                <textarea class="form-control" name="author_description" id="editor" rows="3"><?php echo $author_description;?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/authors');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
