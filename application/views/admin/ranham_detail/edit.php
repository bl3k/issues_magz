<div class="header">
    <h1 class="page-title">Laporan Ranham</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/ranham/index');">Laporan Ranham</a></li>
	    <li class="active">Ubah</li>
	</ul>
</div>
      
<ul class="nav nav-tabs">
	<li class="active"><a href="#first" data-toggle="tab">Metadata</a></li>
	<li><a href="#second" data-toggle="tab">Konten</a></li>
</ul>

<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/ranham/do_update', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $ranham['ranham_id']; ?>" />
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="first">
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
					
					<div class="form-group">
	      				<label for="permasalahan" class="col-sm-2 control-label">Permasalahan</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="permasalahan" name="permasalahan"><?= $ranham['permasalahan']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="program" class="col-sm-2 control-label">Program</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="program" name="program"><?= $ranham['program']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="kegiatan" class="col-sm-2 control-label">Kegiatan</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="kegiatan" name="kegiatan"><?= $ranham['kegiatan']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="sasaran" class="col-sm-2 control-label">Sasaran</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="sasaran" name="sasaran"><?= $ranham['sasaran']; ?></textarea>
						</div>
					</div>								                		
				</div>
	
				<div class="tab-pane fade" id="second">
					<div class="form-group">
	      				<label for="target_jumlah" class="col-sm-2 control-label">Target/Jumlah</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="target_jumlah" name="target_jumlah"><?= $ranham['target_jumlah']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="outcome" class="col-sm-2 control-label">Outcome</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="outcome" name="outcome"><?= $ranham['outcome']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="hambatan" class="col-sm-2 control-label">Hambatan</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="hambatan" name="hambatan"><?= $ranham['hambatan']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
	      				<label for="tindak_lanjut" class="col-sm-2 control-label">Tindak Lanjut</label>
						<div class="col-sm-8">
						  	<textarea class="form-control" id="tindak_lanjut" name="tindak_lanjut"><?= $ranham['tindak_lanjut']; ?></textarea>
						</div>
					</div>      		  
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