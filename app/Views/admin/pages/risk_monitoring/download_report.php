<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Risiko dan Mitigasi</h4>
               </div>
               
               <div class="d-flex align-items-center flex-wrap">
                  <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><rect width="416" height="384" x="48" y="80" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" rx="48"/><circle cx="296" cy="232" r="24" fill="currentColor"/><circle cx="376" cy="232" r="24" fill="currentColor"/><circle cx="296" cy="312" r="24" fill="currentColor"/><circle cx="376" cy="312" r="24" fill="currentColor"/><circle cx="136" cy="312" r="24" fill="currentColor"/><circle cx="216" cy="312" r="24" fill="currentColor"/><circle cx="136" cy="392" r="24" fill="currentColor"/><circle cx="216" cy="392" r="24" fill="currentColor"/><circle cx="296" cy="392" r="24" fill="currentColor"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M128 48v32m256-32v32"/><path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" d="M464 160H48"/></svg>
                     &nbsp;
                  <div class="dropdown">
                     <select class="form-control form-select" id="year_selected" name="year_selected" onchange="update_risk_table()">
                        <option value="2021">2021</option>
                        <option value="2022" selected>2022</option>
                     </select>
                  </div>
                  &nbsp;&nbsp;
                  <a class="btn btn-primary" href="download-risk-monitoring/2022"> <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M336 176h40a40 40 0 0 1 40 40v208a40 40 0 0 1-40 40H136a40 40 0 0 1-40-40V216a40 40 0 0 1 40-40h40"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="m176 272l80 80l80-80M256 48v288"/></svg> Download Report </a>    
               </div>
               
			   </div>
            <div class="card-body">
				<div class="table-responsive">
               <table id="riskMonitoringTable" class="table" width="100%">
                  <thead>
                     <tr>
                        <th>Risiko Utama</th>
                        <th>Mitigasi</th> 
                        <th>Detail Mitigasi</th>
                        <th>PIC</th>
                        <th>Progress (%)</th>
                     </tr>
                  </thead> 
               </table>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->include("js/risk_monitoring")?>

<style>
   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>

