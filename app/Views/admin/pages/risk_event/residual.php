<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Risk Residual</h4>
               </div>
              
            </div>
            <div class="card-body">

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group row">
                     <small>Tingkat Kemungkinan Residual</small>
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

                  <div class="form-group row">
                     <small>Tingkat Dampak Residual</small>
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

                  <div class="form-group">
                     <small>Level</small>
                     <input type="text" required class="form-control" id="final_level" name="final_level" value="<?php echo $detail_risk_event->final_level;?>">
                  </div>

                  
               </div>
            </div>

         </div>
            

         </div>
      </div>
   </div>
</div>

<?= $this->include("js/risk_event")?>



