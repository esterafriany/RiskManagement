<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		var $btn_edit_risk_event = $("#btn-edit-risk-event");
		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_detail_mitigation = arr[arr.length - 1];
		let y = 0;
		
		$.ajax({
			url : "<?=site_url('RiskMonitoringController/getOutputList')?>/" + id_detail_mitigation,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				
				for(i = 0; i < count; i++){
					
					penampung += `<table width="100%">
							<tr>
								
								<td width="50%">
									<input type="text" name="output[]" value="${result[i]['output']}" class="form-control" placeholder="Masukkan Output">
									<input type="hidden" name="output_id[]" value="${result[i]['id']}" class="form-control" >
								</td>
								<td>
									<button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
						</table>`;
				}
				
				document.getElementById("outputList").innerHTML = penampung;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

		$("#add-more-output").click(function () {
			$("#outputList").last().append(
				`<table width="100%">
					<tr>
						<td width="50%">
							<input type="text" name="output[]" value="" class="form-control" placeholder="Masukkan Output">
							<input type="hidden" name="outputId[]" value="" class="form-control" >
						</td>
						<td>
							<button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				</table>`
			);
		});	

		$("#add-more-evidence").click(function () {
			$("#evidenceList").last().append(
				`<table width="100%">
					<tr>
						<td width="50%">
							<input type="file" name="evidence_file_name[]" value="" class="form-control" placeholder="Browse File">
							<input type="hidden" name="evidenceId[]" value="" class="form-control" >
						</td>
						<td>
							<button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				</table>`
			);
		});		

		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
		});

		$(document).on('click', '.removes', function () {
			$(this).parents('tr').remove();
		});

		// edit risk
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
			var division_assignment = new Array();
			for (var i = 0; i < input1.length; i++) {
				division_assignment[i]= input1[i].value +"."+input2[i].value;
            }

			// //risk category
			// var input3 = document.getElementsByName('risk_category[]');
			// var risk_category = [];
			// for (var i = 0; i < input3.length; i++) {
            //     var a = input3[i];
			// 	risk_category[i] = a.value;			
            // }
			
			var id_risk = document.getElementById('id_risk_event').value;
			$.ajax({
				url : "<?php echo base_url('admin/RiskMitigationController/onAddDetailRisk')?>",
				type: "POST",
				data: {'id_risk_event':id_risk,'risk_event':JSON.stringify(risk_event),'risk_cause':JSON.stringify(risk_cause),'division_assignment':JSON.stringify(division_assignment)},
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
	

</script>


