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
               <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <p class="mb-md-0 mb-2 d-flex align-items-center">
                     <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M4.56517 3C3.70108 3 3 3.71286 3 4.5904V5.52644C3 6.17647 3.24719 6.80158 3.68936 7.27177L8.5351 12.4243L8.53723 12.4211C9.47271 13.3788 9.99905 14.6734 9.99905 16.0233V20.5952C9.99905 20.9007 10.3187 21.0957 10.584 20.9516L13.3436 19.4479C13.7602 19.2204 14.0201 18.7784 14.0201 18.2984V16.0114C14.0201 14.6691 14.539 13.3799 15.466 12.4243L20.3117 7.27177C20.7528 6.80158 21 6.17647 21 5.52644V4.5904C21 3.71286 20.3 3 19.4359 3H4.56517Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     Pilih Kolom: 
                     <div class="form-check">
                        <input class="toggle-vis" type="checkbox" value="" data-column="0">
                        <label class="form-check-label" for="flexCheckChecked11">Sasaran</label>
                        
                        <input class="toggle-vis" type="checkbox" value="" data-column="1">
                        <label class="form-check-label" for="flexCheckChecked11">KPI</label>

                        
                        <input class="toggle-vis" type="checkbox" value="" data-column="2">
                        <label class="form-check-label" for="flexCheckChecked11">No. Resiko</label>

                        
                        <input class="toggle-vis" type="checkbox" value="" data-column="3">
                        <label class="form-check-label" for="flexCheckChecked11">Resiko Utama</label>

                        
                        <input class="toggle-vis" type="checkbox" value="" data-column="4">
                        <label class="form-check-label" for="flexCheckChecked11">Tahun</label>

                        
                     </div>
                  </p>
                  <div class="d-flex align-items-center flex-wrap">
                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                           <path d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                                                   
                        Tahun &nbsp;
                     
                     <div class="dropdown">
                     <select class="form-control" id="year_selected" name="year_selected" onchange="update_risk_table()">
                        <option value="2021">2021</option>
                        <option value="2022" selected>2022</option>
                     </select>
                     </div>
                  </div>
               </div><br/>
				<div class="table-responsive">
               <table id="riskEventTable" class="table" width="100%">
                  <thead>
                     <tr>
                        <th>Sasaran</th>
                        <th>KPI</th>
                        <th>Nomor Risiko</th>
                        <th>Risiko Utama</th>
                        <th>Tahun</th>
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


<div class="modal fade bd-example-modal-lg" id="modal-add-risk-event" name="modal-add-risk-event" tabindex="-1" aria-labelledby="addGroupModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-lg"><?= $this->include("admin/pages/risk_event/create")?></div>
</div>

<?= $this->include("js/risk_event")?>

<style>
   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>

