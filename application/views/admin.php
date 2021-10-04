<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <?php if (isset($script)) echo $script;?>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.4.1.min.js"></script>
    
    <title><?php echo $title; ?> | perfumepedia.org</title>
  </head>
<body>
  <!-- Navigation -->
  <div class="navigation-top">
    <div class="container">
      <div class="row">
        <div class="my-1 text-white text-right col-12 col-sm-12 col-md-12	col-lg-12	col-xl-12">
          <small><?php echo $infolog ?><?php echo $is_admin ?></small>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark navigation-top">
    <div class="container">
    <a class="navbar-brand" href="#">perfumepedia.org <i class="fas fa-database"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link" href="<?php echo base_url(); ?>">Home<span class="sr-only">(current)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>database">Perfumy</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>database/brands">Marki perfum</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>database/authors"><?php echo $this->lang->line('database_authors'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>database/notes"><?php echo $this->lang->line('database_notes'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('page/showpage/3'); ?>">Kontakt</a></li>
      </ul>
      <?php
        $data = array('class' => 'form-inline my-2 my-lg-0');
        echo form_open('search/search', $data);
        
      ?>
        <?php
	        $search = array('name' => 'search','aria-label' => 'Search','id' => 'inputSearch','placeholder' => 'Szukaj','value' => set_value('search'), 'class' => 'form-control mr-sm-2');
	        echo form_input($search);
			  ?>
        <button class="btn btn-light my-2 my-sm-0" type="submit">Szukaj</button>
      </form>
    </div>
    <div>
  </nav>
    
    <!-- Page Content -->
    <div class="container">
      <div class="row my-3">
        <div class="col-md-12">
          <h3><?php echo $title;?></h3>
        </div>
      </div>
      <hr>
      <div class="row my-3">
        <div class="col-md-3">
          <?php echo $admin_menu;?>
        </div>
      <div class="col-md-9">
          <?php echo $content; ?>
      </div>
    </div>
      
    </div>
    

    <footer class="footer mt-5 py-3">
      <div class="container">
        <span class="text-muted"><a href="<?php echo base_url(); ?>page/showpage/4">Polityka Prywatności</a>. Masz sprawę pisz: contact [at] perfumepedia.org</span>
      </div>
    </footer>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.4.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    

    <script src="<?php echo base_url(); ?>dist/trumbowyg.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/ui/trumbowyg.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>dist/langs/pl.min.js"></script>
    <script>
      $('#editor').trumbowyg({
        lang: 'pl',
        btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat']
    ]
      });
    </script>
</body>
</html>
