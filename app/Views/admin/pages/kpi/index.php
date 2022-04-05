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
            <p> <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.25 16.334V7.665C21.25 4.645 19.111 2.75 16.084 2.75H7.916C4.889 2.75 2.75 4.635 2.75 7.665L2.75 16.334C2.75 19.364 4.889 21.25 7.916 21.25H16.084C19.111 21.25 21.25 19.364 21.25 16.334Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                <path d="M16.0861 12H7.91406" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                <path d="M12.3223 8.25205L16.0863 12L12.3223 15.748" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                            </svg>                             
                  Semakin tinggi prioritas KPI, nilai level semakin tinggi.</p>
            
               <table id="kpiTable" class="table table-striped" width="100%">
                  <thead>
                     <tr>
                        <th>KPI</th>
                        <th>Status</th>
                        <th>Aksi</i></th>
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

