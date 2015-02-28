<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>JDIH | Pemerintah Kota Cimahi</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/js/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/plugins/summernote/css/summernote.css">
    <link rel="stylesheet" href="/assets/plugins/jquery-ui-1.11.2.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="/assets/css/jquery.bootgrid.min.css" />
    
    <script src="/assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
    <script src="/assets/js/app.js" type="text/javascript"></script>
    <script src="/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.form.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.blockUI.js" type="text/javascript"></script>
    <script src="/assets/js/moderniz.2.8.1.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.bootgrid.min.js" type="text/javascript"></script>
    <script src="/assets/js/moment.min.js" type="text/javascript"></script>
    
    <link rel="stylesheet" type="text/css" href="/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/premium.css">
        
    <style>
        .modal {
            overflow-y: auto;
        }
        
        .modal-open {
            overflow: auto;
        }
    </style>
</head>

<body class=" theme-blue">

    <!-- Demo page code -->

    <script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }

            $('[data-popover="true"]').popover({html: true});
            
        });
    </script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
   
  <!--<![endif]-->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand">JDIH | Pemerintah Kota Cimahi</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?= $username; ?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="#" onclick="loadPage('/admin/user/edit_current_user/id/' + <?= $this->session->userdata('user_id'); ?>);">Setting Akun</a></li>
                <li><a href="#" onclick="loadPage('/admin/user/edit_password/id/' + <?= $this->session->userdata('user_id'); ?>);">Ubah Password</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Admin Panel</li>
                <li><a href="#" onclick="loadPage('/admin/skpd/index');">Data SKPD</a></li>
                <li><a href="#" onclick="loadPage('/admin/user/index');">Manajemen User</a></li>
                <li class="dropdown-header">Admin JDIH</li>
                <li><a href="#" onclick="loadPage('/admin/bentuk_peraturan/index');">Bentuk Peraturan</a></li>
                <li><a href="#" onclick="loadPage('/admin/kategori_peraturan/index');">Kategori Peraturan</a></li>
                <li><a href="#" onclick="loadPage('/admin/dok_hukum/index');">Dokumentasi Hukum</a></li>
                <li class="dropdown-header">Ranham</li>
                <li><a href="#" onclick="loadPage('/admin/ranham/index');">Laporan Ranham</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="/admin/index/do_logout">Logout</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>
    

    <div class="sidebar-nav">
		<?php $this->load->view('/admin/_partials/sidebar_nav'); ?>
    </div>

    <div class="content">
        <div id="container"></div>
    
            <footer>
                <?php $this->load->view('/admin/_partials/footer'); ?>
            </footer>
        </div>
    </div>


    <script src="/assets/js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
            loadPage("/admin/dashboard/chart");
        });
    </script>
    
  
</body></html>