<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Detail Risiko</h4>
               </div>
			</div>
            <?php 
                $this->session = \Config\Services::session();
                $this->session->start(); 
            ?>
            <div class="card-body">
            <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
            <input type="hidden" class="form-control" id="id_risk_event" name="id_risk_event" value="<?php echo $detail_risk_event->id;?>">
            <input type="hidden" id="id_division" name="id_division" value="<?=$this->session->get("id_division")?>">
            
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
                                                <input type="text" class="form-control" id="risk_number" name="risk_number" value="R<?php echo $detail_risk_event->risk_number_manual;?>" disabled>
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
            <!-- <div class="card-footer">
                <a href="<?=base_url('risk_owner/get-risk-mitigations')?>" type="button" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</a>
                <button type="button" id="btn-edit-risk-detail"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
            </div> -->
            
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/risk_owner/detail_risk_monitoring")?>
