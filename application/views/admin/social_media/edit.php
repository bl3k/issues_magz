<div class="header">
    <h1 class="page-title">Sosial Media</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/social_media/index');">Sosial Media</a></li>
	    <li class="active">Ubah</li>
	</ul>
</div>

<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/social_media/do_update', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $social_media['social_media_id']; ?>" />
			<div class="form-group">
				<label for="facebook_url" class="col-sm-2 control-label">Facebook</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="facebook_url" name="facebook_url" value="<?= $social_media['facebook_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="google_plus_url" class="col-sm-2 control-label">Google+</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="google_plus_url" name="google_plus_url" value="<?= $social_media['google_plus_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="google_plus_url" class="col-sm-2 control-label">Instagram</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="instagram_url" name="instagram_url" value="<?= $social_media['instagram_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="linkedin_url" class="col-sm-2 control-label">Linkedin</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="linkedin_url" name="linkedin_url" value="<?= $social_media['linkedin_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="picasa_url" class="col-sm-2 control-label">Picasa</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="picasa_url" name="picasa_url" value="<?= $social_media['picasa_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="twitter_url" class="col-sm-2 control-label">Twitter</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="twitter_url" name="twitter_url" value="<?= $social_media['twitter_url']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="youtube_url" class="col-sm-2 control-label">Youtube</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="youtube_url" name="youtube_url" value="<?= $social_media['youtube_url']; ?>">
				</div>
			</div>
			
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
		<?= form_close(); ?>
	</div>
</div>

<script type="text/javascript">
	var options = {
		beforeSubmit: function(formData, jqForm, options) {
			var queryString = $.param(formData); 
 
			$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' }); 
 
			return true; 
		},
		success: function(responseText, statusText, xhr, $form) {
			$.unblockUI();
			loadPage("/admin/social_media/index", "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>