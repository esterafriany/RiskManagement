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
                                                <small><b>Nomor Risiko</b></small>
                                                <input type="text" class="form-control" id="risk_number" name="id_risk" value="R<?php echo $detail_risk_event->id;?>" disabled>
                                            </div>

                                            <div class="form-group">
                                                <small><b>Sasaran</b></small>
                                                <input type="text" required class="form-control" id="objective" name="objective" value="<?php echo $detail_risk_event->objective;?>">
                                            </div>
                                            <div class="form-group">
                                                <small><b>KPI</b></small>
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

                                            <!-- <div class="form-group">
                                                <small><b>Perankingan Risiko Progress</b></small>
                                                <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number_residual;?>" disabled>
                                            </div> -->
                                            
                                            <div class="form-group">
                                                <small><b>Risiko Utama</b></small>
                                                <textarea class="form-control" required id="risk_event" name="risk_event"  rows="2"><?php echo $detail_risk_event->risk_event;?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <small><b>Tahun</b></small>
                                                <select class="form-control form-select" required id="year" name="year">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                    <?php
                                                        for($i=2020;$i<2023;$i++){ 
                                                            if($detail_risk_event->year == $i){ ?>
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
                                                <small><b>Kategori Risiko</b></small>
                                                <div id="riskCategoryList">
                                                
                                                </div><br/>
                                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-risk_category"><i class="fas fa-plus-circle"></i> Tambah Kategori</button>
                                                
                                            </div>
                                        </div>

                                    <!-- Coloumn -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <small><b>Existing Control/Pengendalian Yang Ada</b></small>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4"><small>Ada/Tidak Ada</small></div>
                                            <div class="col-sm-8">
                                                <select class="form-control form-select" required id="existing_control_1" name="existing_control_1">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php if($detail_risk_event->existing_control_1 == "Ada"){?>
                                                            <option value="Ada" selected>Ada</option>
                                                        <?php }else{ ?>
                                                            <option value="Ada">Ada</option>
                                                        <?php } ?>

                                                        <?php if($detail_risk_event->existing_control_1 == "Tidak Ada"){?>
                                                            <option value="Tidak Ada" selected>Tidak Ada</option>
                                                        <?php }else{ ?>
                                                            <option value="Tidak Ada">Tidak Ada</option>
                                                        <?php } ?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4"><small>Memadai/Belum Memadai</small></div>
                                            <div class="col-sm-8">
                                                <select class="form-control form-select" required id="existing_control_2" name="existing_control_2">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php if($detail_risk_event->existing_control_2 == "Memadai"){?>
                                                            <option value="Memadai" selected>Memadai</option>
                                                        <?php }else{ ?>
                                                            <option value="Memadai">Memadai</option>
                                                        <?php } ?>

                                                        <?php if($detail_risk_event->existing_control_2 == "Belum Memadai"){?>
                                                            <option value="Belum Memadai" selected>Belum Memadai</option>
                                                        <?php }else{ ?>
                                                            <option value="Belum Memadai">Belum Memadai</option>
                                                        <?php } ?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4"><small>Dijalankan/Belum Dijalankan 100%</small></div>
                                            <div class="col-sm-8">
                                                <select class="form-control form-select" required id="existing_control_3" name="existing_control_3">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php if($detail_risk_event->existing_control_3 == "Dijalankan 100%"){?>
                                                            <option value="Dijalankan 100%" selected>Dijalankan 100%</option>
                                                        <?php }else{ ?>
                                                            <option value="Dijalankan 100%">Dijalankan 100%</option>
                                                        <?php } ?>

                                                        <?php if($detail_risk_event->existing_control_3 == "Belum Dijalankan 100%"){?>
                                                            <option value="Belum Dijalankan 100%" selected>Belum Dijalankan 100%</option>
                                                        <?php }else{ ?>
                                                            <option value="Belum Dijalankan 100%">Belum Dijalankan 100%</option>
                                                        <?php } ?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <small><b>Analisis Risiko Inheren (Inherent Risk)</b></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <small>Tingkat Kemungkinan</small>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-select" required name="probability_level" id="probability_level" onChange="change_level1()">
                                                        <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php
                                                            for($i=1;$i<6;$i++){ 
                                                                if($detail_risk_event->probability_level == $i){ ?>
                                                                    <option value="<?=$i?>"selected><?php echo $i;?></option>
                                                                <?php 
                                                                }else{?>
                                                                    <option value="<?=$i?>"><?php echo $i;?></option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Tingkat Dampak</small>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-select" required name="impact_level" id="impact_level" onChange="change_level()">
                                                        <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php
                                                            for($i=1;$i<6;$i++){ 
                                                                if($detail_risk_event->impact_level == $i){ ?>
                                                                    <option value="<?=$i?>"selected><?php echo $i;?></option>
                                                                <?php 
                                                                }else{?>
                                                                    <option value="<?=$i?>"><?php echo $i;?></option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <small>Level</small>
                                                <input type="text" required class="form-control" id="final_level" name="final_level" value="<?php echo $detail_risk_event->final_level;?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Analisis Risiko</small>
                                                <select class="form-control form-select" required id="risk_analysis" name="risk_analysis">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                
                                                    <?php if($detail_risk_event->risk_analysis == "R"){?>
                                                        <option value="R" selected>Rendah</option>
                                                    <?php }else{ ?>
                                                        <option value="R">Rendah</option>
                                                    <?php } ?>

                                                    <?php if($detail_risk_event->risk_analysis == "M"){?>
                                                        <option value="M" selected>Menengah</option>
                                                    <?php }else{ ?>
                                                        <option value="M">Menengah</option>
                                                    <?php } ?>

                                                    <?php if($detail_risk_event->risk_analysis == "T"){?>
                                                        <option value="T" selected>Tinggi</option>
                                                    <?php }else{ ?>
                                                        <option value="T">Tinggi</option>
                                                    <?php } ?>
                                                    
                                                    <?php if($detail_risk_event->risk_analysis == "E"){?>
                                                        <option value="E" selected>Ekstrem</option>
                                                    <?php }else{ ?>
                                                        <option value="E">Ekstrem</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <small><b>Analisis Risiko Residual (Residual Risk)</b></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <small>Tingkat Kemungkinan</small>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-select" required name="target_probability_level" id="target_probability_level" onChange="change_level_target1()">
                                                        <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php
                                                            for($i=1;$i<6;$i++){ 
                                                                if($detail_risk_event->target_probability_level == $i){ ?>
                                                                    <option value="<?=$i?>"selected><?php echo $i;?></option>
                                                                <?php 
                                                                }else{?>
                                                                    <option value="<?=$i?>"><?php echo $i;?></option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Tingkat Dampak</small>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-select" required name="target_impact_level" id="target_impact_level" onChange="change_level_target()">
                                                        <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php
                                                            for($i=1;$i<6;$i++){ 
                                                                if($detail_risk_event->target_impact_level == $i){ ?>
                                                                    <option value="<?=$i?>"selected><?php echo $i;?></option>
                                                                <?php 
                                                                }else{?>
                                                                    <option value="<?=$i?>"><?php echo $i;?></option>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <small>Level Target</small>
                                                <div class="col-sm-12">
                                                    <input type="text" required class="form-control" id="target_final_level" name="target_final_level" value="<?php echo $detail_risk_event->target_final_level;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Analisis Risiko</small>
                                                <select class="form-control form-select" required id="target_risk_analysis" name="target_risk_analysis">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                
                                                    <?php if($detail_risk_event->target_risk_analysis == "R"){?>
                                                        <option value="R" selected>Rendah</option>
                                                    <?php }else{ ?>
                                                        <option value="R">Rendah</option>
                                                    <?php } ?>

                                                    <?php if($detail_risk_event->target_risk_analysis == "M"){?>
                                                        <option value="M" selected>Menengah</option>
                                                    <?php }else{ ?>
                                                        <option value="M">Menengah</option>
                                                    <?php } ?>

                                                    <?php if($detail_risk_event->target_risk_analysis == "T"){?>
                                                        <option value="T" selected>Tinggi</option>
                                                    <?php }else{ ?>
                                                        <option value="T">Tinggi</option>
                                                    <?php } ?>
                                                    
                                                    <?php if($detail_risk_event->target_risk_analysis == "E"){?>
                                                        <option value="E" selected>Ekstrem</option>
                                                    <?php }else{ ?>
                                                        <option value="E">Ekstrem</option>
                                                    <?php } ?>
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
                

           


                <a href="<?=base_url('admin/risk-event')?>" type="button" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</a>
                <a href="<?=base_url('admin/risk-event-residual/'.$detail_risk_event->id)?>" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M384 224v184a40 40 0 0 1-40 40H104a40 40 0 0 1-40-40V168a40 40 0 0 1 40-40h167.48"/><path fill="currentColor" d="M459.94 53.25a16.06 16.06 0 0 0-23.22-.56L424.35 65a8 8 0 0 0 0 11.31l11.34 11.32a8 8 0 0 0 11.34 0l12.06-12c6.1-6.09 6.67-16.01.85-22.38ZM399.34 90L218.82 270.2a9 9 0 0 0-2.31 3.93L208.16 299a3.91 3.91 0 0 0 4.86 4.86l24.85-8.35a9 9 0 0 0 3.93-2.31L422 112.66a9 9 0 0 0 0-12.66l-9.95-10a9 9 0 0 0-12.71 0Z"/></svg> Update Progress</a>
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_risk_event")?>