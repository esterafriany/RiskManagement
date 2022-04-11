<form id="form-add-risk-event" action="" class="form-horizontal" method="POST">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupRiskCategoryLabel">Tambah Risiko Utama</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="form-group row">
								<small><b>Sasaran</b></small>
								<div class="col-sm-12">
								<input type="text" class="form-control" id="objective" name="objective">
								</div>
							</div>
							<div class="form-group row">
								<small><b>KPI</b></small>
								<div class="col-sm-12">
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
								<small><b>Risiko Utama</b></small>
								<div class="col-sm-12">
								<textarea class="form-control" id="risk_event" name="risk_event"  rows="3"></textarea>
							</div>
							</div>
							<div class="form-group row">
								<small><b>Year</b></small>
								<div class="col-sm-12">
								<select class="form-control form-select" name="year">
									<option value="" disabled selected hidden >Pilihan</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
								</select>
								</div>
							</div>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="form-group row">
								<small><b>Existing Control/Pengendalian Yang Ada</b></small>
							</div>
							<div class="form-group row">
								<div class="col-sm-4"><small>Ada/Tidak Ada</small></div>
								<div class="col-sm-8">
									<select class="form-control form-select" name="existing_control_1">
										<option value="" disabled selected hidden >Pilihan</option>
										<option value="Ada">Ada</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4"><small>Memadai/Tidak Memadai</small></div>
								<div class="col-sm-8">
									<select class="form-control form-select" name="existing_control_2">
										<option value="" disabled selected hidden >Pilihan</option>
										<option value="Memadai">Memadai</option>
										<option value="Tidak Memadai">Tidak Memadai</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4"><small>Dijalankan/Belum Dijalankan</small></div>
								<div class="col-sm-8">
									<select class="form-control form-select" name="existing_control_3">
										<option value="" disabled selected hidden >Pilihan</option>
										<option value="Dijalankan">Dijalankan</option>
										<option value="Belum Dijalankan">Belum Dijalankan</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<small><b>Analisis Risiko Inheren (Inherent Risk)</b></small>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<small>Tingkat Kemungkinan</small>
									<div class="col-sm-12">
										<select class="form-control form-select" name="probability_level">
											<option value="" disabled selected hidden >Pilihan</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<small>Tingkat Dampak</small>
									<div class="col-sm-12">
										<select class="form-control form-select" name="impact_level">
											<option value="" disabled selected hidden >Pilihan</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<small><b>Analisis Risiko Residual (Residual Risk)</b></small>
								</div>
							</div>
							<div class="form-group row">
							<div class="col-sm-6">
									<small>Tingkat Kemungkinan</small>
									<div class="col-sm-12">
										<select class="form-control form-select" name="target_probability_level">
											<option value="" disabled selected hidden >Pilihan</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<small>Tingkat Dampak</small>
									<div class="col-sm-12">
										<select class="form-control form-select" name="target_impact_level">
											<option value="" disabled selected hidden >Pilihan</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>

							
						</li>
					</ul>
				</div>
          	</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</button>
			<button type="button" id="btn-add-risk-event"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
		</div>
	</div>
</form>


