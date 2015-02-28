<div id="templatemo_main">
	<div class="content_wrapper content_mb_60">
		<div class="col_1">
			<!--<h4><?= $static_page['static_page_title']; ?></h4>-->
			<br />
			<?= $static_page['static_page_content']; ?>
		</div>
		<div class="clear"></div>
		<hr />
		<em>Terakhir update tanggal : <?= date('d/m/Y H:i:s', strtotime($static_page['updated_at'])); ?></em>
	</div>