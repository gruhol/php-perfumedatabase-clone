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
        echo form_open("admin/add_capacity/$id_product", $attributes);
        ?>
            <input type="hidden" id="id_product" name="id_product" value="<?php echo $id_product;?>">
            <div class="form-group">
                <label for="Name EAN"><?php echo $this->lang->line('admin_ean');?>:</label>
                <input type="text" name="ean" value="<?php echo set_value('ean');?>" class="form-control" id="NameEan">
            </div>
            <div class="form-group">
                <label for="Name EAN2"><?php echo $this->lang->line('admin_ean2');?>:</label>
                <input type="text" name="ean2" value="<?php echo set_value('ean2');?>" class="form-control" id="NameEan2">
            </div>
            <div class="form-group">
                <label for="Name CapacityValue"><?php echo $this->lang->line('admin_capacity');?>:</label>
                <input type="text" name="capacity_value" value="<?php echo set_value('capacity_value');?>" class="form-control" id="NameCapacityValue">
            </div>
            <div class="form-group">
                <label for="Name CapacityValue"><?php echo $this->lang->line('admin_is_tester');?>:</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tester" id="inlineRadio1" value="0" <?php if (set_value('tester') == 0) echo 'checked';?>>
                <label class="form-check-label" for="inlineRadio1"><?php echo $this->lang->line('admin_no');?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tester" id="inlineRadio2" value="1" <?php if (set_value('tester') == 1) echo 'checked';?>>
                <label class="form-check-label" for="inlineRadio2"><?php echo $this->lang->line('admin_yes');?></label>
            </div>
            <hr>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_add');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url("admin/edit_product/$id_product");?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
