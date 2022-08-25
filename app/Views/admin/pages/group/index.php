<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Group User</h4>
               </div>
			      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-group"><svg xmlns="http://www.w3.org/2000/svg"  width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-miterlimit="60" stroke-width="40" d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192s192-86 192-192Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 176v160m80-80H176"/></svg> Tambah</a>
            
			</div>
            <div class="card-body">
				 <div class="table-responsive">
				 
                  <table id="groupTable" class="table table-striped">
                     <thead>
                        <tr>
                           <tr>
                           <th>Nama Group</th>
                           <th>Status</th>
                           <th>Aksi </th>
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

