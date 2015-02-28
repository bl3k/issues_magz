<div class="header">
    <h1 class="page-title">Ubah Password</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/user/edit_password/id/' + <?= $this->session->userdata('user_id'); ?>);">Ubah Password</a></li>
	    <li class="active">Ubah</li>
	</ul>
</div>
      
<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/user/do_update_password', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $user['user_id']; ?>" />
			<input type="hidden" name="old_password" value="<?= $user['password']; ?>" />
			
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
			loadPage("/admin/user/edit_password/id/" + <?= $this->session->userdata('user_id'); ?>, "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>