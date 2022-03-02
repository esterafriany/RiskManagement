<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Monitoring Mitigasi Risiko</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" enctype="multipart/form-data" action="<?php echo base_url('admin/RiskMonitoringController/onAddDetailMonitoring')?>" class="form-horizontal" method="POST">
                <input type="hidden" value="<?=$id_detail_mitigation;?>" name="id_detail_mitigation">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Rencana Mitigasi</small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <small>Detail Mitigasi</small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation_detail;?></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="form-group">
                                <small>Evidence </small>
                                <div id="evidenceList">
                                     
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-evidence"><i class="fas fa-plus-circle"></i> Tambah File</button>
                                
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <small>Output</small>
                                <div id="outputList">
                                                
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-output"><i class="fas fa-plus-circle"></i> Tambah Output</button>
                                
                            </div>
                        </li>
                        <li class="list-group-item">
                        <div class="progress">
                            <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100"><text id="text-percentage">0%</text></div>
                        </div><br/>
                            <div class="form-group">
                                <table width="100%">
                                    <tr>
                                        <td width="100px"><small>Target </small></td>
                                        <td>
                                        <input type="checkbox" id="t01" name="target[]" onclick="calculate_progress_by_target('t01')" value="1"> Januari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="t02" name="target[]" onclick="calculate_progress_by_target('t02')" value="2"> Februari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="t03" name="target[]" onclick="calculate_progress_by_target('t03')" value="3"> Maret</Marquee>
                                        <td/><td>
                                        <input type="checkbox" id="t04" name="target[]" onclick="calculate_progress_by_target('t04')" value="4"> April
                                        <td/><td>
                                        <input type="checkbox" id="t05" name="target[]" onclick="calculate_progress_by_target('t05')" value="5"> Mei
                                        <td/><td>
                                        <input type="checkbox" id="t06" name="target[]" onclick="calculate_progress_by_target('t06')" value="6"> Juni
                                        <td/><td>
                                        <input type="checkbox" id="t07" name="target[]" onclick="calculate_progress_by_target('t07')" value="7"> Juli
                                        <td/><td>
                                        <input type="checkbox" id="t08" name="target[]" onclick="calculate_progress_by_target('t08')" value="8"> Agustus
                                        <td/><td>
                                        <input type="checkbox" id="t09" name="target[]" onclick="calculate_progress_by_target('t09')" value="9"> September
                                        <td/><td>
                                        <input type="checkbox" id="t10" name="target[]" onclick="calculate_progress_by_target('t10')" value="10"> Oktober
                                        <td/><td>
                                        <input type="checkbox" id="t11" name="target[]" onclick="calculate_progress_by_target('t11')" value="11"> November
                                        <td/><td>
                                        <input type="checkbox" id="t12" name="target[]" onclick="calculate_progress_by_target('t12')" value="12"> Desember
                                        <td/>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group">
                            <table width="100%">
                                    <tr>
                                        <td width="100px"><small>Monitoring </small></td>
                                        <td>
                                        <input type="checkbox" id="m01" name="monitoring" onclick="calculate_progress_by_monitoring('m01')"  value="1"> Januari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="m02" name="monitoring" onclick="calculate_progress_by_monitoring('m02')" value="2"> Februari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="m03" name="monitoring" onclick="calculate_progress_by_monitoring('m03')" value="3"> Maret
                                        <td/><td>
                                        <input type="checkbox" id="m04" name="monitoring" onclick="calculate_progress_by_monitoring('m04')" value="4"> April
                                        <td/><td>
                                        <input type="checkbox" id="m05" name="monitoring" onclick="calculate_progress_by_monitoring('m05')" value="5"> Mei
                                        <td/><td>
                                        <input type="checkbox" id="m06" name="monitoring" onclick="calculate_progress_by_monitoring('m06')" value="6"> Juni
                                        <td/><td>
                                        <input type="checkbox" id="m07" name="monitoring" onclick="calculate_progress_by_monitoring('m07')" value="7"> Juli
                                        <td/><td>
                                        <input type="checkbox" id="m08" name="monitoring" onclick="calculate_progress_by_monitoring('m08')" value="8"> Agustus
                                        <td/><td>
                                        <input type="checkbox" id="m09" name="monitoring" onclick="calculate_progress_by_monitoring('m09')" value="9"> September
                                        <td/><td>
                                        <input type="checkbox" id="m10" name="monitoring" onclick="calculate_progress_by_monitoring('m10')" value="10"> Oktober
                                        <td/><td>
                                        <input type="checkbox" id="m11" name="monitoring" onclick="calculate_progress_by_monitoring('m11')" value="11"> November
                                        <td/><td>
                                        <input type="checkbox" id="m12" name="monitoring" onclick="calculate_progress_by_monitoring('m12')" value="12"> Desember
                                        <td/>
                                    </tr>
                                </table>
                            </div>
                        </li>
                    </ul>
                    </div>
                    
                </div>
                <br/>
                
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="submit" id="btn-add-detail-monitoring"  class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>





<?php if($state_message){

if($state_message == 'error'){ ?>
<script>
    $(document).ready(function() {
      swal("Test","Tessss","error");
    });
</script>
<?php }else if($state_message == 'success'){ ?>
<script>
    $(document).ready(function() {
      swal("Test","Tessss","success");
    });
</script>
<?php } 
}?>


<?= $this->include("js/detail_mitigation_monitoring")?>

