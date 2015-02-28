<div class="header">
    <h1 class="page-title">Slider</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/slider/index');">Slider</a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open_multipart('/admin/slider/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="slider_title" class="col-sm-2 control-label">Judul</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slider_title" name="slider_title">
				</div>
			</div>
			
			<div class="form-group">
				<label for="slider_title" class="col-sm-2 control-label">Link Internal</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="internal_link" name="internal_link">
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
					<textarea class="form-control" id="description" name="description"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="is_publish" class="col-sm-2 control-label">Status Aktif</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" id="is_publish" value="1" name="is_publish"> Ya
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="is_publish" value="0" name="is_publish" checked> Tidak
					</label>						
				</div>
			</div>							                		
				
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<a href="#" onclick="loadPage('/admin/slider/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/slider/index", "insert", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>