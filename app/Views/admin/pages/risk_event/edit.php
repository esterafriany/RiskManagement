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
                                                ?>
                                                    <option value="<?=$kpi['id']?>"><?=$kpi['name']?></option>
                                                <?php
                                            }	
                                        }
                                    ?>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">No Risiko:</td>
                                <td>
                                    <input type="text" class="form-control" id="risk_number" name="risk_number">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Risiko Utama:</td>
                                <td>
                                    <textarea class="form-control" id="risk_event" name="risk_event"  rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Year:</td>
                                <td>
                                <select class="form-control form-select" name="year">
                                    <option value="" disabled selected hidden >Pilihan</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Status:</td>
                                <td>
                                <select class="form-control form-select" name="is_active">
                                    <option value="" disabled selected hidden >Pilihan</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
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

