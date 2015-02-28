<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JDIH | Kota Cimahi</title>
<meta name="keywords" content="secured theme, free template, templatemo, red layout" />
<meta name="description" content="Secured Theme is provided by templatemo.com" />
<link href="/assets/css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
<script type="text/javascript" src="/assets/js/jquery.min.js" ></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js" ></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script>

<link rel="stylesheet" type="text/css" href="/assets/css/ddsmoothmenu.css" />
<script type="text/javascript" src="/assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="/assets/js/app.js"></script>
<script type="text/javascript" src="/assets/js/ddsmoothmenu.js">
	

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>

</head>
<body>

	<div id="templatemo_wrapper">
		<?php $this->load->view('/portal/_partials/header'); ?>
	</div> <!-- END of header -->


         <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
                <li><a href="/" class="selected">Beranda</a></li>
                <li><a href="#">Organisasi</a>
                    <ul>
                        <li><a href="#" onclick="loadPage('/portal/static_page/index/category/visi-misi');">Visi &amp; Misi</a></li>
                        <li><a href="#" onclick="loadPage('/portal/static_page/index/category/profil');">Profil</a></li>
                        <li><a href="#" onclick="loadPage('/portal/static_page/index/category/jdih');">Tentang JDIH</a></li>
                  </ul>
                </li>
			    <li><a href="#" onclick="loadPage('/portal/produk-hukum');">Produk Hukum</a></li>                       
				<li><a href="#" onclick="loadPage('/portal/news');">Berita</a></li>                
                <li><a href="#" onclick="loadPage('/portal/gallery');">Galeri</a></li>                
                <li><a href="#" onclick="loadPage('/portal/ranham');">Laporan Ranham</a></li>            
                <li class="last"><a href="#" onclick="loadPage('/portal/contact');">Kontak</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
        
		<div id="featured">
		  <ul class="ui-tabs-nav">
			<?php foreach ($slider_list as $key => $slider): ?>
				<li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-<?= $key + 1; ?>"><a href="#fragment-<?= $key + 1; ?>">
					<img src="/uploads/slider/<?= $slider->thumb_file; ?>" alt="" /><span><?= substrwords($slider->slider_title, 80); ?></span></a>
				</li>
			<?php endforeach; ?>
		 </ul>

	    <?php foreach ($slider_list as $key => $slider): ?>
			<div id="fragment-<?= $key + 1; ?>" class="ui-tabs-panel" style="">
				<img src="/uploads/slider/<?= $slider->file; ?>" alt="" />
				 <div class="info" >
					<h3><a href="#"><?= substrwords($slider->slider_title, 80); ?></a></h3>
				 </div>
			</div>
		<?php endforeach; ?>
	</div>
	
    <div id="templatemo_main">
		<div id="container"><div class="content_wrapper">
			<div class="col_1">
				<h2>Selamat Datang di Website JDIH Cimahi</h2>
				<ul class="nobullet latest_work_home">
					<li><p align="justify">Selamat datang di website Jaringan Dokumntasi dan Informasi Hukum Pemerintah Kota Cimahi. Website ini berisi koleksi-koleksi pertauran pemerintah pusat dan pemerintah daerah yang bisa diakses dengan mudah.</p></li>
				</ul>
			</div>
			<hr />
			
			<div class="col_2">
				<h4>Berita Hukum Terbaru</h4>
				<?php foreach ($news_list as $news): ?>
					<h3><?= $news->news_title; ?></h3>
					<em><?= $news->created_by; ?> | <?= date('d/m/Y', strtotime($news->published_at)); ?></em>
					<ul class="nobullet latest_work_home">
						<li><?= substrwords($news->news_content, 200); ?><br /><a href="news_detail.html">&gt;&gt; selengkapnya...</a></li>
					</ul>
					
					<div class="clear"></div>
					<br />
				<?php endforeach; ?>
			</div>
			
			<h4>Produk Hukum Terbaru</h4>
			<p><a href="news_detail.html">&raquo; Perda Nomor 143 tahun 2012</a>
			<br />
			Berisi keterangan singkat tentang produk hukum yang tercantum pada judul.</p>
			<a href="#" class="more">More</a>
			
			<hr />
			
			<!--<p>
				<table width="200" border="0">
					<tr>
						<td valign="top">
							<div class="col_2 no_margin_right">
								<h4>Arsip Perpustakaan</h4>
								<div class="news_list">
									<img src="/assets/images/templatemo_image_01.jpg" alt="Client 1"  class="img_fl img_border img_border_s" />
									<a href="#">Petunjuk Pendidikan Nasional</a>
									<p><span class="holder last">Aturan Pemerintah yang mengatur tentang pendidikan nasional</span></p>
									<div class="clear"></div>
								</div>           
																
								<div class="clear"></div>
								<a href="#" class="more">More</a>
							</div>
						</td>
						<td>&nbsp;</td>
						<td valign="top">
							<div class="col_2 no_margin_right">
								<h4>Relas (Panggilan Pengadilan)</h4>
								<div class="news_list"><a href="#">Panggilan satu</a>
									<p><span class="holder last">Keterangan panggilan satu</span>, k<span class="holder last">eterangan panggilan satu</span>, k<span class="holder last">eterangan panggilan satu</span>, k<span class="holder last">eterangan panggilan satu</span>,</p>
									<div class="clear"></div>
								</div>           
																
								<div class="clear"></div>
								<a href="#" class="more">More</a>
							</div>
						</td>
					</tr>
				</table>
			</p>--></div>
		
		<div class="clear"></div>
		
		</div>
		<div class="clear"></div>
		</div>

	<div id="templatemo_footer">
    	<div class="col_4">
        	<h4>Link Terkait</h4>
            <ul class="nobullet bottom_list">
				<?php foreach ($site_link_list as $site_link): ?>
					<li><a target="_blank" href="<?= $site_link->url; ?>"><?= $site_link->title; ?></a></li>
				<?php endforeach; ?>
            </ul>
        </div>
        
       
       
      <div class="col_4 no_margin_right">
       	<h4>Kontak Kami</h4>
          <p>Gedung Pemkot Cimahi<br />
Jl. Demang Hardjakusumah Gedung B Lt.3,      Cimahi - 40153<br />
Telp. : +62 22 6632601, 
Faks : +62 22 6632601<br />
jdihcimahi@rocketmail.com</p>
        </div>
        <div class="clear"></div>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
<div id="templatemo_copyright_wrapper">
    <div id="templatemo_copyright">
    Copyright © 2013 <a href="#">JDIH Kota Cimahi</a></div>
</div>
</body>
</html>