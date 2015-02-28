<div class="header">
    <h1 class="page-title">Link Terkait</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/site_link/index');">Link Terkait</a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/site_link/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="site_link_title" class="col-sm-2 control-label">Judul</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="title" name="title">
				</div>
			</div>
			
			<div class="form-group">
				<label for="site_link_title" class="col-sm-2 control-label">Alamat URL</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="url" name="url">
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
				<a href="#" onclick="loadPage('/admin/site_link/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/site_link/index", "insert", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>