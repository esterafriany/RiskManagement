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
                <input type="text" value="<?=$id_detail_mitigation;?>" name="id_detail_mitigation">
                <div class="row">
                    <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Rencana Mitigasi</small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <small>Detail Mitigasi</small>
                                        <textarea disabled name="risk_mitigation" class="form-control"><?=$risk_mitigation_data->risk_mitigation_detail;?></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="form-group">
                                <small>Evidence </small>
                                <div id="evidenceList">
                                     
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-evidence"><i class="fas fa-plus-circle"></i> Tambah File</button>
                                
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <small>Output</small>
                                <div id="outputList">
                                                
                                </div><br/>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-more-output"><i class="fas fa-plus-circle"></i> Tambah Output</button>
                                
                            </div>
                        </li>
                        <li class="list-group-item"><br/>
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
                                        <th scope="row">Monitoring</th>
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
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'01')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            
                                            <div id='div01' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n01" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'02')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div02' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n02" name="notes[]" placeholder="Masukkan Catatan"></div>
                                            
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'03')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div03' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n03" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'04')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div04' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n04" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'05')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div05' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n05" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'06')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            
                                            <div id='div06' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n06" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'07')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div07' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n07" name="notes[]" placeholder="Masukkan Catatan"></div>
                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'08')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div08' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n08" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'09')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div09' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n09" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'10')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div10' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n10" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'11')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div11' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n11" name="notes[]" placeholder="Masukkan Catatan"></div>

                                        </td>
                                        <td class="text-center child-cell">
                                            <button type="button" class="btn btn-sm btn-icon btn-primary" onclick="show_notes(<?=$id_detail_mitigation?>,'12')">
                                                <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                </span>
                                            </button>
                                            <div id='div12' style="display: none;"><br/><input class="form-control" style="width:150px" type="text" id="n12" name="notes[]" placeholder="Masukkan Catatan"></div>

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
                <a href="<?=base_url('admin/risk-mitigation')?>"type="button" class="btn btn-secondary">Batal</a>
                <button type="submit" id="btn-add-detail-monitoring"  class="btn btn-primary">Simpan</button>
            </div>
            
         </div>
      </div>
      </form>
   </div>
</div>

<?php if($state_message){

if($state_message == 'error'){ ?>
<script>
    $(document).ready(function() {
      swal("Test","Tessss","error");
    });
</script>
<?php }else if($state_message == 'success'){ ?>
<script>
    $(document).ready(function() {
      swal("Test","Tessss","success");
    });
</script>
<?php } 
}?>


<?= $this->include("js/detail_mitigation_monitoring")?>

