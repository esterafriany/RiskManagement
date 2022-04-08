<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Risk Category</h4>
               </div>
			      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-risk-category"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-miterlimit="60" stroke-width="40" d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192s192-86 192-192Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 176v160m80-80H176"/></svg> Tambah</a>
			   </div>
            <div class="card-body">
				 <div class="table-responsive">
				 
                  <table id="riskCategoryTable" class="table table-striped" width="100%">
                     <thead>
                        <tr>
                           <tr>
                           <th>Risk Category</th>
                           <th>Deskripsi</th>
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

<div class="modal fade" id="modal-add-risk-category" name="modal-add-risk-category" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/risk_category/create")?></div>
</div>

<div class="modal fade" id="modal-edit-risk-category" name="modal-add-risk-category" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/risk_category/edit")?></div>
</div>

<?= $this->include("js/risk_category")?>

<style>
   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>