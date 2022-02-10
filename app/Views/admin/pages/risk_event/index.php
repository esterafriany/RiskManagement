<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Risiko Utama</h4>
               </div>
			      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-risk-event">Tambah</a>
			   </div>
            <div class="card-body">
				 <div class="table-responsive">
				 
                  <table id="riskEventTable" class="table table-striped" width="100%">
                     <thead>
                        <tr>
                           <th>Nomor Risiko</th>
                           <th>KPI</th>
                           <th>Risiko Utama</th>
                           <th>Tahun</th>
                           <th>Status</th>
                           <th>Aksi</th>
                        </tr>
                     </thead> 
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-risk-event" name="modal-add-risk-event" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/risk_event/create")?></div>
</div>

<?= $this->include("js/risk_event")?>

