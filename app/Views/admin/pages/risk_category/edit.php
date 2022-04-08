<form id="form-edit-risk-category" action="" class="form-horizontal" method="POST">
<input type="hidden" class="form-control" id="id" name="id" placeholder="Masukkan Nama Group">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Edit Risk Category</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Risk Category:</label>
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
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</button>
			<button type="button" id="btn-edit-risk-category"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
		</div>
	</div>
</form>

