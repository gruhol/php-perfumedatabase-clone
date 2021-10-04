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
        echo form_open("admin/edit_brand/$id_brand", $attributes);
        ?>
            <div class="form-group">
                <label for="Name Brand"><?php echo $this->lang->line('admin_brand_name');?>:</label>
                <input type="text" name="name_brand" value="<?php echo $name_brand;?>" class="form-control" id="NameBrand">
            </div>
            <div class="form-group">
                <label for="descriptionbrand"><?php echo $this->lang->line('admin_brand_description');?></label>
                <textarea class="form-control" name="description_brand" id="editor" rows="3"><?php echo $description_brand;?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/brand');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
