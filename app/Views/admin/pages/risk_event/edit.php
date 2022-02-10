<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Detail Risiko</h4>
               </div>
			</div><hr/>
            <div class="card-body">
				<div class="table-responsive">
                <form id="form-edit-risk-event" action="" class="form-horizontal" method="POST">
                    <input type="hidden" class="form-control" id="id" name="id">
                        <table width="100%">
                            <tr>
                                <td width="20%">KPI:</td>
                                <td>
                                    <select class="form-control form-select" name="id_kpi">
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
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">No Risiko:</td>
                                <td>
                                    <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number;?>">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Risiko Utama:</td>
                                <td>
                                    <textarea class="form-control" id="risk_event" name="risk_event"  rows="2">
                                        <?php echo $detail_risk_event->risk_event;?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Year:</td>
                                <td>
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
                                </td>
                            </tr>
                          
                        </table>
                        
                </form>
               </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
   </div>
</div>

