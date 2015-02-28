<div class="header">
    <h1 class="page-title">Galeri</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/gallery/index');">Galeri</a></li>
	    <li class="active">Ubah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open_multipart('/admin/gallery/do_update', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $gallery['gallery_id']; ?>" />
			<input type="hidden" name="old_file" value="<?= $gallery['file']; ?>" />
			<input type="hidden" name="old_thumb_file" value="<?= $gallery['thumb_file']; ?>" />
			<div class="form-group">
				<label for="gallery_title" class="col-sm-2 control-label">Judul</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gallery_title" name="gallery_title" value="<?= $gallery['gallery_title']; ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label for="published_at" class="col-sm-2 control-label">File</label>
				<div class="col-sm-4">
					<input type="file" class="form-control" id="file" name="file">
				</div>
			</div>
			
			<div class="form-group">
				<label for="published_at" class="col-sm-2 control-label">Deskripsi</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="description" name="description"><?= $gallery['description']; ?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="is_publish" class="col-sm-2 control-label">Status Aktif</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" id="is_publish" value="1" name="is_publish" <?= $gallery['is_publish'] == 1 ? 'checked' : ''; ?>> Ya
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="is_publish" value="0" name="is_publish" <?= $gallery['is_publish'] == 0 ? 'checked' : ''; ?>> Tidak
					</label>						
				</div>
			</div>							                		
				
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<a href="#" onclick="loadPage('/admin/gallery/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/gallery/index", "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>