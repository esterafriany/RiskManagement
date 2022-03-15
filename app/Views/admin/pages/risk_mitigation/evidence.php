<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">List Evidence</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
            <input type="hidden" class="form-control" id="id_risk_event" name="id_risk_event" value="">
       
                <br/>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Evidence:
                                </li>
                                <li class="list-group-item">
                                    <div id="evidenceList">
                    
                                    </div><br/>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-cause"><i class="fas fa-plus-circle"></i> Tambah File</button>
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
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

