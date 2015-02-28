<div class="header">
    <h1 class="page-title">Kategori Peraturan</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/kategori_peraturan/index');">Kategori Peraturan</a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/kategori_peraturan/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="judul" class="col-sm-2 control-label">Judul</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="judul" name="judul">
				</div>
			</div>
			
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<a href="#" onclick="loadPage('/admin/kategori_peraturan/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/kategori_peraturan/index", "insert", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>