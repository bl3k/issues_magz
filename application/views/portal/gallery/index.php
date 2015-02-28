<link rel="stylesheet" href="/assets/css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="/assets/js/slimbox2.js"></script>

<div id="templatemo_main">
	<ul id="gallery" class="nobullet">
		<?php foreach ($gallery_list as $gallery): ?>
			<li>
				<a href="/uploads/gallery/<?= $gallery->file; ?>" rel="lightbox[portfolio]"><img src="/uploads/gallery/<?= $gallery->thumb_file; ?>" alt="<?= $gallery->gallery_title; ?>" class="img_border img_border_b" /></a><br /><br />
				<center><em><?= $gallery->gallery_title; ?> (<?= $gallery->created_at; ?>)</em></center>
			</li>
		<?php endforeach; ?>
	</ul>
</div>