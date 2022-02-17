<form id="form-add-division" action="" class="form-horizontal" method="POST">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupRiskCategoryLabel">Tambah Divisi</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0">Divisi:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Divisi">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Kode Divisi:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="division_code" name="division_code" placeholder="Masukkan Nama Divisi">
				
			</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Status:</label>
				<div class="col-sm-9">
				<select class="form-control form-select" name="is_active">
					<option value="" disabled selected hidden >Pilihan</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" id="btn-add-division"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

