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
        echo form_open("admin/edit_note/$id_note", $attributes);
        ?>
            <div class="form-group">
                <label for="Name Brand"><?php echo $this->lang->line('admin_name_note');?>:</label>
                <input type="text" name="name_note" value="<?php echo $name_note;?>" class="form-control" id="NameBrand">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1"><?php echo $this->lang->line('admin_category_note');?>:</label>
                <select class="form-control" id="exampleFormControlSelect1" name="id_category_note">
                <?php foreach ($note_category as $value) {
                    if ($value->id_category_note == $id_category_note) {
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
                <textarea class="form-control" name="note_description" id="editor" rows="3"><?php echo $note_description;?></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><?php echo $this->lang->line('admin_save');?></button>
        </form>
		</ul>
        <p class="text-right"><a href="<?php echo site_url('admin/notes');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>
