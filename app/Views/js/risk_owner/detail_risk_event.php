<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		
		var $btn_edit_risk_event = $("#btn-edit-risk-event");
		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_risk_event = arr[arr.length - 1];
		let y = 0;

		var id_risk_owner = document.getElementById('id_risk_owner').value;

		$.ajax({
			url : "<?=site_url('RiskCauseController/getRiskCauseList')?>/" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				
				for(i = 0; i < count; i++){
					
					penampung += `<table width="100%"><tr><td width="100%"><input type="text" name="risk_cause[]" value="${result[i]['risk_cause']}" class="form-control" placeholder="Masukkan Penyebab Risiko">
						</td><td>
						<button type="button" id="" class="btn btn-outline-danger btn-sm remove" 
						name="remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`;
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
				var count2 = result['risk_division_list'].length;
				
				var penampung = "";
				var id_risk_mitigation = [];
				var count = result.length;
				
				for(i = 0; i < count1; i++){
					penampung += `<table width="100%">
						<tr>
							<td width="100%">
								<input type="text" name="risk_mitigation[]" value="${result['risk_mitigation_list'][i]['risk_mitigation']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
								<input type="hidden" name="risk_mitigation_id[]" value="${result['risk_mitigation_list'][i]['id']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							</td>
							
							<td>
							<input type="hidden" id="selectedID-${i}" name="assignment_division[]">
							</td>
							<td><button type="button" id="" class="btn btn-outline-danger btn-sm removes" name="removes" ><i class="fas fa-trash-alt"></i></button></td>
						</tr>
						</table>`;
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

		$.ajax({
			url : "<?=site_url('RiskCategoryController/getRiskCategoryByRiskEvent')?>/" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var option_risk_category = "";
				var count1 = result['risk_event_category_list'].length;
				var count2 = result['risk_category_list'].length;

				for(i = 0; i < count1; i++){
					for(j = 0; j < count2; j++){
						if(result['risk_category_list'][j]['id'] == result['risk_event_category_list'][i]['id_category']){
							option_risk_category += `<option value="${result['risk_category_list'][j]['id']}" selected>${result['risk_category_list'][j]['name']}</option>`;
						
						}else{
							option_risk_category += `<option value="${result['risk_category_list'][j]['id']}">${result['risk_category_list'][j]['name']}</option>`;
						}
					}
					penampung += `<table width="100%">
									<tr>
										<td>
											<select class="form-control form-select" name="risk_category[]">
                                                <option value="" disabled selected hidden >Pilihan</option>
												`+  option_risk_category +`
                                            </select>
												
										</td>
										<td>
											<button type="button" id="" class="btn btn-outline-danger btn-sm remove1" name="remove1" ><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
								</table>`;
								option_risk_category = "";
				}
				
				document.getElementById("riskCategoryList").innerHTML = penampung;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

		$("#add-more-cause").click(function () {
			$("#riskCauseList").last().append(
				'<table width="100%" id="riskCauseTable"><tr><td width="100%"><input type="text" name="risk_cause[]" value="" class="form-control" placeholder="Masukkan Penyebab Risiko">' +
				'</td><td><button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
		});

		$("#add-more-mitigation").click(function () {
			
			$("#riskMitigationList").last().append(
				`<table width="100%">
					<tr>
						<td width="100%">
							<input type="text" name="risk_mitigation[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							<input type="hidden" name="risk_mitigation_id[]" value="" class="form-control" >
						</td>
						<td>
							<input type="hidden" id="selectedID-${y}" name="assignment_division[]">
						</td>
						<td>
							<button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				</table>`
			);
			
				var list_division = get_list_division();
				var elm = $('#division-'+y);
				var prevSelect = $(elm).select2({
					placeholder: "Pilih Divisi",
					data: list_division
				});


				y++;
		});

		$("#add-more-risk_category").click(function () {
			
			var risk_category = get_list_risk_category();
			var option_risk_category = "";
			var count = risk_category.length;

			for( var j = 0; j < count; j++){
				option_risk_category += `<option value="${risk_category[j]['id']}">${risk_category[j]['name']}</option>`;
			}

			$("#riskCategoryList").last().append(`<table width="100%">
							<tr>
								<td>
									<select class="form-control form-select" name="risk_category[]">
										<option value="" disabled selected hidden >Pilihan</option>
										`+  option_risk_category +`
									</select>
										
								</td>
								<td>
									<button type="button" id="" class="btn btn-outline-danger btn-sm remove1" name="remove1" ><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
						</table>`);
			option_risk_category = "";
		});

		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
		});

		$(document).on('click', '.removes', function () {
			$(this).parents('tr').remove();
		});

		$(document).on('click', '.remove1', function () {
			$(this).parents('tr').remove();
		});

		// edit risk event
		$btn_edit_risk_event.on("click", function (e) {
			//risk event
			var risk_event = new Array();
			risk_event = {
				'objective':  document.getElementById('objective').value,
				'risk_event':  document.getElementById('risk_event').value,
				'year':  document.getElementById('year').value,
				'id_kpi':  document.getElementById('id_kpi').value,
				'existing_control_1':  document.getElementById('existing_control_1').value,
				'existing_control_2':  document.getElementById('existing_control_2').value,
				'existing_control_3':  document.getElementById('existing_control_3').value,
				'probability_level':  document.getElementById('probability_level').value,
				'impact_level':  document.getElementById('impact_level').value,
				'final_level':  document.getElementById('final_level').value,
				'target_probability_level':  document.getElementById('target_probability_level').value,
				'target_impact_level':  document.getElementById('target_impact_level').value,
				'target_final_level':  document.getElementById('target_final_level').value,
				'risk_analysis':  document.getElementById('risk_analysis').value
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
			//var division_assignment = new Array();
			// for (var i = 0; i < input1.length; i++) {
			// 	division_assignment[i]= input1[i].value +"."+input2[i].value;
            // }

			//risk category
			var input3 = document.getElementsByName('risk_category[]');
			var risk_category = [];
			for (var i = 0; i < input3.length; i++) {
                var a = input3[i];
				risk_category[i] = a.value;			
            }
			
			var id_risk = document.getElementById('id_risk_event').value;
			$.ajax({
				url : "<?php echo base_url('risk_owner/RiskEventController/onAddDetailRisk')?>",
				type: "POST",
				data: {'year': document.getElementById('year').value,'id_risk_event':id_risk,'risk_event':JSON.stringify(risk_event),'risk_category':JSON.stringify(risk_category),'risk_cause':JSON.stringify(risk_cause)},
				dataType: "JSON",

				success: function(response)
				{
					console.log(response);
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

	function get_list_risk_category(){
		var a;
		$.ajax({
			url : "<?=site_url('RiskCategoryController/getRiskCategoryList')?>",
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

	function change_level(){
		var final_level = document.getElementById("final_level");
		var probability_level = document.getElementById('probability_level').value;
		var impact_level = document.getElementById('impact_level').value;
		
		if(probability_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

	}

	function change_level1(){
		var final_level = document.getElementById("final_level");
		var probability_level = document.getElementById('probability_level').value;
		var impact_level = document.getElementById('impact_level').value;
		
		if(impact_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

	}

	function change_level_target(){
		var final_level = document.getElementById("target_final_level");
		var probability_level = document.getElementById('target_probability_level').value;
		var impact_level = document.getElementById('target_impact_level').value;
		
		if(probability_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}
	}

	function change_level_target1(){
		var final_level = document.getElementById("target_final_level");
		var probability_level = document.getElementById('target_probability_level').value;
		var impact_level = document.getElementById('target_impact_level').value;
		
		if(impact_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}
	}
</script>


