<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow"/>
    <meta name=”Keywords” content=”Odpowiednio dobrane słowa kluczowe”>
    <META name=”Description” content=”unikalny opis podstrony”>
    <?php if (isset($canonical)) {
      echo '<link rel="canonical" href="'.$canonical.'" />';
    }
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <?php if (isset($script)) echo $script;?>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.4.1.min.js"></script>
    <title><?php echo $title; ?> | perfumepedia.org</title>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P3PPLZX');</script>
    <!-- End Google Tag Manager -->
  </head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3PPLZX"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

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
    <a class="navbar-brand" href="<?php echo base_url(); ?>">perfumepedia.org <i class="fas fa-database"></i></a>
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
	        $login = array('name' => 'search','aria-label' => 'Search','id' => 'inputSearch','placeholder' => 'Szukaj','value' => set_value('search'), 'class' => 'form-control mr-sm-2');
	        echo form_input($login);
			  ?>
        <button class="btn btn-light my-2 my-sm-0" type="submit">Szukaj</button>
      </form>
    </div>
    <div>
  </nav>
    
    <!-- Page Content -->
    <div class="container">
    	<?php echo $content; ?>
    </div>
    <div class="container mt-3">
      <?php if (isset($reviews)) { echo $reviews; }; ?>
    </div>

    <footer class="footer mt-auto py-3">
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
</body>
</html>
