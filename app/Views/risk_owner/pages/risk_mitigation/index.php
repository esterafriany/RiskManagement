<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Mitigasi Risiko</h4>
               </div>
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
			   </div>
            <div class="card-body">
				<div class="table-responsive">
               <table id="riskMitigationTable" class="table table-striped" width="100%">
                  <thead>
                     <tr>
                        <th>KPI</th>
                        <th>Nomor Risiko</th>
                        <th>Risiko Utama</th>
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

<?= $this->include("js/risk_owner/risk_mitigation")?>

<style>
   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>
