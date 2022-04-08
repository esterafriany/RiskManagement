<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Divisi</h4>
               </div>
			      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-division">Tambah</a>
			   </div>
            <div class="card-body">
				 <div class="table-responsive">
                  <table id="divisionTable" class="table table-striped" width="100%">
                     <thead>
                        <tr>
                           <tr>
                           <th>Divisi</th>
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

<div class="modal fade" id="modal-add-division" name="modal-add-division" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/division/create")?></div>
</div>

<div class="modal fade" id="modal-edit-division" name="modal-add-division" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/division/edit")?></div>
</div>

<?= $this->include("js/division")?>

