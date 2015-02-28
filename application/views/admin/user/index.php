<style>
	.user_id {
		width: 5%;
	}
	
	.username {
		width: 20%;
	}
	
	.nama {
		width: 30%;
	}
	
	.is_active {
		width: 10%;
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
		<p class="stat"><span class="label label-success"><?= $total_active; ?></span> Active</p>
		<p class="stat"><span class="label label-danger"><?= $total_non_active; ?></span> Non-Active</p>
	</div>

	<h1 class="page-title">User</h1>
    <ul class="breadcrumb">
		<li><a href="#" onclick="loadPage('/admin/dashboard/chart')">Dashboard</a> </li>
		<li class="active">User</li>
	</ul>

</div>

<div class="btn-toolbar list-toolbar">
    <button class="btn btn-primary" onclick="loadPage('/admin/user/add');"><i class="fa fa-plus"></i> Tambah</button>
	<div class="btn-group"></div>
</div>

<table id="grid" class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="user_id" data-header-css-class="user_id">ID</th>
			<th data-column-id="nama" data-header-css-class="nama">Nama SKPD</th>
			<th data-column-id="username" data-header-css-class="username">Username</th>
			<th data-column-id="is_active" data-header-css-class="is_active" data-converter="is_active">Status</th>
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
		url: "/admin/user/list_",
		formatters: {
			"commands": function(column, row) {
				return "<a href=\"#\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.user_id + "\"><span class=\"fa fa-pencil\"></span></a> " +
				"<a href=\"#myModal\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.user_id + "\"><span class=\"fa fa-trash-o\"></span></a>";
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
			is_active: {
				from: function(value) { return value; },
				to: function(value) {
					return value == 0 ? "<font color='#f00'>Non-Active</font>" : "<font color='#0f0'>Active</font>";
				}
			}
		}
	}).on("loaded.rs.jquery.bootgrid", function() {
		grid.find(".command-edit").on("click", function(e) {
			loadPage("/admin/user/edit/id/" + $(this).data("row-id"));
		}).end().find(".command-delete").on("click", function(e) {
			$("#myModal").modal("show");
			$("#row_id").val($(this).data("row-id"));
		});
	});
	
	$("#delete").click(function() {
		$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' });
		
		$.post(
			"/admin/user/do_delete", 
			{
				csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>",
				id: $("#row_id").val()
			}, 
			function(data) {
				$.unblockUI();
				
				if (data == "success")
					loadPage("/admin/user/index", "delete", "success");
				else
					loadPage("/admin/user/index", "delete", "fail");
			}
		);
	});
</script>