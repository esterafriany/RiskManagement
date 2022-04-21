<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Update Progress Risiko</h4>
               </div>
            </div>
            <div class="card-body">
            <form id="form-add-risk-residual" action="" class="form-horizontal" method="POST">
               <input type="hidden" class="form-control" id="id_risk_event" name="id_risk_event" value="<?php echo $id_risk_event;?>">
               <input type="hidden" class="form-control" id="year" name="year" value="<?php echo $detail_risk_event->year;?>">
        
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <small><b>Tingkat Kemungkinan Residual</b></small>
                        <div class="col-sm-12">
                           <select class="form-control form-select" required name="probability_level_residual" id="probability_level_residual" onChange="change_level()">
                                 <option value="" disabled selected hidden >Pilihan</option>
                                 <?php
                                    for($i=1;$i<6;$i++){ 
                                       if($detail_risk_event->probability_level_residual == $i){ ?>
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

                     <div class="form-group row">
                        <small><b>Tingkat Dampak Residual</b></small>
                        <div class="col-sm-12">
                           <select class="form-control form-select" required name="impact_level_residual" id="impact_level_residual" onChange="change_level1()">
                                 <option value="" disabled selected hidden >Pilihan</option>
                                 <?php
                                    for($i=1;$i<6;$i++){ 
                                       if($detail_risk_event->impact_level_residual == $i){ ?>
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

                     <div class="form-group">
                        <small><b>Level Residual</b></small>
                        <input type="text" required class="form-control" id="final_level_residual" name="final_level_residual" value="<?php echo $detail_risk_event->final_level_residual;?>">
                     </div>

                     <div class="form-group row">
                        <small><b>Analisis Risiko Residual</b></small>
                        <div class="col-sm-12">
                           <select class="form-control form-select" required id="risk_analysis_residual" name="risk_analysis_residual">
                                 <option value="" disabled selected hidden >Pilihan</option>

                                 <?php if($detail_risk_event->risk_analysis_residual == "R"){?>
                                    <option value="R" selected>Rendah</option>
                                 <?php }else{ ?>
                                    <option value="R">Rendah</option>
                                 <?php } ?>

                                 <?php if($detail_risk_event->risk_analysis_residual == "M"){?>
                                    <option value="M" selected>Menengah</option>
                                 <?php }else{ ?>
                                    <option value="M">Menengah</option>
                                 <?php } ?>

                                 <?php if($detail_risk_event->risk_analysis_residual == "T"){?>
                                    <option value="T" selected>Tinggi</option>
                                 <?php }else{ ?>
                                    <option value="T">Tinggi</option>
                                 <?php } ?>
                                 
                                 <?php if($detail_risk_event->risk_analysis_residual == "E"){?>
                                    <option value="E" selected>Ekstrem</option>
                                 <?php }else{ ?>
                                    <option value="E">Ekstrem</option>
                                 <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group">
                        <small><b>Dampak Risiko Kuantitatif</b></small>
                         <textarea class="form-control" name="r" id="r" rows="3"><?=$detail_risk_event->risk_impact_quantitative?></textarea>
                                

                     </div>

                     <div class="form-group">
                        <small><b>Keterangan</b></small>
                        <textarea class="form-control" name="description" id="description" rows="2"><?=$detail_risk_event->description?></textarea>
                     </div>
                     
                  </div>
               </div>
            
            </div>
            <div class="card-footer">
                <a href="<?=base_url('admin/detail-risk-event/'.$id_risk_event)?>" type="button" class="btn btn-secondary"> <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</a>
                <button type="button" id="btn-edit-risk-residual"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<?= $this->include("js/risk_residual")?>



