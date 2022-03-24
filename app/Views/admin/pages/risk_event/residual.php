<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Update Risk Progress</h4>
               </div>
            </div>
            <div class="card-body">
            <form id="form-add-risk-residual" action="" class="form-horizontal" method="POST">
               <input type="hidden" class="form-control" id="id_risk_event" name="id_risk_event" value="<?php echo $id_risk_event;?>">
        
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <small>Tingkat Kemungkinan Residual</small>
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
                        <small>Tingkat Dampak Residual</small>
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
                        <small>Level Residual</small>
                        <input type="text" required class="form-control" id="final_level_residual" name="final_level_residual" value="<?php echo $detail_risk_event->final_level_residual;?>">
                     </div>

                     <div class="form-group row">
                        <small>Analisis Risiko Residual</small>
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
                        <small>Dampak Risiko Kuantitatif</small>
                         <textarea class="form-control" name="r" id="r" rows="3"><?=$detail_risk_event->risk_impact_quantitative?></textarea>
                                

                     </div>

                     <div class="form-group">
                        <small>Keterangan</small>
                        <textarea class="form-control" name="description" id="description" rows="2"><?=$detail_risk_event->description?></textarea>
                     
                     </div>
                     
                  </div>
               </div>
            
            </div>
            <div class="card-footer">
                <a href="<?=base_url('admin/detail-risk-event/'.$id_risk_event)?>" type="button" class="btn btn-success">Kembali</a>
  
                <button type="button" id="btn-edit-risk-residual"  class="btn btn-primary">Simpan</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script>
   //CKEDITOR.replace('risk_impact_quantitative');
</script>

<?= $this->include("js/risk_residual")?>



