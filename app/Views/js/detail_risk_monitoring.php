<?= $this->include('admin/template/_partials/js')?>
<script>
	$(document).ready(function() {	
		var $btn_edit_risk_detail = $("#btn-edit-risk-detail");
		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_risk_event = arr[arr.length - 1];
		var cause_number = 1;
		var mitigation_number = 1;
		let y = 0;
		
		$.ajax({
			url : "<?=site_url('RiskCauseController/getRiskCauseList')?>/" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				for(i = 0; i < count; i++){
					penampung += `<table width="100%">
						<tr>
							<td width="2%" valign="top">${cause_number}.</td>
							<td width="95%"><div class='text-wrap width-200'>${result[i]['risk_cause']}</div>
							</td>
						</tr></table>`;
						cause_number++;
				}
				
				document.getElementById("riskCauseList").innerHTML = penampung;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

		$.ajax({
			url : "<?=site_url('RiskMitigationController/getRiskMitigationList/')?>" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var count1 = result['risk_mitigation_list'].length;
				var count2 = result['risk_division_list'].length;
				
				var penampung = "";
				var id_risk_mitigation = [];
				var count = result.length;
				
				for(i = 0; i < count1; i++){
					penampung += `
					
					<table width="100%">
						<tr>
							<div class="col-md-12 col-lg-12">
								<div class="row row-cols-1">
									<td width="30px" valign="top">${mitigation_number}.</td>
									<td style="white-space:normal;width:300px"  valign="top">
										${result['risk_mitigation_list'][i]['risk_mitigation']}
										<input type="hidden" name="risk_mitigation_id[]" value="${result['risk_mitigation_list'][i]['id']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
									</td>
									<td valign="top"><svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="m190.06 414l163.12-139.78a24 24 0 0 0 0-36.44L190.06 98c-15.57-13.34-39.62-2.28-39.62 18.22v279.6c0 20.5 24.05 31.56 39.62 18.18Z"/></svg></td>
									<td valign="top">
									<input type="hidden" id="selectedID-${i}" name="assignment_division[]">
										<select onChange="show(${i})" id="division-${i}" multiple="multiple" class="form-control">
										</select>
									</td>
									<td valign="top">
										<a href="<?=base_url()?>/admin/detail-risk-mitigation/${result['risk_mitigation_list'][i]['id']}/${id_risk_event}" type="button" id="" class="btn btn-outline-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M64 384h384v-42.67H64Zm0-106.67h384v-42.66H64ZM64 128v42.67h384V128Z"/></svg> Detail Mitigasi</a>
									</td>
								</div>
							</div>
						</tr>
						</table>
						`;
					id_risk_mitigation.push(result['risk_mitigation_list'][i]['id']);
					mitigation_number++;
				}
			
				document.getElementById("riskMitigationList").innerHTML = penampung;

				var temp2 = [];
				y = id_risk_mitigation.length;
				for(k = 0; k < id_risk_mitigation.length; k++){
				
					var list_risk_mitigation = get_risk_assignment(id_risk_mitigation[k]);
					
					for(j = 0; j < list_risk_mitigation.length; j++){
						temp2.push(list_risk_mitigation[j]['id']);
					}
					
					var list_division = get_list_division();
					var elm = $('#division-'+k);
					var prevSelect = $(elm).select2({
						placeholder: "Pilih Divisi",
						data:list_division
					}).select2('val',temp2);
					$('#selectedID-'+k).val(temp2);

					temp2=[];
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

		$("#add-more-cause").click(function () {
			$("#riskCauseList").last().append(
				`<table width="100%" id="riskCauseTable"><tr><td>${cause_number}.</td><td><input type="text" name="risk_cause[]" value="" class="form-control" placeholder="Masukkan Penyebab Risiko">
				</td><td><button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`
				
			);

			cause_number++;
		});

		$("#add-more-mitigation").click(function () {
			$("#riskMitigationList").last().append(
				`<table width="100%">
					<tr>
						<td>${mitigation_number}.</td>
						<td width="50%">
							<input type="text" name="risk_mitigation[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							<input type="hidden" name="risk_mitigation_id[]" value="" class="form-control" >
						</td>
						<td>Assign To:</td>
						<td>
							<input type="hidden" id="selectedID-${y}" name="assignment_division[]">
							<select onchange="show(${y})" id="division-${y}" multiple="multiple" name="assignment_division[]" class="form-control">
							</select>
						</td>
						<td>
							<button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				</table>`
			);
			
				mitigation_number = mitigation_number + 1;
				var list_division = get_list_division();
				var elm = $('#division-'+y);
				var prevSelect = $(elm).select2({
					placeholder: "Pilih Divisi",
					data: list_division
				});


				y++;
		});

		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
			cause_number = cause_number - 1;

		});

		$(document).on('click', '.removes', function () {
			$(this).parents('tr').remove();
			mitigation_number = mitigation_number-1;
		});

		// edit risk
		$btn_edit_risk_detail.on("click", function (e) {
			//risk event
			var risk_event = new Array();
			risk_event = {
				'risk_event':  document.getElementById('risk_event').value,
				'id_kpi':  document.getElementById('id_kpi').value
			};
			
			//risk cause
			var input = document.getElementsByName('risk_cause[]');
			var risk_cause = [];
			for (var i = 0; i < input.length; i++) {
                var a = input[i];
				risk_cause[i] = a.value;		
            }

			//risk mitigation
			var input1 = document.getElementsByName('risk_mitigation[]');
			var input2 = document.getElementsByName('assignment_division[]');
			var division_assignment = new Array();
			for (var i = 0; i < input1.length; i++) {
				division_assignment[i]= input1[i].value +"#"+input2[i].value;
            }
			
			var id_risk = document.getElementById('id_risk_event').value;
			$.ajax({
				url : "<?php echo base_url('RiskMitigationController/onAddDetailRisk')?>",
				type: "POST",
				data: {'id_risk_event':id_risk,'risk_event':JSON.stringify(risk_event),'risk_cause':JSON.stringify(risk_cause),'division_assignment':JSON.stringify(division_assignment)},
				dataType: "JSON",

				success: function(response)
				{
					//console.log(response);
					swal({
					  title: "Sukses!",
					  text: "Data sukses ditambah/diubah!",
					  type: "success",
					  confirmButtonText: "OK"
					},
					function(isConfirm){
					  if (isConfirm) {
						location.reload();
					  }
					});
				  
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal("Gagal","Gagal mengubah data.","error");
				}
			});

		});
		
	});
	
	function get_risk_assignment(id){
		var a;
		$.ajax({
			url : "<?=site_url('RiskMitigationController/getRiskMitigationDivision')?>/" + id,
			type: "GET",
			dataType: "json",
			async: false,
			success: function(data)
			{
				a = data;
			}
		});
		return a;
	}

	function get_list_division(){
		var a;
		$.ajax({
			url : "<?=site_url('UserController/getListDivision')?>",
			type: "GET",
			dataType: "json",
			async: false,
			success: function(data)
			{
				a = data;
			}
		});
		return a;
	}

	function show(id_risk_mit){
		var elm = $('#division-'+id_risk_mit);
		var selectedIDs = $.map($(elm).select2('data'), function (val, i) {
			return val.id;
		}).join(","); 
		
		$('#selectedID-'+id_risk_mit).val(selectedIDs);
	}

</script>


