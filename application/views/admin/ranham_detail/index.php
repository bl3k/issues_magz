<style>
	.ranham_detail_id {
		width: 5%;
	}
	
	.tahun {
		width: 7%;
	}
	
	.created_by {
		width: 10%;
	}
	
	.created_at {
		width: 15%;
	}
	
	.semester {
		width: 53%;
	}
	
	.commands {
		width: 10%;
	}
</style>

<div class="header">
    <div class="stats">
		<p class="stat"><span class="label label-info"><?= $total_records; ?></span> Total</p>
	</div>

	<h1 class="page-title">Laporan Ranham</h1>
    <ul class="breadcrumb">
		<li><a href="#" onclick="loadPage('/admin/dashboard/chart')">Dashboard</a> </li>
		<li><a href="#" onclick="loadPage('/admin/ranham/index')">Laporan Ranham</a> </li>
		<li class="active">Tahun <?= $ranham['tahun']; ?> (<?= $ranham['semester'] == 1 ? 'Januari - Juni' : 'Juni - Desember'; ?>)</li>
	</ul>

</div>

<div class="btn-toolbar list-toolbar">
    <button class="btn btn-primary" onclick="loadPage('/admin/ranham_detail/add/id/' + <?= $ranham['ranham_id']; ?>);"><i class="fa fa-plus"></i> Tambah</button>
	<div class="btn-group"></div>
</div>

<table id="grid" class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="ranham_detail_id" data-header-css-class="ranham_detail_id">ID</th>
			<th data-column-id="permasalahan" data-header-css-class="permasalahan">Permasalahan</th>
			<th data-column-id="program" data-header-css-class="program">Program</th>
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
				csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>",
				id: <?= $ranham_id; ?>
			}
		},
		url: "/admin/ranham_detail/list_",
		formatters: {
			"commands": function(column, row) {
				return "<a href=\"#\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.ranham_detail_id + "\"><span class=\"fa fa-pencil\"></span></a> " +
				"<a href=\"#myModal\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.ranham_detail_id + "\"><span class=\"fa fa-trash-o\"></span></a> " +
				"<a href=\"#\" class=\"btn btn-xs btn-default command-detail\" data-row-id=\"" + row.ranham_detail_id + "\"><span class=\"fa fa-eye\"></span></a>";
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
			semester: {
				from: function(value) { return value; },
				to: function(value) {
					return value == 1 ? "Januari - Juni" : "Juni - Desember";
				}
			}
		}
	}).on("loaded.rs.jquery.bootgrid", function() {
		grid.find(".command-edit").on("click", function(e) {
			loadPage("/admin/ranham_detail/edit/id/" + $(this).data("row-id"));
		}).end().find(".command-delete").on("click", function(e) {
			$("#myModal").modal("show");
			$("#row_id").val($(this).data("row-id"));
		}).end().find(".command-detail").on("click", function(e) {
			loadPage("/admin/ranham_detail/edit/id/" + $(this).data("row-id"));
		});
	});
	
	$("#delete").click(function() {
		$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' });
		
		$.post(
			"/admin/ranham_detail/do_delete", 
			{
				csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>",
				id: $("#row_id").val()
			}, 
			function(data) {
				$.unblockUI();
				
				if (data == "success")
					loadPage("/admin/ranham_detail/index", "delete", "success");
				else
					loadPage("/admin/ranham_detail/index", "delete", "fail");
			}
		);
	});
</script>