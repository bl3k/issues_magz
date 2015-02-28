<div class="content_wrapper">
			<div class="col_2">
				<h2>Selamat Datang di Website JDIH Cimahi</h2>
				<ul class="nobullet latest_work_home">
					<li><p align="justify">Selamat datang di website Jaringan Dokumntasi dan Informasi Hukum Pemerintah Kota Cimahi. Website ini berisi koleksi-koleksi pertauran pemerintah pusat dan pemerintah daerah yang bisa diakses dengan mudah.</p></li>
				</ul>
			</div>
			
			<br />
		
			<div class="col_2">
				<?php foreach ($news_list as $news): ?>
					<h3><?= $news->news_title; ?></h3>
					<ul class="nobullet latest_work_home">
						<li><?= $news->news_content; ?>&nbsp;<a href="news_detail.html">&gt;&gt; selengkapnya</a></li>
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
			</p>-->