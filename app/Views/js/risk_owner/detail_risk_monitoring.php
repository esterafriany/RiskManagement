<?= $this->include('risk_owner/template/_partials/js')?>

<script>
	$(document).ready(function() {
		var $btn_edit_risk_detail = $("#btn-edit-risk-detail");
		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_risk_event = arr[arr.length - 1];
		var cause_number = 1;
		var mitigation_number = 1;
		let y = 0;
		
		var id_risk_owner = document.getElementById('id_division').value;

		$.ajax({
			url : "<?=site_url('RiskOwner/RiskCauseController/getRiskCauseList')?>/" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				
				for(i = 0; i < count; i++){
					
					penampung += `<table width="100%"><tr><td>${cause_number}.</td><td><input type="text" name="risk_cause[]" value="${result[i]['risk_cause']}" class="form-control" placeholder="Masukkan Penyebab Risiko">
						</td><td>
						<button type="button" id="" class="btn btn-outline-danger btn-sm remove" 
						name="remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`;
					
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
			url : "<?=site_url('RiskOwner/RiskMitigationController/getRiskMitigationListRiskOwner/')?>" + id_risk_event + "/" + id_risk_owner,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var count1 = result['risk_mitigation_list'].length;
				//var count2 = result['risk_division_list'].length;
				
				var penampung = "";
				var id_risk_mitigation = [];
				var count = result.length;
				
				for(i = 0; i < count1; i++){
					penampung += `<table width="100%">
						<tr>
							<td>${mitigation_number}.</td>
							<td width="100%">
								<input type="text" name="risk_mitigation[]" value="${result['risk_mitigation_list'][i]['risk_mitigation']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
								<input type="hidden" name="risk_mitigation_division_id[]" value="${result['risk_mitigation_list'][i]['id_risk_mitigation_division']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
								<input type="hidden" name="risk_mitigation_id[]" value="${result['risk_mitigation_list'][i]['id_risk_mitigation']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							</td>
							<td>
								<button type="button" id="" class="btn btn-outline-danger btn-sm removes" name="removes" ><i class="fas fa-trash-alt"></i></button>
								<a href="<?=base_url()?>/risk_owner/detail-mitigation-risk/${result['risk_mitigation_list'][i]['id_risk_mitigation']}" type="button" id="" class="btn btn-outline-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M64 384h384v-42.67H64Zm0-106.67h384v-42.66H64ZM64 128v42.67h384V128Z"/></svg> Detail Mitigasi</a>
								</td>
						</tr>
						</table>`;
						mitigation_number++;
					id_risk_mitigation.push(result['risk_mitigation_list'][i]['id']);
				}
			
				document.getElementById("riskMitigationList").innerHTML = penampung;
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

						<td width="100%">
							<input type="text" name="risk_mitigation[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							<input type="hidden" name="risk_mitigation_division_id[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							<input type="hidden" name="risk_mitigation_id[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
						</td>
						<td>
							<button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				</table>`
			);
			mitigation_number++;
		});

		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
			cause_number = cause_number - 1 ;
		});

		$(document).on('click', '.removes', function () {
			$(this).parents('tr').remove();
			mitigation_number = mitigation_number - 1 ;

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
			var input2 = document.getElementsByName('risk_mitigation_division_id[]');
			var input3 = document.getElementsByName('risk_mitigation_id[]');
			
			var risk_mitigation = new Array();
			for (var i = 0; i < input1.length; i++) {
				risk_mitigation[i]= input1[i].value+"#"+input2[i].value+"#"+input3[i].value;
            }
			
			var id_risk = document.getElementById('id_risk_event').value;
			id_division = document.getElementById('id_division').value;

			$.ajax({
				url : "<?php echo base_url('RiskOwner/RiskMitigationController/onAddDetailRisk')?>",
				type: "POST",
				data: {'id_division': id_division,'id_risk_event':id_risk,'risk_event':JSON.stringify(risk_event),'risk_cause':JSON.stringify(risk_cause),'risk_mitigation':JSON.stringify(risk_mitigation)},
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
			url : "<?=site_url('RiskOwner/RiskMitigationController/getRiskMitigationDivision')?>/" + id,
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


