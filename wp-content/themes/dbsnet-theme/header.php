
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <button type="button" class="btn btn-warning" onclick="topFunction()" id="topBtn" title="Go to top">Top</button>
    <script>
      window.onscroll = function() {scrollFunction()};
      function scrollFunction(){
        if(document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
          document.getElementById("topBtn").style.display = "block";
        }
        else{
          document.getElementById("topBtn").style.display = "none";
        }
      }
      function topFunction(){
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php _e(home_url());?>">Dibuang Sayang</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if(!is_user_logged_in()): ?>
            <li><a href="#">Daftar</a></li>
            <li><a href="#">Masuk</a></li>
            <?php else: ?>
            <?php $user_info = get_userdata(get_current_user_id()); ?>
            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Keranjang <span class="badge">5</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> <?php _e($user_info->first_name); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kotak Surat <span class="badge">5</span></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Profil</a></li>
                <li><a href="<?php current_user_can('manage_options') ? _e(admin_url()) : _e('#'); ?>"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Dashboard</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Keluar</a></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container after-navbar bg-warning">
      <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-3"></div>
        <form class="col-md-6" role="search">
          <div class="input-group">
            <span class="input-group-btn">
              <select name="" class="form-control">
                <option value="0">Kategori</option>
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
              </select>
            </span>
            <input type="text" class="form-control" aria-label="..." name="">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
          </div> <!-- /input-group -->
        </form>
      </div>
    </div>

    <div class="container bg-danger">
      <div id="dbsnetCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
          <li data-target="#dbsnetCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#dbsnetCarousel" data-slide-to="1"></li>
          <li data-target="#dbsnetCarousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
          <div class="item active">
            <img alt="nature" src="https://images-na.ssl-images-amazon.com/images/G/01/kindle/merch/2017/SMP/ftvs/popcorngws/1500x300_Lifestyle_v1._CB503869808_.jpg" style="width: 100%">
          </div>
          <div class="item">
            <img alt="fjords" src="https://images-na.ssl-images-amazon.com/images/G/01/AMAZON_FASHION/2017/EDITORIAL/SUMMER_3/GATEWAY/DESKTOP/1x/HERO_W_xCat_ShoppingList2_1x._CB504779749_.jpg" style="width: 100%">
          </div>
          <div class="item">
            <img alt="mountains" src="https://images-na.ssl-images-amazon.com/images/G/01/digital/video/merch/gateway/superhero/Amazon_GW_DesktopHero_AVD-6545_SpongebobSwap_GWAcquisitionTopStreamGrid_V1_1500x300._CB506302663_.jpg" style="width: 100%">
          </div>
        </div>

        <a class="left carousel-control" data-slide="prev" href="#dbsnetCarousel">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" data-slide="next" href="#dbsnetCarousel">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div> <!-- /container -->

    <div class="container bg-info">
      <!-- Example row of columns -->
      <div class="row">       