<form id="form-add-evidence" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url('RiskOwner/RiskMonitoringController/onUploadEvidence')?>">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Tambah Evidence</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <input type="hidden" name="id_detail_mitigation"/>
            <input type="hidden" name="month"/>
        </div>
		<div class="modal-body">
        <ul class="list-group">
            <li class="list-group-item">   
                <div class="form-group">
                    <small>Upload File </small>
                    <div id="evidenceList">
                        
                    </div><br/>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-evidence"><i class="fas fa-plus-circle"></i> Tambah File</button>
                    
                </div>       
            </li>
        </ul>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</button>
			<button type="submit" id="btn-add-kpi"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
		</div>
	</div>
</form>

<?= $this->include("js/detail_evidence")?>

