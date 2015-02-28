<div class="header">
    <h1 class="page-title">User</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/user/index');">User</a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/user/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Nama</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="name" name="name">
				</div>
			</div>
			
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Username</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="username" name="username">
				</div>
			</div>
			
			<div class="form-group">
				<label for="skpd_id" class="col-sm-2 control-label">SKPD</label>
				<div class="col-sm-4">
					<select name="skpd_id" id="skpd_id" class="form-control">
						<option value="">--Pilih--</option>
						<?php foreach ($skpd_list as $skpd): ?>
							<option value="<?= $skpd->skpd_id; ?>"><?= $skpd->nama; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="level" class="col-sm-2 control-label">Level</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" id="level" value="1" name="level"> Administrator
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="level" value="0" name="level" checked> Operator
					</label>						
				</div>
			</div>
			
			<div class="form-group">
				<label for="level" class="col-sm-2 control-label">Status Aktif</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" id="is_active" value="1" name="is_active"> Ya
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="is_active" value="0" name="is_active" checked> Tidak
					</label>						
				</div>
			</div>
	
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-4">
					<input type="password" class="form-control" id="password" name="password">
				</div>
			</div>
			
			<div class="form-group">
				<label for="confirm_password" class="col-sm-2 control-label">Konfirmasi Password</label>
				<div class="col-sm-4">
					<input type="password" class="form-control" id="confirm_password" name="confirm_password">
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
 
			if ($("#password").val() != "" || $("#confirm_password").val() != "") {
				if ($("#confirm_password").val() != $("#password").val()) {
					alert("Password tidak sama!");	
					
					return false;
				}
			}
			
			$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' }); 
 
			return true; 
		},
		success: function(responseText, statusText, xhr, $form) {
			$.unblockUI();
			loadPage("/admin/user/add", "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>