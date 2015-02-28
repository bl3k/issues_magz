<div id="templatemo_header">
	<div id="site_title"><a rel="nofollow" href="#">JDIH</a></div>
	<div id="templatemo_search">
		<form action="#" method="get">
		  <input type="text" value="Masukan kata kunci" name="keyword" id="keyword" title="keyword" 
				onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
		  <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn" />
		</form>
		
		<ul id="social">
			<?php if ($social_media): ?>
				<li><a href="<?= $social_media['facebook_url']; ?>" target="_blank"><img src="/assets/images/facebook.png" alt="facebook" /></a></a></li>
				<li><a href="<?= $social_media['twitter_url']; ?>" target="_blank"><img src="/assets/images/twitter.png" alt="twitter" /></a></li>
			<?php endif; ?>
		</ul>
	</div>