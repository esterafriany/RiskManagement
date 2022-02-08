<form id="form-edit-kpi" action="" class="form-horizontal" method="POST">
<input type="hidden" class="form-control" id="id" name="id" placeholder="Masukkan Nama Group">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Edit KPI</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">KPI:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Group">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Description:</label>
				<div class="col-sm-9">
				<textarea class="form-control" id="description" name="description"  rows="4"></textarea>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Tahun:</label>
				<div class="col-sm-9">
				<select class="form-control form-select" name="year">
					<option value="" disabled selected hidden >Pilihan</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
				</select>
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
			<button type="button" id="btn-edit-kpi"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>
