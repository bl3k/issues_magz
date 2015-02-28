<div class="header">
    <h1 class="page-title">Laporan Ranham</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/ranham/index');">Laporan Ranham</a></li>
	    <li class="active">Ubah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/ranham/do_update', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $ranham['ranham_id']; ?>" />
			<div class="form-group">
				<label for="skpd_id" class="col-sm-2 control-label">SKPD</label>
				<div class="col-sm-4">
					<select name="skpd_id" id="skpd_id" class="form-control">
						<option value="">--Pilih--</option>
						<?php foreach ($skpd_list as $skpd): ?>
							<option <?= $ranham['skpd_id'] == $skpd->skpd_id ? 'selected' : ''; ?> value="<?= $skpd->skpd_id; ?>"><?= $skpd->nama; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
				
			<div class="form-group">
				<label for="tahun" class="col-sm-2 control-label">Tahun</label>
				<div class="col-sm-1">
					<input type="text" class="form-control" id="tahun" name="tahun" value="<?= $ranham['tahun']; ?>" />
				</div>
			</div>
			
			<div class="form-group">
				<label for="semester" class="col-sm-2 control-label">Semester</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" id="semester" value="1" name="semester" <?= $ranham['semester'] == 1 ? 'checked' : ''; ?>> I
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="semester" value="2" name="semester" <?= $ranham['semester'] == 2 ? 'checked' : ''; ?>> II
					</label>						
				</div>
			</div>
			
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<a href="#" onclick="loadPage('/admin/ranham/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
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
			loadPage("/admin/ranham/index", "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>