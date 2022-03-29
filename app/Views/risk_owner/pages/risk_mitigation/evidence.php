<form id="form-add-evidence" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url('admin/RiskMonitoringController/onUploadEvidence')?>">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addGroupModalLabel">Tambah Evidence></h5>
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
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" id="btn-add-kpi"  class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

<?= $this->include("js/detail_evidence")?>

