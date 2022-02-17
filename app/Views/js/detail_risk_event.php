<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {


  


		var $btn_edit_risk_event = $("#btn-edit-risk-event");
		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_risk_event = arr[arr.length - 1];

		$.ajax({
			url : "<?=site_url('RiskCauseController/getRiskCauseList')?>",
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				
				for(i = 0; i < count; i++){
					
					penampung += `<table width="100%"><tr><td><input type="text" name="risk_cause[]" value="${result[i]['risk_cause']}" class="form-control" placeholder="Masukkan Penyebab Risiko">
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
					
					penampung += `<table width="100%">
						<tr>
							<td width="50%">
								<input type="text" name="risk_mitigation[]" value="${result['risk_mitigation_list'][i]['risk_mitigation']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
							</td>
							<td>Assign To: </td>
							<td>
							<input type="text" id="selectedID-${result['risk_mitigation_list'][i]['id']}" name="selectedID[]">
								<select id="division-${result['risk_mitigation_list'][i]['id']}" multiple class="form-control">
								</select>
							</td>
							<td><button type="button" id="" class="btn btn-outline-danger btn-sm removes" name="removes" ><i class="fas fa-trash-alt"></i></button></td>
						</tr>
						</table>`;


					id_risk_mitigation.push(result['risk_mitigation_list'][i]['id']);

					
				}

				document.getElementById("riskMitigationList").innerHTML = penampung;

				var temp2 = [];
				for(k = 0; k < id_risk_mitigation.length; k++){
				
					var list_risk_mitigation = get_risk_assignment(id_risk_mitigation[k]);
					

					for(j = 0; j < list_risk_mitigation.length; j++){
						temp2.push(id_risk_mitigation[k]);
						
					}
					
					
					var list_division = get_list_division();

					var elm = $('#division-'+id_risk_mitigation[k]);
					$(elm).select2({
						placeholder: "Pilih Divisi",
						data:list_division
					}).change(function () {
						var selectedIDs = $.map($(elm).select2('data'), function (val, i) {
						return val.id;
						}).join(",");
						
						$('#selectedID-'+id_risk_mitigation[k]).val(selectedIDs);
					}).select2('val',temp2);
					
				}
				
				
		
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
											<select class="form-control form-select" name="existing_control_1">
                                                <option value="" disabled selected hidden >Pilihan</option>
												`+ 
												option_risk_category
												+`
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
				'<table width="100%" id="riskCauseTable"><tr><td><input type="text" name="risk_cause[]" value="" class="form-control" placeholder="Masukkan Penyebab Risiko">' +
				'</td><td><button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
		});

		$("#add-more-mitigation").click(function () {

			$("#riskMitigationList").last().append(
				`<table width="100%" id="riskMitigationTable"><tr><td><input type="text" name="risk_mitigation[]" value="" class="form-control" placeholder="Masukkan Mitigasi Risiko">
				</td>
				<td>
				<input type="text" id="selectedID" name="selectedID[]">
				<select id="division[]" name="division[]" multiple>
				</select>
				</td>
				<td><button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`
			);
				var list_division = get_list_division();
				var elm = $('#division');
				$(elm).select2({
					placeholder: "Pilih Divisi",
					data: list_division
				}).change(function () {
					var selectedIDs = $.map($(elm).select2('data'), function (val, i) {
					return val.id;
					}).join(",");
					$('#selectedID').val(selectedIDs);
				});
				

			$.ajax({

				url : "<?php echo base_url('RiskEventController/onAddDetailRisk')?>",
				type: "POST",
				data: {'id_risk_event':id_risk,'risk_cause':JSON.stringify(risk_cause),'risk_mitigation':JSON.stringify(risk_mitigation)},
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
					//swal("Gagal","Gagal mengubah data.","error");
				}
			});
		});

		$("#add-more-risk_category").click(function () {
			$("#riskCategoryList").last().append(
				'<table width="100%" id="riskMitigationTable"><tr><td><input type="text" name="risk_category[]" value="" class="form-control" placeholder="Masukkan Mitgasi Risiko">' +
				'</td><td><button type="button" name="remove1" id="" class="btn btn-outline-primary btn-sm remove1" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
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
		//$("#form-edit-risk-event").submit(function(e) {
		$btn_edit_risk_event.on("click", function (e) {
			//risk cause
			var input = document.getElementsByName('risk_cause[]');
			var risk_cause = [];

			for (var i = 0; i < input.length; i++) {
                var a = input[i];
				risk_cause[i] = a.value;
								
            }

			//risk mitigation
			var input1 = document.getElementsByName('risk_mitigation[]');
			var risk_mitigation = [];

			for (var i = 0; i < input1.length; i++) {
                var b = input1[i];
				risk_mitigation[i] = b.value;
								
            }
			
			var id_risk = document.getElementById('id_risk_event').value;
		
			$.ajax({
				url : "<?php echo base_url('admin/RiskEventController/onAddDetailRisk')?>",
				type: "POST",
				data: {'id_risk_event':id_risk,'risk_cause':JSON.stringify(risk_cause),'risk_mitigation':JSON.stringify(risk_mitigation)},
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
					//swal("Gagal","Gagal mengubah data.","error");
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

</script>


