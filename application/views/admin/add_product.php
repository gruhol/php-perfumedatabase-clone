<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
        
		<ul class="list-group">
        <?php
		echo validation_errors();
		$attributes = array('class' => 'form-horizontal');
        echo form_open("admin/add_product", $attributes);
        ?>
            <div class="row">
	            <div class="col-md-12"><h2><?php echo $this->lang->line('admin_base_information');?>:</h2></div>
            </div>
            <div class="form-group">
                <label for="Product Name"><?php echo $this->lang->line('admin_product_name');?>:</label>
                <input type="text" name="product_name" value="<?php echo set_value('product_name');?>" class="form-control" id="NameProduct">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="Product Name"><?php echo $this->lang->line('admin_creation_date');?>:</label>
                        <input type="text" name="creation_date" value="<?php echo set_value('creation_date');?>" class="form-control" id="NameCreationDate">
                    </div>
                    <div class="col">
                        <label for="Type"><?php echo $this->lang->line('admin_sex');?>:</label>
                        <select class="form-control" id="SelectAuthor" name="sex">
                            <option value="1" <?php if (set_value('sex') == 1) echo 'selected';?>><?php echo $this->lang->line('admin_female');?></option>
                            <option value="2" <?php if (set_value('sex') == 2) echo 'selected';?>><?php echo $this->lang->line('admin_male');?></option>
                            <option value="3" <?php if (set_value('sex') == 3) echo 'selected';?>><?php echo $this->lang->line('admin_unisex');?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="Marka"><?php echo $this->lang->line('admin_name_brand');?>:</label>
                        <select class="form-control" id="SelectBrand" name="id_brand">
                        <?php foreach ($brands as $value) {
                            if ($value->id_brand == set_value('id_brand')) {
                                $selected1 = 'selected';
                            } else {
                                $selected1 = '';
                            }
                            echo '<option value="'.$value->id_brand.'" '.$selected1.'>'.$value->name_brand.'</option>';
                            $selected1 = '';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="Type"><?php echo $this->lang->line('admin_perfume_type');?>:</label>
                        <select class="form-control" id="SelectType" name="id_type">
                        <?php foreach ($types as $value) {
                            if ($value->id_type == set_value('id_type')) {
                                $selected2 = 'selected';
                            } else {
                                $selected2 = '';
                            }
                            echo '<option value="'.$value->id_type.'" '.$selected2.'>'.$value->name_type.' ('.$value->short_type.')</option>';
                            $selected2 = '';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="Type"><?php echo $this->lang->line('admin_author');?>:</label>
                        <select class="form-control" id="SelectAuthor" name="id_author">
                        <?php foreach ($authors as $value) {
                            if ($value->id_author == set_value('id_author')) {
                                $selected3 = 'selected';
                            } else {
                                $selected3 = '';
                            }
                            echo '<option value="'.$value->id_author.'" '.$selected3.'>'.$value->author_name.'</option>';
                            $selected3 = '';
                        }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="descriptionbrand"><?php echo $this->lang->line('admin_product_description');?>:</label>
                <textarea class="form-control" name="description" id="editor" rows="3"><?php echo set_value('description');?></textarea>
            </div>
            <button type="submit" name="submit_product" value="submit_product" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
        
        <p class="text-right"><a href="<?php echo site_url('admin/products');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
