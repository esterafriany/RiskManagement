<form id="form-add-risk-event" action="" class="form-horizontal" method="POST">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupRiskCategoryLabel">Tambah Risiko Utama</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">KPI:</label>
				<div class="col-sm-9">
					<select class="form-control form-select" name="id_kpi">
						<option value="" disabled selected hidden >Pilihan</option>
						<?php
							if($kpi_list){
								foreach($kpi_list as $kpi){
									?>
										<option value="<?=$kpi['id']?>"><?=$kpi['name']?></option>
									<?php
								}	
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0">Nomor Risiko:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="risk_number" name="risk_number">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" >Risiko Utama:</label>
				<div class="col-sm-9">
				<textarea class="form-control" id="risk_event" name="risk_event"  rows="4"></textarea>
			</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Year:</label>
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
			<button type="button" id="btn-add-risk-event"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

