<div class="conatiner-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Group User</h4>
               </div>
			   
			  <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-group">Tambah</a>
            
			</div>
            <div class="card-body">
				<p class="mb-0">
					<svg class ="me-2 text-primary" width="24" height="24" viewBox="0 0 24 24">
					   <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
					</svg>
					Daftar Group User 
				</p>
				 
				 <div class="table-responsive">
				 
                  <table id="groupTable" class="table table-striped">
                     <thead>
                        <tr>
                           <tr>
                           <th>Nama Group</th>
                           <th>Status</th>
                           <th>Aksi <i class="fas fa-user"></i></th>
                        </tr>
                        </tr>
                     </thead>
                     
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-group" name="modal-add-group" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/group/create")?></div>
</div>

<div class="modal fade" id="modal-edit-group" name="modal-add-group" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/group/edit")?></div>
</div>

<?= $this->include("js/group")?>

