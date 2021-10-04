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
        echo form_open("admin/add_note", $attributes);
        ?>
            <div class="form-group">
                <label for="Name Brand"><?php echo $this->lang->line('admin_note');?>:</label>
                <input type="text" name="name_note" value="<?php echo set_value('name_note');?>" class="form-control" id="NameBrand">
            </div>
            <div class="form-group">
                <label for="Type"><?php echo $this->lang->line('admin_category_note');?>:</label>
                <select class="form-control" id="SelectType" name="id_category_note">
                <?php foreach ($notes as $value) {
                            if ($value->id_category_note == set_value('id_category_note')) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            echo '<option value="'.$value->id_category_note.'" '.$selected.'>'.$value->name_category.'</option>';
                            $selected = '';
                        }
                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="descriptionbrand"><?php echo $this->lang->line('admin_note_description');?>:</label>
                <textarea class="form-control" name="note_description" id="editor" rows="3"><?php echo set_value('note_description');?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_add');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/notes');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
