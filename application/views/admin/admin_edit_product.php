<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
        <?php
        if ($message !== FALSE) {
            echo '<div class="'.$alert.'" role="alert">'.$message;
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'; 
        }
        ?>
		<ul class="list-group">
        <?php
		echo validation_errors();
		$attributes = array('class' => 'form-horizontal');
        echo form_open("admin/edit_product/$id_product", $attributes);
        ?>
            <div class="row">
	            <div class="col-md-12"><h2><?php echo $this->lang->line('admin_base_information');?>:</h2></div>
            </div>
            <div class="form-group">
                <label for="Product Name"><?php echo $this->lang->line('admin_product_name');?>:</label>
                <input type="text" name="product_name" value="<?php echo $product_name;?>" class="form-control" id="NameProduct">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="Marka"><?php echo $this->lang->line('admin_name_brand');?>:</label>
                        <select class="form-control" id="SelectBrand" name="id_brand">
                        <?php foreach ($brands as $value) {
                            if ($value->id_brand == $id_brand) {
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
                            if ($value->id_type == $id_type) {
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
                            if ($value->id_author == $id_author) {
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
                <div class="form-row">
                    <div class="col">
                        <label for="Creation Date"><?php echo $this->lang->line('admin_creation_date');?>:</label>
                        <input type="text" name="creation_date" value="<?php echo $creation_date;?>" class="form-control" id="CreationDate">
                    </div>
                    <div class="col">
                        <label for="Creation Date"><?php echo $this->lang->line('admin_sex');?>:</label>
                        <select class="form-control" id="SelectAuthor" name="sex">
                            <option value="1" <?php if ($sex == 1) echo 'selected';?>><?php echo $this->lang->line('admin_female');?></option>
                            <option value="2" <?php if ($sex == 2) echo 'selected';?>><?php echo $this->lang->line('admin_male');?></option>
                            <option value="3" <?php if ($sex == 3) echo 'selected';?>><?php echo $this->lang->line('admin_unisex');?></option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label for="descriptionbrand"><?php echo $this->lang->line('admin_product_description');?></label>
                <textarea class="form-control" name="description" id="editor" rows="3"><?php echo $description;?></textarea>
            </div>
            <button type="submit" name="submit_product" value="submit_product" class="btn btn-success mb-2">
                <?php echo $this->lang->line('admin_save');?>
            </button>
        </form>

        <div class="form-group">
            <hr>
            <div class="row pt-3">
	            <div class="col-md-9"><h2><?php echo $this->lang->line('admin_available_capacities');?>:</h2></div>
                <div class="col-md-3"><a class="btn btn-dark" href="<?php echo site_url("/admin/add_capacity/$id_product/");?>" role="button"><?php echo $this->lang->line('admin_add_ean');?></a></div>
            </div>
    
            <table class="table table-bordered thead-dark">
                <thead class="thead-dark">
                    <tr>
                    <th scope="cal"><?php echo $this->lang->line('admin_ean');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_capacity');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_edit');?></th>
                    <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                    </tr>
                </thead>
                <?php
                if ($capacity !== FALSE) {
                    foreach ($capacity as $capa) {
                        echo '<tr>';
                        echo '<td id="tdean'.$capa->id_capacity.'">'.$capa->ean.'</td>';
                        echo '<td id="tdcapacityvalue'.$capa->id_capacity.'">'.$capa->capacity_value.' ml</td>';
                        echo '<td>';
                        ?> 
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?php echo $capa->id_capacity;?>">
                                <?php echo $this->lang->line('admin_edit'); ?>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?php echo $capa->id_capacity;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('admin_edit_capacity'); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                </div>
                                <div id="successMessage<?php echo $capa->id_capacity;?>" class="alert alert-success" role="alert" style="display: none;"><?php echo $this->lang->line('admin_data_update_sucessfull'); ?></div>
                                <div id="falseMessage<?php echo $capa->id_capacity;?>" class="alert alert-warning" role="alert" style="display: none;"><?php echo $this->lang->line('admin_data_update_error'); ?></div>
                                <div class="modal-body">
                                <form id="formdropdownMenu-<?php echo $capa->id_capacity;?>">
                                <div class="form">
                                    <input type="hidden" name="id_capacity<?php echo $capa->id_capacity;?>" value="<?php echo $capa->id_capacity;?>">
                                    <div class="form-group col-md-12">
                                    <label for="inputEAN"><?php echo $this->lang->line('admin_ean'); ?></label>
                                    <input type="text" name="ean<?php echo $capa->id_capacity;?>" class="form-control" value="<?php echo $capa->ean;?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="inputCapacity"><?php echo $this->lang->line('admin_capacity'); ?></label>
                                    <input type="text" name="capacity_value<?php echo $capa->id_capacity;?>" class="form-control" value="<?php echo $capa->capacity_value;?>">
                                    </div>
                                </div>
                                
                                <script type="text/javascript">
                                var id = <?php echo $capa->id_capacity;?>;
                                        $('#formdropdownMenu-<?php echo $capa->id_capacity;?>').submit(function(event){
                                            event.preventDefault(); //prevent default action 
                                            var id_capacity = $(this).find('input[name="id_capacity<?php echo $capa->id_capacity;?>"]').val();
                                            var ean = $(this).find('input[name="ean<?php echo $capa->id_capacity;?>"]').val();
                                            var capacity_value = $(this).find('input[name="capacity_value<?php echo $capa->id_capacity;?>"]').val();

                                            $.ajax ({
                                                url: "<?php echo base_url();?>admin/edit_capacity",
                                                type: "POST",
                                                data: {
                                                    id_capacity: id_capacity, 
                                                    capacity_value: capacity_value, 
                                                    ean: ean
                                                },
                                                dataType: 'json',
                                                success: function(data) {
                                                    if (data.status)
                                                    {
                                                        $('#successMessage<?php echo $capa->id_capacity;?>').fadeIn('xfast', function(){
                                                            $('#successMessage<?php echo $capa->id_capacity;?>').delay(2000).fadeOut();
                                                        });
                                                        
                                                        var after_ean;
                                                        var after_capacity_value;
                                                        data.value.forEach(function(format) {    
                                                        
                                                            after_ean = format.ean;
                                                            after_capacity_value = format.capacity_value + " ml";          
                                                        });
                                                        var targetean = "#tdean<?php echo $capa->id_capacity;?>";
                                                        var targetvalue = "#tdcapacityvalue<?php echo $capa->id_capacity;?>"
                                                        $(targetean).html(after_ean);
                                                        $(targetvalue).html(after_capacity_value);

                                                    } else {
                                                        var targetMessage = "#falseMessage<?php echo $capa->id_capacity;?>";
                                                        $(targetMessage).html(data.value);
                                                        $('#falseMessage<?php echo $capa->id_capacity;?>').fadeIn('xfast', function(){
                                                            $('#falseMessage<?php echo $capa->id_capacity;?>').delay(2000).fadeOut();
                                                        });

                                                        
                                                    }
                                                },
                                                error: function() {
                                                },
                                            });
                                        });
                                    
                                </script>
                                <button type="submit"  name="submit_capacity" value="submit_capacity" class="btn btn-success"><?php echo $this->lang->line('admin_save'); ?></button>
                            </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>

                            <div class="collapse" id="collapseExample<?php echo $capa->id_capacity;?>">
                            <hr>
                            </div>
                            
                        
                        <?php
                        echo '</td>';
                        echo '<td><a class="btn btn-outline-danger btn-sm" href='.site_url("admin/delete_capacity/$capa->id_capacity/$id_product").' onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$capa->ean.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">'.$this->lang->line('admin_no_capacity_assigned').'.</td></tr>';
                }
                ?>
            </table>
            
            <div class="row pt-3">
	            <div class="col-md-12"><h2><?php echo $this->lang->line('admin_nutes');?>:</h2></div>
            </div>
            <hr>
            <div class="row">
	            
                <div class="col-md-4">
                <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#addHeadNote" role="button"><?php echo $this->lang->line('admin_add_note_head');?></button>
                    <table class="table  table-bordered">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col"><?php echo $this->lang->line('admin_note_head');?>:</th>
                            <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyhead">
                            <?php
                            if ($head_note !== FALSE) {
                                foreach($head_note as $head) {
                                    echo '<tr>';
                                    echo '<td>'.$head->name_note.'</td>';
                                    echo '<td><a href="'.site_url("admin/delete_product_note/$head->id_product_notes/$id_product").'" type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$head->name_note.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">'.$this->lang->line('admin_no_fragrance_notes_assigned').'</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#addHeartNote" role="button"><?php echo $this->lang->line('admin_add_note_heart');?></button>
                    <table class="table  table-bordered">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col"><?php echo $this->lang->line('admin_note_heart');?>:</th>
                            <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyheart">
                            <?php
                            if ($heart_note !== FALSE) {
                                foreach($heart_note as $heart) {
                                    echo '<tr>';
                                    echo '<td>'.$heart->name_note.'</td>';
                                    echo '<td><a href="'.site_url("admin/delete_product_note/$heart->id_product_notes/$id_product").'"12 type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$heart->name_note.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">'.$this->lang->line('admin_no_fragrance_notes_assigned').'</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#addBaseNote" role="button"><?php echo $this->lang->line('admin_add_note_base');?></button>
                <table class="table  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col"><?php echo $this->lang->line('admin_note_base');?>:</th>
                        <th scope="cal"><?php echo $this->lang->line('admin_delete');?></th>
                        </tr>
                    </thead>
                    <tbody id="tbodybase">
                        <?php
                        if ($base_note !== FALSE) {
                            foreach($base_note as $base) {
                                echo '<tr>';
                                echo '<td>'.$base->name_note.'</td>';
                                echo '<td><a href="'.site_url("admin/delete_product_note/$base->id_product_notes/$id_product").'" type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("'.$this->lang->line('admin_are_you_sure_to_delete').': '.$base->name_note.'")\'>'.$this->lang->line('admin_delete').'</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">'.$this->lang->line('admin_no_fragrance_notes_assigned').'</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        
        <p class="text-left"><a href="<?php echo site_url('admin/products');?>"><?php echo $this->lang->line('admin_return');?></a></p>
	</div>
</div>

<!-- Modal head -->
<div class="modal fade" id="addHeadNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('admin_add_note');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div id="successMessageHead" class="alert alert-success" role="alert" style="display: none;"></div>
			<div id="falseMessageHead" class="alert alert-warning" role="alert" style="display: none;"></div>
            
            <form id="formhead">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="typeform" value="head">
                    <input type="hidden" name="id_product" value="<?php echo $id_product;?>">
                    <label for="exampleFormControlSelect1"><?php echo $this->lang->line('admin_category_note');?></label>
                    <select name="id_category" class="form-control selectOptionCategory">
                    
                    <option value="0"> -- <?php echo $this->lang->line('admin_select');?> -- </option>
                    <?php
                    foreach ($category as $cat) {
                        echo '<option value="'.$cat->id_category_note.'">'.$cat->name_category.'</option>';    
                    }
                    ?>
                    </select>
                </div>
                <div class="optionnote" class="form-group">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('admin_close');?></button>
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('admin_add_note_head');?></button>
            </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal heart -->
<div class="modal fade" id="addHeartNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('admin_add_note');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="successMessageHeart" class="alert alert-success" role="alert" style="display: none;"></div>
			<div id="falseMessageHeart" class="alert alert-warning" role="alert" style="display: none;"></div>

            <form id="formheart">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="typeform" value="heart">
                    <input type="hidden" name="id_product" value="<?php echo $id_product;?>">
                    <label for="exampleFormControlSelect1"><?php echo $this->lang->line('admin_category_note');?></label>
                    <select name="id_category" class="selectOptionCategory form-control">
                    <option value="0"> -- <?php echo $this->lang->line('admin_select');?> -- </option>
                    <?php
                    foreach ($category as $cat) {
                        echo '<option value="'.$cat->id_category_note.'">'.$cat->name_category.'</option>';    
                    }
                    ?>
                    </select>
                </div>
                <div class="optionnote" class="form-group">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('admin_close');?></button>
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('admin_add_note_heart');?></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal base -->
<div class="modal fade" id="addBaseNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('admin_add_note');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div id="successMessageBase" class="alert alert-success" role="alert" style="display: none;"></div>
			<div id="falseMessageBase" class="alert alert-warning" role="alert" style="display: none;"></div>

            <form id="formbase">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="typeform" value="base">
                    <input type="hidden" name="id_product" value="<?php echo $id_product;?>">
                    <label for="exampleFormControlSelect1"><?php echo $this->lang->line('admin_category_note');?></label>
                    <select name="id_category" class="form-control selectOptionCategory">
                    
                    <option value="0"> -- <?php echo $this->lang->line('admin_select');?> -- </option>
                    <?php
                    foreach ($category as $cat) {
                        echo '<option value="'.$cat->id_category_note.'">'.$cat->name_category.'</option>';    
                    }
                    ?>
                    </select>
                    
                </div>
                <div class="optionnote" class="form-group">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('admin_close');?></button>
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('admin_add_note_base');?></button>
            </div>
                </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.selectOptionCategory').change(function(){
        var category = $(this).children("option:selected").val();
        $.ajax ({
            url: "<?php echo base_url();?>admin/get_note_by_category",
            type: "POST",
            data: {
                id_note_category: category
            },
            dataType: 'json',
            success: function(data) {
                if (data.status)
                {   
                    var str = '<label for="notelebel">Nuta zapachowa</label>';
                    str+= '<select class="selectednoteid form-control" name="noteid">'; 
					data.value.forEach(function(format) {               
                        str+= '<option value="' + format.id_note + '">' + format.name_note + '</option>';            
                    });
                    str+= '</select>';
                    $('.optionnote').html(str);
                } else {   
                }
            },
            error: function() {
            },
        });
    });
});

$('#formhead, #formbase, #formheart').submit(function(event){
    event.preventDefault();
    var typeform = $(this).find('input[name="typeform"]').val();
    var id_product = $(this).find('input[name="id_product"]').val();
    var id_note = $(this).find('.selectednoteid option:selected').val();
    console.log(typeform);
    console.log(id_product);
    console.log(id_note);
    $.ajax ({
        url: "<?php echo base_url();?>admin/add_note_to_product",
        type: "POST",
        data: {
            typeform: typeform,
            id_product: id_product,
            id_note: id_note
        },
        dataType: 'json',
        success: function(data) {
            if (data.status)
            {   
                if (typeform == 'head') 
                {
                    $('#successMessageHead').fadeIn('xfast', function(){
                        $('#successMessageHead').delay(2000).fadeOut();
                    });
                    $('#successMessageHead').html(data.value);

                    var str = '';
					data.head_note.forEach(function(format) {     
                        str+= '<tr>';       
                        str+= '<td>' + format.name_note + '</td>';
                        str+= '<td><a href="' + '<?php echo base_url();?>admin/delete_product_note/' + format.id_product_notes + '/' + format.id_product + '" type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("Czy napewno usunąc nute: ' + format.name_note + '")\'>Usuń</a></td>';
                        str+= '</tr>';           
                    });
                    $('#tbodyhead').html(str);
                } 
                else if (typeform == 'heart') 
                {
                    $('#successMessageHeart').fadeIn('xfast', function(){
                        $('#successMessageHeart').delay(2000).fadeOut();
                    });
                    $('#successMessageHeart').html(data.value);

                    var str = '';
					data.heart_note.forEach(function(format) {     
                        str+= '<tr>';       
                        str+= '<td>' + format.name_note + '</td>';
                        str+= '<td><a href="' + '<?php echo base_url();?>admin/delete_product_note/' + format.id_product_notes + '/' + format.id_product + '" type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("Czy napewno usunąc nute: ' + format.name_note + '")\'>Usuń</a></td>';
                        str+= '</tr>';           
                    });
                    $('#tbodyheart').html(str);
                } 
                else if (typeform == 'base') 
                {
                    $('#successMessageBase').fadeIn('xfast', function(){
                        $('#successMessageBase').delay(2000).fadeOut();
                    });
                    $('#successMessageBase').html(data.value);

                    var str = '';
					data.base_note.forEach(function(format) {     
                        str+= '<tr>';       
                        str+= '<td>' + format.name_note + '</td>';
                        str+= '<td><a href="' + '<?php echo base_url();?>admin/delete_product_note/' + format.id_product_notes + '/' + format.id_product + '" type="button" class="btn btn-outline-danger btn-sm" onClick=\'javascript:return confirm("Czy napewno usunąc nute: ' + format.name_note + '")\'>Usuń</a></td>';
                        str+= '</tr>';           
                    });
                    $('#tbodybase').html(str);


                }
            } else {
                if (typeform == 'head') 
                {
                    $('#falseMessageHead').fadeIn('xfast', function(){
                        $('#falseMessageHead').delay(2000).fadeOut();
                    });
                    $('#falseMessageHead').html(data.value);
                } 
                else if (typeform == 'heart') 
                {
                    $('#falseMessageHeart').fadeIn('xfast', function(){
                        $('#falseMessageHeart').delay(2000).fadeOut();
                    });
                    $('#falseMessageHeart').html(data.value);
                } 
                else if (typeform == 'base') 
                {
                    $('#falseMessageBase').fadeIn('xfast', function(){
                        $('#falseMessageBase').delay(2000).fadeOut();
                    });
                    $('#falseMessageBase').html(data.value);
                }
            }
        },
        error: function() {

        },
    });
});
</script>
