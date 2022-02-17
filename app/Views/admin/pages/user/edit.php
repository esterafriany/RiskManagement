<form id="form-edit-user" action="" class="form-horizontal" method="POST">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Edit User</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<input type="hidden" class="form-control" id="id" name="id">
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" >Name:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama User">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" >Email:</label>
				<div class="col-sm-9">
				<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email User">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" >Password:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password User">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Group:</label>
				<div class="col-sm-9">
				<select class="form-control form-select" name="id_group">
					<option value="" disabled selected hidden >Pilihan</option>
					<?php
						if($group_list){
							foreach($group_list as $group){
								?>
									<option value="<?=$group['id']?>"><?=$group['name']?></option>
								<?php
							}	
						}
					?>
				</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Divisi:</label>
				<div class="col-sm-9">

				<select class="form-control form-select" name="id_division">
					<option value="" disabled selected hidden >Pilihan</option>
					<?php
						if($division_list){
							foreach($division_list as $division){
								?>
									<option value="<?=$division['id']?>"><?=$division['name']?></option>
								<?php
							}	
						}
					?>
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
			<button type="button" id="btn-edit-user"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

