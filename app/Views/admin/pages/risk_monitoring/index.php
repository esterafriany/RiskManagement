<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data KPI</h4>
               </div>
			      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-kpi">Tambah</a>
			   </div>
            <div class="card-body">
				<div class="table-responsive">
               <table id="kpiTable" class="table table-striped" width="100%">
                  <thead>
                     <tr>
                        <th>KPI</th>
                        <th>Status</th>
                        <th>Aksi <i class="fas fa-user"></i></th>
                     </tr>
                  </thead> 
               </table>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-kpi" name="modal-add-kpi" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/kpi/create")?></div>
</div>

<div class="modal fade" id="modal-edit-kpi" name="modal-edit-kpi" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/kpi/edit")?></div>
</div>

<?= $this->include("js/kpi")?>

