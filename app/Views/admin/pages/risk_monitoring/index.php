<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Risk Monitoring</h4>
               </div>
               <div class="d-flex align-items-center flex-wrap">
                  <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><rect width="416" height="384" x="48" y="80" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" rx="48"/><circle cx="296" cy="232" r="24" fill="currentColor"/><circle cx="376" cy="232" r="24" fill="currentColor"/><circle cx="296" cy="312" r="24" fill="currentColor"/><circle cx="376" cy="312" r="24" fill="currentColor"/><circle cx="136" cy="312" r="24" fill="currentColor"/><circle cx="216" cy="312" r="24" fill="currentColor"/><circle cx="136" cy="392" r="24" fill="currentColor"/><circle cx="216" cy="392" r="24" fill="currentColor"/><circle cx="296" cy="392" r="24" fill="currentColor"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M128 48v32m256-32v32"/><path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" d="M464 160H48"/></svg>
                     &nbsp;
                  <div class="dropdown">
                     <select class="form-control form-select" id="year_selected" name="year_selected" onchange="update_risk_table()">
                     <?php
                        $current_year = (int)date('Y');
                        for($i=2021;$i<=$current_year;$i++){ 
                           if($i == $current_year){ ?>
                              <option value="<?=$i?>" selected><?=$i?></option>
                           <?php }else{ ?>
                              <option value="<?=$i?>"><?=$i?></option>
                           <?php }?>
                        <?php } ?> 
                     </select>
                  </div>
                  <input type="hidden" name="id_risk_event" id="id_risk_event" value="">
                  <input type="hidden" name="id_risk_mitigation" id="id_risk_mitigation" value="">
                  &nbsp;&nbsp;
                 
                  <div class="dropdown">
                     <a href="#" class="dropdown-toggle btn btn-primary" id="dropdownMenuButton22" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M336 176h40a40 40 0 0 1 40 40v208a40 40 0 0 1-40 40H136a40 40 0 0 1-40-40V216a40 40 0 0 1 40-40h40"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="m176 272l80 80l80-80M256 48v288"/></svg> Download Report
                     </a>

                     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton22">
                        <li><a class="dropdown-item" href="download-risk-monitoring/2022"> <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M80 44v424a12 12 0 0 0 12 12h328a12 12 0 0 0 12-12V44a12 12 0 0 0-12-12H92a12 12 0 0 0-12 12Zm192 260H160v-32h112Zm80-80H160v-32h192Zm0-80H160v-32h192Z"/></svg> Risk Monitoring Breakdown</a></li>
                        <li><a class="dropdown-item" href="download-risk-monitoring-gabungan/2022"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M80 44v424a12 12 0 0 0 12 12h328a12 12 0 0 0 12-12V44a12 12 0 0 0-12-12H92a12 12 0 0 0-12 12Zm192 260H160v-32h112Zm80-80H160v-32h192Zm0-80H160v-32h192Z"/></svg> Risk Monitoring Gabungan</a></li>
                     </ul>
                  </div>
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

