<style>
	.kategori_dok_hukum_id {
		width: 5%;
	}
	
	.judul {
		width: 40%;
	}
	
	.created_by {
		width: 10%;
	}
	
	.created_at {
		width: 15%;
	}
	
	.commands {
		width: 10%;
	}
</style>

<div class="header">
    <div class="stats">
		<p class="stat"><span class="label label-info"><?= $total_records; ?></span> Total</p>
	</div>

	<h1 class="page-title">Kategori Peraturan</h1>
    <ul class="breadcrumb">
		<li><a href="#" onclick="loadPage('/admin/dashboard/chart')">Dashboard</a> </li>
		<li class="active">Kategori Peraturan</li>
	</ul>

</div>

<div class="btn-toolbar list-toolbar">
    <button class="btn btn-primary" onclick="loadPage('/admin/kategori_peraturan/add');"><i class="fa fa-plus"></i> Tambah</button>
	<div class="btn-group"></div>
</div>

<table id="grid" class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="kategori_dok_hukum_id" data-header-css-class="kategori_dok_hukum_id">ID</th>
			<th data-column-id="judul" data-header-css-class="judul">Judul</th>
			<th data-column-id="created_at" data-header-css-class="created_at" data-converter="datetime">Tgl. Input</th>
			<th data-column-id="created_by" data-header-css-class="created_by">Author</th>
			<th data-column-id="commands" data-formatter="commands" data-sortable="false" data-header-css-class="commands">Aksi</th>
		</tr>
	</thead>
</table>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Konfirmasi</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-warning modal-icon"></i>Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
			<input type="hidden" id="row_id" />
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
            <button class="btn btn-danger" data-dismiss="modal" id="delete">Hapus</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
	var grid = $("#grid").bootgrid({
		ajax: true,
		post: function () {
			return {
				csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>"
			}
		},
		url: "/admin/kategori_peraturan/list_",
		formatters: {
			"commands": function(column, row) {
				return "<a href=\"#\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.kategori_dok_hukum_id + "\"><span class=\"fa fa-pencil\"></span></a> " +
				"<a href=\"#myModal\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.kategori_dok_hukum_id + "\"><span class=\"fa fa-trash-o\"></span></a>";
			}
		},
		converters: {
			date: {
				from: function(value) { return new Date(value); },
				to: function(value) {
					return moment(value).format("DD/MM/YYYY");
				}
			},
			datetime: {
				from: function(value) { return new Date(value); },
				to: function(value) {
					return moment(value).format("DD/MM/YYYY HH:mm:ss");
				}
			},
			is_publish: {
				from: function(value) { return value; },
				to: function(value) {
					return value == 0 ? "<font color='#f00'>Unpublish</font>" : "<font color='#0f0'>Publish</font>";
				}
			}
		}
	}).on("loaded.rs.jquery.bootgrid", function() {
		grid.find(".command-edit").on("click", function(e) {
			loadPage("/admin/kategori_peraturan/edit/id/" + $(this).data("row-id"));
		}).end().find(".command-delete").on("click", function(e) {
			$("#myModal").modal("show");
			$("#row_id").val($(this).data("row-id"));
		});
	});
	
	$("#delete").click(function() {
		$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' });
		
		$.post(
			"/admin/kategori_peraturan/do_delete", 
			{
				csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>",
				id: $("#row_id").val()
			}, 
			function(data) {
				$.unblockUI();
				
				if (data == "success")
					loadPage("/admin/kategori_peraturan/index", "delete", "success");
				else
					loadPage("/admin/kategori_peraturan/index", "delete", "fail");
			}
		);
	});
</script>