<div class="header">
    <h1 class="page-title">Halaman Statis</h1>
	<ul class="breadcrumb">
	    <li><a href="#" onclick="loadPage('/admin/dashboard/chart');">Dashboard</a></li>
	    <li><a href="#" onclick="loadPage('/admin/static_page/index/category/<?= $slug; ?>');"><?= $title; ?></a></li>
	    <li class="active">Tambah</li>
	</ul>
</div>
      
<ul class="nav nav-tabs">
	<li class="active"><a href="#first" data-toggle="tab">Metadata</a></li>
	<li><a href="#second" data-toggle="tab">Konten</a></li>
</ul>

<div class="row">
	<div class="col-xs-12">
    	<br>
		<?= form_open('/admin/static_page/do_insert', array('id' => 'form', 'role' => 'form', 'class' => 'form-horizontal')); ?>
			<input type="hidden" class="form-control" id="category" value="<?= $title; ?>" name="category">
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="first">					
					<div class="form-group">
	      				<label for="static_page_title" class="col-sm-2 control-label">Slug</label>
						<div class="col-sm-4">
						  	<input type="text" class="form-control" id="slug" value="<?= $slug; ?>" name="slug" readonly>
						</div>
					</div>
					
      				<div class="form-group">
	      				<label for="static_page_title" class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-8">
						  	<input type="text" class="form-control" id="static_page_title" value="<?= $title; ?>" name="static_page_title" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label for="published_at" class="col-sm-2 control-label">Tgl. Publikasi</label>
						<div class="col-sm-4">
						  	<input type="text" class="form-control" id="published_at" name="published_at">
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
				</div>
	
				<div class="tab-pane fade" id="second">
					<div style="padding-left: 100px;" class="form-group">
						<textarea name="static_page_content" id="static_page_content" class="form-control ckeditor"></textarea>
					</div>          		  
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
	$("#static_page_content").summernote({
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
			loadPage("/admin/static_page/index/category/<?= $slug; ?>", "insert", responseText);
		},
		resetForm: true
	};
	
	$("#form").ajaxForm(options);
</script>