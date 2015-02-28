<div class="header">
    <h1 class="page-title">Berita</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/news/index');">Berita</a></li>
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
		<?= form_open('/admin/news/do_update', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" name="id" value="<?= $news['news_id']; ?>" />
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="first">
      				<div class="form-group">
	      				<label for="news_title" class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-8">
						  	<input type="text" class="form-control" id="news_title" name="news_title" value="<?= $news['news_title']; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="published_at" class="col-sm-2 control-label">Tgl. Publikasi</label>
						<div class="col-sm-4">
						  	<input type="text" class="form-control" id="published_at" name="published_at" value="<?= $news['published_at']; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="is_publish" class="col-sm-2 control-label">Status Aktif</label>
						<div class="col-sm-8">
							<label class="checkbox-inline">
							  	<input type="radio" id="is_publish" value="1" name="is_publish" <?= $news['is_publish'] == 1 ? 'checked' : ''; ?>> Ya
							</label>
							<label class="checkbox-inline">
							  	<input type="radio" id="is_publish" value="0" name="is_publish" <?= $news['is_publish'] == 0 ? 'checked' : ''; ?>> Tidak
							</label>						
						</div>
					</div>							                		
				</div>
	
				<div class="tab-pane fade" id="second">
					<div style="padding-left: 100px;" class="form-group">
						<textarea name="news_content" id="news_content" class="form-control ckeditor"><?= $news['news_content']; ?></textarea>
					</div>          		  
				</div>
			</div>
			
			<hr />
			
			<div class="btn-toolbar list-toolbar">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<a href="#" onclick="loadPage('/admin/news/index')" data-toggle="modal" class="btn btn-danger">Batal</a>
			</div>
		<?= form_close(); ?>
	</div>
</div>

<script type="text/javascript">
	$("#news_content").summernote({
		height: "230px",
		width: "85%"
	});
	
	$("#published_at").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
	
	var options = {
		beforeSubmit: function(formData, jqForm, options) {
			var queryString = $.param(formData); 
 
			$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' }); 
 
			return true; 
		},
		success: function(responseText, statusText, xhr, $form) {
			$.unblockUI();
			loadPage("/admin/news/index", "update", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>