<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table table-striped table-dark">
    <tr>
        <td><?php echo $this->lang->line('admin_number_of_users');?>:</td>
        <td><?php echo $valueusers; ?></td>
    </tr>
    <tr>
        <td><?php echo $this->lang->line('admin_number_of_products_in_database');?>:</td>
        <td><?php echo $valueproducts; ?></td>
    </tr>
    <tr>
        <td><?php echo $this->lang->line('admin_number_of_brands');?>:</td>
        <td><?php echo $valuebrands; ?></td>
    </tr>
</table>
