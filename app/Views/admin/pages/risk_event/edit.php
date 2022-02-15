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
                                                <small>Kategori Risiko</small>
                                                <input type="text" class="form-control" id="objective" name="objective" value="<?php echo $detail_risk_event->objective;?>">
                                            </div>
                                            <div class="form-group">
                                                <small>KPI</small>
                                                <select class="form-control form-select" name="id_kpi" disabled>
                                                    <option value="" disabled selected hidden >Pilihan</option>
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
                                                <small>Nomor Risiko</small>
                                                <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number;?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <small>Risiko Utama</small>
                                                <textarea class="form-control" id="risk_event" name="risk_event"  rows="2"><?php echo $detail_risk_event->risk_event;?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <small>Tahun</small>
                                                <select class="form-control form-select" name="year">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                    <?php
                                                        for($i=2020;$i<2023;$i++){ 
                                                            if($detail_risk_event->year == $kpi['year']){ ?>
                                                                <option value="<?=$i?>"selected><?php echo $i;?></option>
                                                            <?php 
                                                            }else{?>
                                                                <option value="<?=$i?>"><?php echo $i;?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <small>Kategori Risiko</small>
                                                <div id="riskCategoryList">
                                                        
                                                </div><br/>
                                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-risk_category"><i class="fas fa-plus-circle"></i> Tambah Kategori</button>
                                                
                                            </div>
                                            
                                        </div>

                                    <!-- Coloumn -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <small>Existing Control 1</small>
                                            <div class="col-sm-12">
                                            <select class="form-control form-select" name="existing_control_1">
                                                <option value="" disabled selected hidden >Pilihan</option>
                                                <option value="Ada">Ada</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <small>Existing Control 2</small>
                                            <div class="col-sm-12">
                                            <select class="form-control form-select" name="existing_control_2">
                                                <option value="" disabled selected hidden >Pilihan</option>
                                                <option value="Memadai">Memadai</option>
                                                <option value="Tidak Memadai">Tidak Memadai</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <small>Existing Control 3</small>
                                            <div class="col-sm-12">
                                            <select class="form-control form-select" name="existing_control_3">
                                                <option value="" disabled selected hidden >Pilihan</option>
                                                <option value="Dijalankan">Dijalankan</option>
                                                <option value="Belum Dijalankan">Belum Dijalankan</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <small>Tingkat Kemungkinan</small>
                                            <div class="col-sm-12">
                                                <select class="form-control form-select" name="probability_level">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="2">3</option>
                                                    <option value="2">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <small>Tingkat Dampak</small>
                                            <div class="col-sm-12">
                                                <select class="form-control form-select" name="impact_level">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="2">3</option>
                                                    <option value="2">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <small>Level</small>
                                            <input type="text" class="form-control" id="final_level" name="final_level" value="<?php echo $detail_risk_event->risk_number;?>">
                                        </div>
                                        <div class="form-group row">
                                            <small>Analisis Risiko</small>
                                            <div class="col-sm-12">
                                                <select class="form-control form-select" name="impact_level">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="2">3</option>
                                                    <option value="2">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
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
                                    Rencana Mitigasi:
                                </li>
                                <li class="list-group-item">
                                    <div id="riskMitigationList">
                    
                                    </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-mitigation"><i class="fas fa-plus-circle"></i> Tambah Mitigasi</button>
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
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary">Batal</button>
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_risk_event")?>
