<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Detail Mitigasi Risiko</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Rencana Mitigasi</small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation->risk_mitigation?></textarea>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div align="right">
                                        <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-detail-mitigation">Tambah</a>
                                    </div>
                                
                                    <table id="riskDetailMitigationTable" class="table table-striped" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Detail Mitigasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead> 
                                    </table>
                                    </div>
                            </div>
                        </li>
                    </ul>
                    
                    </div>
                    
                </div>
                <br/>
                
            </div>
            <div class="card-footer">
                
            </div>
         </div>
      </div>
      </form>
   </div>
</div>

			   

<div class="modal fade" id="modal-add-detail-mitigation" name="modal-add-detail-mitigation" tabindex="-1" aria-labelledby="addDetailMitigationModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("risk_owner/pages/risk_mitigation/create_detail")?></div>
</div>

<div class="modal fade" id="modal-edit-detail-mitigation" name="modal-edit-detail-mitigation" tabindex="-1" aria-labelledby="addDetailMitigationModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("risk_owner/pages/risk_mitigation/edit_detail")?></div>
</div>


<?= $this->include("js/risk_owner/detail_risk_mitigation")?>

<style>
   .dataTables_paginate .paginate_button{
      padding-right: 5px;
   }
   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>