<form id="form-edit-division" action="" class="form-horizontal" method="POST">
<input type="hidden" class="form-control" id="id" name="id" placeholder="Masukkan Nama Group">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Edit Risk Owner</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Risk Owner:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Group">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Kode Risk Owner:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="division_code" name="division_code" placeholder="Masukkan Nama Group">
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
			<button type="button" id="btn-edit-division"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

