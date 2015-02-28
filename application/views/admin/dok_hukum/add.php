<div class="header">
    <h1 class="page-title">Dokumentasi Hukum</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/dok_hukum/index');">Dokumentasi Hukum</a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>

<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open_multipart('/admin/dok_hukum/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="kategori_dok_hukum_id" class="col-sm-2 control-label">Kategori</label>
				<div class="col-sm-4">
					<select name="kategori_dok_hukum_id" id="kategori_dok_hukum_id" class="form-control">
						<option value="">--Pilih--</option>
						<?php foreach ($kategori_dok_hukum_list as $kategori_dok_hukum): ?>
							<option value="<?= $kategori_dok_hukum->kategori_dok_hukum_id; ?>"><?= $kategori_dok_hukum->judul; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="bentuk_dok_hukum_id" class="col-sm-2 control-label">Bentuk</label>
				<div class="col-sm-4">
					<select name="bentuk_dok_hukum_id" id="bentuk_dok_hukum_id" class="form-control">
						<option value="">--Pilih--</option>
						<?php foreach ($bentuk_dok_hukum_list as $bentuk_dok_hukum): ?>
							<option value="<?= $bentuk_dok_hukum->bentuk_dok_hukum_id; ?>"><?= $bentuk_dok_hukum->judul; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="nomor" class="col-sm-2 control-label">Tahun</label>
				<div class="col-sm-1">
					<input type="text" class="form-control" id="tahun" name="tahun">
				</div>
			</div>
			
			<div class="form-group">
				<label for="nomor" class="col-sm-2 control-label">Nomor</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nomor" name="nomor">
				</div>
			</div>
			
			<div class="form-group">
				<label for="nomor" class="col-sm-2 control-label">Perihal</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="perihal" name="perihal"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="published_at" class="col-sm-2 control-label">File</label>
				<div class="col-sm-4">
					<input type="file" class="form-control" id="file" name="file">
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
				<a href="#" onclick="loadPage('/admin/dok_hukum/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/dok_hukum/index", "insert", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>