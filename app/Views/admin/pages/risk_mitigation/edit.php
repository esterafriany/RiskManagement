<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Detail Risiko</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
            <input type="hidden" class="form-control" id="id_risk_event" name="id_risk_event" value="<?php echo $detail_risk_event->id;?>">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                                <li class="list-group-item">
                                    Detail Risiko Utama
                                </li>
                                <li class="list-group-item">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
											<div class="form-group">
                                                <small>Nomor Risiko</small>
                                                <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <small>KPI</small>
                                                <select class="form-control form-select" id="id_kpi" name="id_kpi">
                                                    <option value="" selected hidden >Pilihan</option>
                                                    <?php
                                                        if($kpi_list){
                                                            foreach($kpi_list as $kpi){
                                                                if($detail_risk_event->id_kpi == $kpi['id']){ 
                                                                ?>
                                                                    <option value="<?php echo $kpi['id'];?>" selected><?php echo $kpi['name'];?></option>
                                                                <?php
                                                                }else{?>
                                                                    <option value="<?php echo $kpi['id'];?>"><?php echo $kpi['name'];?></option>
                                                                
                                                                <?php
                                                                }
                                                            }	
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <small>Risiko Utama</small>
                                                <textarea class="form-control" required id="risk_event" name="risk_event"  rows="2"><?php echo $detail_risk_event->risk_event;?></textarea>
                                            </div>

                                            
                                        </div>

                                    <!-- Coloumn -->
                                    <div class="col-md-6">
                                        
                                        
                                    </div>
                                </div>
                                </li>
                            </ul>
                    </div>
                    
                </div>
                <br/>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Penyebab Risiko:
                                </li>
                                <li class="list-group-item">
                                    <div id="riskCauseList">
                    
                                    </div><br/>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-cause"><i class="fas fa-plus-circle"></i> Tambah Risiko</button>
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Rencana Mitigasi:
                                </li>
                                <li class="list-group-item">
                                    <div id="riskMitigationList" name="riskMitigationList">
                                    
                                    </div><br/>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-mitigation"><i class="fas fa-plus-circle"></i> Tambah Mitigasi</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <a href="<?=base_url('admin/risk-event')?>" type="button" class="btn btn-secondary">Batal</a>
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary">Simpan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_risk_monitoring")?>
