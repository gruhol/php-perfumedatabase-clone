<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ul class="list-group">
  <li class="list-group-item"><a href="/admin/index"><?php echo $this->lang->line('admin_dashboard');?></a></li>
  <li class="list-group-item"><a href="/admin/brand"><?php echo $this->lang->line('admin_brands');?></a></li>
  <li class="list-group-item"><a href="/admin/authors"><?php echo $this->lang->line('admin_authors');?></a></li>
  <li class="list-group-item"><a href="/admin/products"><?php echo $this->lang->line('admin_perfums');?></a></li>
  <li class="list-group-item"><a href="/admin/notes"><?php echo $this->lang->line('admin_nutes');?></a></li>
  <li class="list-group-item"><a href="/admin/reviews"><?php echo $this->lang->line('admin_reviews_prefums');?></a></li>
  <li class="list-group-item"><a href="/admin/pages"><?php echo $this->lang->line('admin_pages');?></a></li>
</ul>
