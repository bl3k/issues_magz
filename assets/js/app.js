// view filename
function loadPage(file, crudStatus, response) {
	$.blockUI({ message: '<img src="/assets/img/spinnerx.gif" />' });
	
	if (crudStatus != undefined) {
		$("#container").load(file, function() {
			$.unblockUI();
			
			if (crudStatus == "insert") {
				response == "success" ? $.growlUI('Informasi', 'Data berhasil disimpan!') : $.growlUI('Informasi', 'Data gagal disimpan!');
			} else if (crudStatus == "update") {
				response == "success" ? $.growlUI('Informasi', 'Data berhasil diubah!') : $.growlUI('Informasi', 'Data gagal diubah!');
			} else {
				response == "success" ? $.growlUI('Informasi', 'Data berhasil dihapus!') : $.growlUI('Informasi', 'Data gagal dihapus!');
			}
		});
	} else {
		$("#container").load(file, function() {
			$.unblockUI()
		});
	}
}