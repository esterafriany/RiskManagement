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
                                <small>Output</small>
                                <div id="outputList">
                                                
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-output"><i class="fas fa-plus-circle"></i> Tambah Output</button>
                                
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <table width="100%">
                                    <tr>
                                        <td width="100px"><small>Target </small></td>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="t1" value="1"> Januari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="t2" value="2"> Februari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="t3" value="3"> Maret</Marquee>
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t4" value="4"> April
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t5" value="5"> Mei
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t6" value="6"> Juni
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t7" value="7"> Juli
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t8" value="8"> Agustus
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t9" value="9"> September
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t10" value="10"> Oktober
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t11" value="11"> November
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="t12" value="12"> Desember
                                        <td/>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group">
                            <table width="100%">
                                    <tr>
                                        <td width="100px"><small>Monitoring </small></td>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="m1" value="1"> Januari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="m2" value="2"> Februari
                                        <td/>
                                        <td>
                                        <input type="checkbox" id="vehicle1" name="m3" value="3"> Maret</Marquee>
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m4" value="4"> April
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m5" value="5"> Mei
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m6" value="6"> Juni
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m7" value="7"> Juli
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m8" value="8"> Agustus
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m9" value="9"> September
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m10" value="10"> Oktober
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m11" value="11"> November
                                        <td/><td>
                                        <input type="checkbox" id="vehicle1" name="m12" value="12"> Desember
                                        <td/>
                                    </tr>
                                </table>
                            
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



<?= $this->include("js/detail_mitigation_monitoring")?>