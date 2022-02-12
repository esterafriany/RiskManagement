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
                
            <input type="hidden" class="form-control" id="id" name="id">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                                <li class="list-group-item">
                                    Detail Risiko Utama
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3 align-self-center mb-0" >KPI:</label>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" >Nomor Risiko:</label>
                                            <input type="text" class="form-control" id="risk_number" name="risk_number" value="<?php echo $detail_risk_event->risk_number;?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3 align-self-center mb-0" >Risiko Utama:</label>
                                        <textarea class="form-control" id="risk_event" name="risk_event"  rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3 align-self-center mb-0" >Year:</label>
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
                                </li>
                            </ul>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Penyebab Risiko
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
                <br/>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Rencana Mitigasi:
                                </li>
                                <li class="list-group-item">
                                <table id="riskEventTable" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Rencana Mitigasi</th>
                                        </tr>
                                    </thead> 
                                </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-edit-risk-event"  class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>

<?= $this->include("js/detail_risk_event")?>
