<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Monitoring Mitigasi Risiko</h4>
               </div>
			</div>
            <div class="card-body">
            <form id="form-edit-risk-event" enctype="multipart/form-data" action="<?php echo base_url('admin/RiskMonitoringController/onAddDetailMonitoring')?>" class="form-horizontal" method="POST">
                <input type="hidden" value="<?=$id_detail_mitigation;?>" name="id_detail_mitigation">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small><b>Rencana Mitigasi</b></small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <small><b>Detail Mitigasi</b></small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation_detail;?></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="form-group">
                                <small><b>Output</b></small>
                                <div id="outputList">
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-output"><i class="fas fa-plus-circle"></i> Tambah Output</button>
                            </div>
                        </li>
                        <li class="list-group-item"><br/>
                        <input type="hidden" name="progress_percentage" id="progress_percentage">
                        <div class="progress">
                            
                            <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100"><text id="text-percentage">0%</text></div>
                        </div>
                        <div class="table-responsive pricing pt-2">
                            <table id="my-table" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center prc-wrap"></th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Januari</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Februari</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Maret</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>April</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Mei</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Juni</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Juli</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Agustus</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>September</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Oktober</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>November</small>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="h6 pt-4"><small>Desember</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Target</th>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t01" name="target[]" onclick="calculate_progress_by_target('t01')" value="01">
                                        </td>
                                        <td class="text-center child-cell active">
                                            <input type="checkbox" id="t02" name="target[]" onclick="calculate_progress_by_target('t02')" value="02">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t03" name="target[]" onclick="calculate_progress_by_target('t03')" value="03">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t04" name="target[]" onclick="calculate_progress_by_target('t04')" value="04">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t05" name="target[]" onclick="calculate_progress_by_target('t05')" value="05">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t06" name="target[]" onclick="calculate_progress_by_target('t06')" value="06">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t07" name="target[]" onclick="calculate_progress_by_target('t07')" value="07">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t08" name="target[]" onclick="calculate_progress_by_target('t08')" value="08">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t09" name="target[]" onclick="calculate_progress_by_target('t09')" value="09">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t10" name="target[]" onclick="calculate_progress_by_target('t10')" value="10">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t11" name="target[]" onclick="calculate_progress_by_target('t11')" value="11">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="t12" name="target[]" onclick="calculate_progress_by_target('t12')" value="12">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Realisasi</th>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m01" name="monitoring[]" onclick="calculate_progress_by_monitoring('m01')"  value="01">
                                        </td>
                                        <td class="text-center child-cell active">
                                            <input type="checkbox" id="m02" name="monitoring[]" onclick="calculate_progress_by_monitoring('m02')"  value="02">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m03" name="monitoring[]" onclick="calculate_progress_by_monitoring('m03')"  value="03">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m04" name="monitoring[]" onclick="calculate_progress_by_monitoring('m04')"  value="04">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m05" name="monitoring[]" onclick="calculate_progress_by_monitoring('m05')"  value="05">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m06" name="monitoring[]" onclick="calculate_progress_by_monitoring('m06')"  value="06">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m07" name="monitoring[]" onclick="calculate_progress_by_monitoring('m07')"  value="07">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m08" name="monitoring[]" onclick="calculate_progress_by_monitoring('m08')"  value="08">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m09" name="monitoring[]" onclick="calculate_progress_by_monitoring('m09')"  value="09">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m10" name="monitoring[]" onclick="calculate_progress_by_monitoring('m10')"  value="10">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m11" name="monitoring[]" onclick="calculate_progress_by_monitoring('m11')"  value="11">
                                        </td>
                                        <td class="text-center child-cell">
                                            <input type="checkbox" id="m12" name="monitoring[]" onclick="calculate_progress_by_monitoring('m12')"  value="12">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Catatan</th>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes01" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'01')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            
                                            <div id='div01' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n01" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes02" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'02')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div02' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n02" name="notes[]" placeholder="Masukkan Catatan"></div>
                                            
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes03" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'03')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div03' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n03" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes04" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'04')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div04' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n04" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes05" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'05')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div05' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n05" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes06" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'06')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            
                                            <div id='div06' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n06" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes07" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'07')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div07' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n07" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes08" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'08')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div08' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n08" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes09" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'09')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div09' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n09" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes10" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'10')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div10' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n10" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes11" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'11')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div11' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n11" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" id="btn_notes12" class="btn btn-sm btn-icon btn-warning" onclick="show_notes(<?=$id_detail_mitigation?>,'12')">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div12' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n12" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                    </tr>
                                        
                                    <tr>
                                        <th>Evidence</th>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e01" name="e01" onclick="upload_evidence('01',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e02" name="e02" onclick="upload_evidence('02',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                            <div id='div10' style="display: none;"><br/>
                                            <input class="form-control" style="width:150px" type="text" id="n10" name="notes[]" placeholder="Masukkan Catatan">
                                        </div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e03" name="e03" onclick="upload_evidence('03',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e04" name="e04" onclick="upload_evidence('04',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e05" name="e05" onclick="upload_evidence('05',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e06" name="e06" onclick="upload_evidence('06',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e07" name="e07" onclick="upload_evidence('07',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e08" name="e08" onclick="upload_evidence('08',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e09" name="e09" onclick="upload_evidence('09',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e10" name="e10" onclick="upload_evidence('10',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e11" name="e11" onclick="upload_evidence('11',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" disabled id="e12" name="e12" onclick="upload_evidence('12',<?=$id_detail_mitigation?>)" class="btn btn-sm btn-icon btn-success">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        </li>

                    </ul>
                    </div>
                </div>
                <br/>
            </div>
            <div class="card-footer">
                <a href="<?=base_url('admin/risk-mitigation')?>"type="button" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="m108.92 108.92l294.16 294.16"/></svg> Batal</a>
                <button type="submit" id="btn-add-detail-monitoring"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M380.93 57.37A32 32 0 0 0 358.3 48H94.22A46.21 46.21 0 0 0 48 94.22v323.56A46.21 46.21 0 0 0 94.22 464h323.56A46.36 46.36 0 0 0 464 417.78V153.7a32 32 0 0 0-9.37-22.63ZM256 416a64 64 0 1 1 64-64a63.92 63.92 0 0 1-64 64Zm48-224H112a16 16 0 0 1-16-16v-64a16 16 0 0 1 16-16h192a16 16 0 0 1 16 16v64a16 16 0 0 1-16 16Z"/></svg> Simpan Perubahan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<div class="modal fade" id="modal-add-evidence" name="modal-add-evidence" tabindex="-1" aria-labelledby="addGroupEvidenceModal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog"><?= $this->include("admin/pages/risk_mitigation/evidence")?></div>
</div>

<?= $this->include("js/detail_mitigation_monitoring")?>

