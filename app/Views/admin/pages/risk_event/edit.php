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

                                            <div class="form-group">
                                                <small><b>Nomor Risiko</b></small>
                                                <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number;?>" disabled>
                                            </div>
                                            
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
                                            <div class="col-sm-4"><small>Memadai/Tidak Memadai</small></div>
                                            <div class="col-sm-8">
                                                <select class="form-control form-select" required id="existing_control_2" name="existing_control_2">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php if($detail_risk_event->existing_control_2 == "Memadai"){?>
                                                            <option value="Memadai" selected>Memadai</option>
                                                        <?php }else{ ?>
                                                            <option value="Memadai">Memadai</option>
                                                        <?php } ?>

                                                        <?php if($detail_risk_event->existing_control_2 == "Tidak Memadai"){?>
                                                            <option value="Tidak Memadai" selected>Tidak Memadai</option>
                                                        <?php }else{ ?>
                                                            <option value="Tidak Memadai">Tidak Memadai</option>
                                                        <?php } ?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4"><small>Dijalankan/Belum Dijalankan</small></div>
                                            <div class="col-sm-8">
                                                <select class="form-control form-select" required id="existing_control_3" name="existing_control_3">
                                                    <option value="" disabled selected hidden >Pilihan</option>
                                                        <?php if($detail_risk_event->existing_control_3 == "Dijalankan"){?>
                                                            <option value="Dijalankan" selected>Dijalankan</option>
                                                        <?php }else{ ?>
                                                            <option value="Dijalankan">Dijalankan</option>
                                                        <?php } ?>

                                                        <?php if($detail_risk_event->existing_control_2 == "Belum Dijalankan"){?>
                                                            <option value="Belum Dijalankan" selected>Belum Dijalankan</option>
                                                        <?php }else{ ?>
                                                            <option value="Belum Dijalankan">Belum Dijalankan</option>
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
                <a href="<?=base_url('admin/risk-event-residual/'.$detail_risk_event->id)?>" class="btn btn-success">Update Progress</a>
  
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary">Simpan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_risk_event")?>

<style>
.selectRow {
    display : block;
    padding : 20px;
}
.select2-container {
    width: 200px;
}
/*
Version: 3.5.1 Timestamp: Tue Jul 22 18:58:56 EDT 2014
*/
.select2-container {
    margin: 0;
    position: relative;
    display: inline-block;
    /* inline-block for ie7 */
    zoom: 1;
    *display: inline;
    vertical-align: middle;
}

.select2-container,
.select2-drop,
.select2-search,
.select2-search input {
  /*
    Force border-box so that % widths fit the parent
    container without overlap because of margin/padding.
    More Info : http://www.quirksmode.org/css/box.html
  */
  -webkit-box-sizing: border-box; /* webkit */
     -moz-box-sizing: border-box; /* firefox */
          box-sizing: border-box; /* css3 */
}

.select2-container .select2-choice {
    display: block;
    height: 26px;
    padding: 0 0 0 8px;
    overflow: hidden;
    position: relative;

    border: 1px solid #aaa;
    white-space: nowrap;
    line-height: 26px;
    color: #444;
    text-decoration: none;

    border-radius: 4px;

    background-clip: padding-box;

    -webkit-touch-callout: none;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;

    background-color: #fff;
    background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eee), color-stop(0.5, #fff));
    background-image: -webkit-linear-gradient(center bottom, #eee 0%, #fff 50%);
    background-image: -moz-linear-gradient(center bottom, #eee 0%, #fff 50%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#ffffff', endColorstr = '#eeeeee', GradientType = 0);
    background-image: linear-gradient(to top, #eee 0%, #fff 50%);
}

html[dir="rtl"] .select2-container .select2-choice {
    padding: 0 8px 0 0;
}

.select2-container.select2-drop-above .select2-choice {
    border-bottom-color: #aaa;

    border-radius: 0 0 4px 4px;

    background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eee), color-stop(0.9, #fff));
    background-image: -webkit-linear-gradient(center bottom, #eee 0%, #fff 90%);
    background-image: -moz-linear-gradient(center bottom, #eee 0%, #fff 90%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#eeeeee', GradientType=0);
    background-image: linear-gradient(to bottom, #eee 0%, #fff 90%);
}

.select2-container.select2-allowclear .select2-choice .select2-chosen {
    margin-right: 42px;
}

.select2-container .select2-choice > .select2-chosen {
    margin-right: 26px;
    display: block;
    overflow: hidden;

    white-space: nowrap;

    text-overflow: ellipsis;
    float: none;
    width: auto;
}

html[dir="rtl"] .select2-container .select2-choice > .select2-chosen {
    margin-left: 26px;
    margin-right: 0;
}

.select2-container .select2-choice abbr {
    display: none;
    width: 12px;
    height: 12px;
    position: absolute;
    right: 24px;
    top: 8px;

    font-size: 1px;
    text-decoration: none;

    border: 0;
    background: url('select2.png') right top no-repeat;
    cursor: pointer;
    outline: 0;
}

.select2-container.select2-allowclear .select2-choice abbr {
    display: inline-block;
}

.select2-container .select2-choice abbr:hover {
    background-position: right -11px;
    cursor: pointer;
}

.select2-drop-mask {
    border: 0;
    margin: 0;
    padding: 0;
    position: fixed;
    left: 0;
    top: 0;
    min-height: 100%;
    min-width: 100%;
    height: auto;
    width: auto;
    opacity: 0;
    z-index: 9998;
    /* styles required for IE to work */
    background-color: #fff;
    filter: alpha(opacity=0);
}

.select2-drop {
    width: 100%;
    margin-top: -1px;
    position: absolute;
    z-index: 9999;
    top: 100%;

    background: #fff;
    color: #000;
    border: 1px solid #aaa;
    border-top: 0;

    border-radius: 0 0 4px 4px;

    -webkit-box-shadow: 0 4px 5px rgba(0, 0, 0, .15);
            box-shadow: 0 4px 5px rgba(0, 0, 0, .15);
}

.select2-drop.select2-drop-above {
    margin-top: 1px;
    border-top: 1px solid #aaa;
    border-bottom: 0;

    border-radius: 4px 4px 0 0;

    -webkit-box-shadow: 0 -4px 5px rgba(0, 0, 0, .15);
            box-shadow: 0 -4px 5px rgba(0, 0, 0, .15);
}

.select2-drop-active {
    border: 1px solid #5897fb;
    border-top: none;
}

.select2-drop.select2-drop-above.select2-drop-active {
    border-top: 1px solid #5897fb;
}

.select2-drop-auto-width {
    border-top: 1px solid #aaa;
    width: auto;
}

.select2-drop-auto-width .select2-search {
    padding-top: 4px;
}

.select2-container .select2-choice .select2-arrow {
    display: inline-block;
    width: 18px;
    height: 100%;
    position: absolute;
    right: 0;
    top: 0;

    border-left: 1px solid #aaa;
    border-radius: 0 4px 4px 0;

    background-clip: padding-box;

    background: #ccc;
    background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ccc), color-stop(0.6, #eee));
    background-image: -webkit-linear-gradient(center bottom, #ccc 0%, #eee 60%);
    background-image: -moz-linear-gradient(center bottom, #ccc 0%, #eee 60%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#eeeeee', endColorstr = '#cccccc', GradientType = 0);
    background-image: linear-gradient(to top, #ccc 0%, #eee 60%);
}

html[dir="rtl"] .select2-container .select2-choice .select2-arrow {
    left: 0;
    right: auto;

    border-left: none;
    border-right: 1px solid #aaa;
    border-radius: 4px 0 0 4px;
}

.select2-container .select2-choice .select2-arrow b {
    display: block;
    width: 100%;
    height: 100%;
    background: url('select2.png') no-repeat 0 1px;
}

html[dir="rtl"] .select2-container .select2-choice .select2-arrow b {
    background-position: 2px 1px;
}

.select2-search {
    display: inline-block;
    width: 100%;
    min-height: 26px;
    margin: 0;
    padding-left: 4px;
    padding-right: 4px;

    position: relative;
    z-index: 10000;

    white-space: nowrap;
}

.select2-search input {
    width: 100%;
    height: auto !important;
    min-height: 26px;
    padding: 4px 20px 4px 5px;
    margin: 0;

    outline: 0;
    font-family: sans-serif;
    font-size: 1em;

    border: 1px solid #aaa;
    border-radius: 0;

    -webkit-box-shadow: none;
            box-shadow: none;

    background: #fff url('select2.png') no-repeat 100% -22px;
    background: url('select2.png') no-repeat 100% -22px, -webkit-gradient(linear, left bottom, left top, color-stop(0.85, #fff), color-stop(0.99, #eee));
    background: url('select2.png') no-repeat 100% -22px, -webkit-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2.png') no-repeat 100% -22px, -moz-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2.png') no-repeat 100% -22px, linear-gradient(to bottom, #fff 85%, #eee 99%) 0 0;
}

html[dir="rtl"] .select2-search input {
    padding: 4px 5px 4px 20px;

    background: #fff url('select2.png') no-repeat -37px -22px;
    background: url('select2.png') no-repeat -37px -22px, -webkit-gradient(linear, left bottom, left top, color-stop(0.85, #fff), color-stop(0.99, #eee));
    background: url('select2.png') no-repeat -37px -22px, -webkit-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2.png') no-repeat -37px -22px, -moz-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2.png') no-repeat -37px -22px, linear-gradient(to bottom, #fff 85%, #eee 99%) 0 0;
}

.select2-drop.select2-drop-above .select2-search input {
    margin-top: 4px;
}

.select2-search input.select2-active {
    background: #fff url('select2-spinner.gif') no-repeat 100%;
    background: url('select2-spinner.gif') no-repeat 100%, -webkit-gradient(linear, left bottom, left top, color-stop(0.85, #fff), color-stop(0.99, #eee));
    background: url('select2-spinner.gif') no-repeat 100%, -webkit-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2-spinner.gif') no-repeat 100%, -moz-linear-gradient(center bottom, #fff 85%, #eee 99%);
    background: url('select2-spinner.gif') no-repeat 100%, linear-gradient(to bottom, #fff 85%, #eee 99%) 0 0;
}

.select2-container-active .select2-choice,
.select2-container-active .select2-choices {
    border: 1px solid #5897fb;
    outline: none;

    -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, .3);
            box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}

.select2-dropdown-open .select2-choice {
    border-bottom-color: transparent;
    -webkit-box-shadow: 0 1px 0 #fff inset;
            box-shadow: 0 1px 0 #fff inset;

    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;

    background-color: #eee;
    background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #fff), color-stop(0.5, #eee));
    background-image: -webkit-linear-gradient(center bottom, #fff 0%, #eee 50%);
    background-image: -moz-linear-gradient(center bottom, #fff 0%, #eee 50%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#ffffff', GradientType=0);
    background-image: linear-gradient(to top, #fff 0%, #eee 50%);
}

.select2-dropdown-open.select2-drop-above .select2-choice,
.select2-dropdown-open.select2-drop-above .select2-choices {
    border: 1px solid #5897fb;
    border-top-color: transparent;

    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(0.5, #eee));
    background-image: -webkit-linear-gradient(center top, #fff 0%, #eee 50%);
    background-image: -moz-linear-gradient(center top, #fff 0%, #eee 50%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#ffffff', GradientType=0);
    background-image: linear-gradient(to bottom, #fff 0%, #eee 50%);
}

.select2-dropdown-open .select2-choice .select2-arrow {
    background: transparent;
    border-left: none;
    filter: none;
}
html[dir="rtl"] .select2-dropdown-open .select2-choice .select2-arrow {
    border-right: none;
}

.select2-dropdown-open .select2-choice .select2-arrow b {
    background-position: -18px 1px;
}

html[dir="rtl"] .select2-dropdown-open .select2-choice .select2-arrow b {
    background-position: -16px 1px;
}

.select2-hidden-accessible {
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

/* results */
.select2-results {
    max-height: 200px;
    padding: 0 0 0 4px;
    margin: 4px 4px 4px 0;
    position: relative;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

html[dir="rtl"] .select2-results {
    padding: 0 4px 0 0;
    margin: 4px 0 4px 4px;
}

.select2-results ul.select2-result-sub {
    margin: 0;
    padding-left: 0;
}

.select2-results li {
    list-style: none;
    display: list-item;
    background-image: none;
}

.select2-results li.select2-result-with-children > .select2-result-label {
    font-weight: bold;
}

.select2-results .select2-result-label {
    padding: 3px 7px 4px;
    margin: 0;
    cursor: pointer;

    min-height: 1em;

    -webkit-touch-callout: none;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;
}

.select2-results-dept-1 .select2-result-label { padding-left: 20px }
.select2-results-dept-2 .select2-result-label { padding-left: 40px }
.select2-results-dept-3 .select2-result-label { padding-left: 60px }
.select2-results-dept-4 .select2-result-label { padding-left: 80px }
.select2-results-dept-5 .select2-result-label { padding-left: 100px }
.select2-results-dept-6 .select2-result-label { padding-left: 110px }
.select2-results-dept-7 .select2-result-label { padding-left: 120px }

.select2-results .select2-highlighted {
    background: #3875d7;
    color: #fff;
}

.select2-results li em {
    background: #feffde;
    font-style: normal;
}

.select2-results .select2-highlighted em {
    background: transparent;
}

.select2-results .select2-highlighted ul {
    background: #fff;
    color: #000;
}

.select2-results .select2-no-results,
.select2-results .select2-searching,
.select2-results .select2-ajax-error,
.select2-results .select2-selection-limit {
    background: #f4f4f4;
    display: list-item;
    padding-left: 5px;
}

/*
disabled look for disabled choices in the results dropdown
*/
.select2-results .select2-disabled.select2-highlighted {
    color: #666;
    background: #f4f4f4;
    display: list-item;
    cursor: default;
}
.select2-results .select2-disabled {
  background: #f4f4f4;
  display: list-item;
  cursor: default;
}

.select2-results .select2-selected {
    display: none;
}

.select2-more-results.select2-active {
    background: #f4f4f4 url('select2-spinner.gif') no-repeat 100%;
}

.select2-results .select2-ajax-error {
    background: rgba(255, 50, 50, .2);
}

.select2-more-results {
    background: #f4f4f4;
    display: list-item;
}

/* disabled styles */

.select2-container.select2-container-disabled .select2-choice {
    background-color: #f4f4f4;
    background-image: none;
    border: 1px solid #ddd;
    cursor: default;
}

.select2-container.select2-container-disabled .select2-choice .select2-arrow {
    background-color: #f4f4f4;
    background-image: none;
    border-left: 0;
}

.select2-container.select2-container-disabled .select2-choice abbr {
    display: none;
}


/* multiselect */

.select2-container-multi .select2-choices {
    height: auto !important;
    height: 1%;
    margin: 0;
    padding: 0 5px 0 0;
    position: relative;

    border: 1px solid #aaa;
    cursor: text;
    overflow: hidden;

    background-color: #fff;
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(1%, #eee), color-stop(15%, #fff));
    background-image: -webkit-linear-gradient(top, #eee 1%, #fff 15%);
    background-image: -moz-linear-gradient(top, #eee 1%, #fff 15%);
    background-image: linear-gradient(to bottom, #eee 1%, #fff 15%);
}

html[dir="rtl"] .select2-container-multi .select2-choices {
    padding: 0 0 0 5px;
}

.select2-locked {
  padding: 3px 5px 3px 5px !important;
}

.select2-container-multi .select2-choices {
    min-height: 26px;
}

.select2-container-multi.select2-container-active .select2-choices {
    border: 1px solid #5897fb;
    outline: none;

    -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, .3);
            box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}
.select2-container-multi .select2-choices li {
    float: left;
    list-style: none;
}
html[dir="rtl"] .select2-container-multi .select2-choices li
{
    float: right;
}
.select2-container-multi .select2-choices .select2-search-field {
    margin: 0;
    padding: 0;
    white-space: nowrap;
}

.select2-container-multi .select2-choices .select2-search-field input {
    padding: 5px;
    margin: 1px 0;

    font-family: sans-serif;
    font-size: 100%;
    color: #666;
    outline: 0;
    border: 0;
    -webkit-box-shadow: none;
            box-shadow: none;
    background: transparent !important;
}

.select2-container-multi .select2-choices .select2-search-field input.select2-active {
    background: #fff url('select2-spinner.gif') no-repeat 100% !important;
}

.select2-default {
    color: #999 !important;
}

.select2-container-multi .select2-choices .select2-search-choice {
    padding: 3px 5px 3px 18px;
    margin: 3px 0 3px 5px;
    position: relative;

    line-height: 13px;
    color: #333;
    cursor: default;
    border: 1px solid #aaaaaa;

    border-radius: 3px;

    -webkit-box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);
            box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);

    background-clip: padding-box;

    -webkit-touch-callout: none;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;

    background-color: #e4e4e4;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#f4f4f4', GradientType=0);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eee));
    background-image: -webkit-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image: -moz-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image: linear-gradient(to top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
}
html[dir="rtl"] .select2-container-multi .select2-choices .select2-search-choice
{
    margin: 3px 5px 3px 0;
    padding: 3px 18px 3px 5px;
}
.select2-container-multi .select2-choices .select2-search-choice .select2-chosen {
    cursor: default;
}
.select2-container-multi .select2-choices .select2-search-choice-focus {
    background: #d4d4d4;
}

.select2-search-choice-close {
    display: block;
    width: 12px;
    height: 13px;
    position: absolute;
    right: 3px;
    top: 4px;

    font-size: 1px;
    outline: none;
    background: url('select2.png') right top no-repeat;
}
html[dir="rtl"] .select2-search-choice-close {
    right: auto;
    left: 3px;
}

.select2-container-multi .select2-search-choice-close {
    left: 3px;
}

html[dir="rtl"] .select2-container-multi .select2-search-choice-close {
    left: auto;
    right: 2px;
}

.select2-container-multi .select2-choices .select2-search-choice .select2-search-choice-close:hover {
  background-position: right -11px;
}
.select2-container-multi .select2-choices .select2-search-choice-focus .select2-search-choice-close {
    background-position: right -11px;
}

/* disabled styles */
.select2-container-multi.select2-container-disabled .select2-choices {
    background-color: #f4f4f4;
    background-image: none;
    border: 1px solid #ddd;
    cursor: default;
}

.select2-container-multi.select2-container-disabled .select2-choices .select2-search-choice {
    padding: 3px 5px 3px 5px;
    border: 1px solid #ddd;
    background-image: none;
    background-color: #f4f4f4;
}

.select2-container-multi.select2-container-disabled .select2-choices .select2-search-choice .select2-search-choice-close {    display: none;
    background: none;
}
/* end multiselect */


.select2-result-selectable .select2-match,
.select2-result-unselectable .select2-match {
    text-decoration: underline;
}

.select2-offscreen, .select2-offscreen:focus {
    clip: rect(0 0 0 0) !important;
    width: 1px !important;
    height: 1px !important;
    border: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    position: absolute !important;
    outline: 0 !important;
    left: 0px !important;
    top: 0px !important;
}

.select2-display-none {
    display: none;
}

.select2-measure-scrollbar {
    position: absolute;
    top: -10000px;
    left: -10000px;
    width: 100px;
    height: 100px;
    overflow: scroll;
}

/* Retina-ize icons */

@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min-resolution: 2dppx)  {
    .select2-search input,
    .select2-search-choice-close,
    .select2-container .select2-choice abbr,
    .select2-container .select2-choice .select2-arrow b {
        background-image: url('select2x2.png') !important;
        background-repeat: no-repeat !important;
        background-size: 60px 40px !important;
    }

    .select2-search input {
        background-position: 100% -21px !important;
    }
}
</style>