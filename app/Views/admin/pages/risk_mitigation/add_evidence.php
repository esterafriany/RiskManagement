<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Detail Evidence Bulan - Januari</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="form-group">
                                <small>Rencana Mitigasi</small>
                            </div>

                            <div class="form-group">
                                <small>Detail Mitigasi</small>
                            </div>
                        </li>
                        
                        <li class="list-group-item">
                            
                            <div id="evidenceList2">
                            
                            <div class="form-group">
                                <small>Upload File </small>
                                <form enctype="multipart/form-data" id="modal_form_id"  method="POST" >
    <input type="file" name="documents">
 </form>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-evidence"><i class="fas fa-plus-circle"></i> Tambah File</button>
                                
                            </div>
                         
                            
                            </div>
                       
                              
                        </li>
                    </ul>
                    </div>
                    
                </div>
                <br/>
                
            </div>
            <div class="card-footer">
                <a href="<?=base_url('admin/risk-mitigation')?>" type="button" class="btn btn-secondary">Batal</a>
                <button type="button" id="btn-edit-risk-detail"  class="btn btn-primary">Simpan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_evidence")?>
