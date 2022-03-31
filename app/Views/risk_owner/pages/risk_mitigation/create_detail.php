<form id="form-add-detail-mitigation" action="" class="form-horizontal" method="POST">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupRiskCategoryLabel">Tambah Detail Mitigasi</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<input type="hidden" value="<?=$id_risk_mitigation?>" name="id_risk_mitigation" id="id_risk_mitigation">
		</div>
		<div class="modal-body">
			<div class="form-group row">
				<label class="control-label col-sm-3 align-self-center mb-0" for="email1">Detail Mitigasi:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="risk_mitigation_detail" name="risk_mitigation_detail" placeholder="Masukkan Detail Mitigasi">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" id="btn-add-detail-mitigation"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

