<?= $this->include('admin/template/_partials/js')?>

<script>
	//bar percentage
	let monitoring_number = 0;
	let target_number = 0;
		
	$(document).ready(function() {
		var $btn_edit_detail_monitoring = $("#btn-add-detail-monitoring1");
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

		$.ajax({
			url : "<?=site_url('RiskMonitoringController/getDetailMonitoringMonths')?>/" + id_detail_mitigation,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var count = result.length;
				var monitoring_sum = 0;
				var percentage = 0;
				
				for(i = 0; i < count; i++){
					var arr = result[i]['target_month'].split("-");
        			var target_month = arr[arr.length - 2];
					
					$("#t"+target_month).prop( "checked", true );
					$('#n'+target_month).val(result[i]['notes']);

					var arr1 = result[i]['monitoring_month'].split("-");
        			var monitoring_month = arr1[arr1.length - 2];
					
					if(monitoring_month != "00"){
						monitoring_sum = monitoring_sum + 1;
						$("#m"+monitoring_month).prop( "checked", true );
					}
				}
				
				percentage = (monitoring_sum / count) * 100;

				document.getElementById("progress-bar").style.width = percentage+"%";
				document.getElementById("text-percentage").innerHTML = percentage.toFixed(2)+"%";

				target_number = count;
				monitoring_number = monitoring_sum;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});
		
		$.ajax({
			url : "<?=site_url('RiskMonitoringController/getEvidenceList')?>/" + id_detail_mitigation,
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
									<a href="">${result[i]['filename']}</a>
									
								</td>
								<td>
									<button type="button" onclick="delete_evidence(${result[i]['id']})"  class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
						</table>`;
				}
				
				document.getElementById("evidenceList").innerHTML = penampung;
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
							<input type="file" name="evidence[]" id="evidence" value="" class="form-control" placeholder="Browse File">
						
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

			
	});

	function delete_evidence(id){
		swal({
			title: "Apakah anda yakin ingin hapus?",
			text: "Data akan dihapus tidak dapat di-recover!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			closeOnConfirm: false
		},
		function () {
			// ajax delete data from database
			  $.ajax({
				url : "<?=site_url('RiskMonitoringController/onDeleteEvidence')?>/" + id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					
					swal({
					  title: "Terhapus!",
					  text: "Data berhasil dihapus!",
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
					swal("Oops..","Data gagal dihapus.","error");
				}
			});
			
		});
		
	}

	function calculate_progress_by_target(id) {
		var checkBox = document.getElementById(id);
		if (checkBox.checked == true){
			target_number = target_number + 1;
		} else {
			target_number = target_number - 1;
		}
		percentage = (monitoring_number / target_number) * 100;
		document.getElementById("progress-bar").style.width = percentage+"%";
		document.getElementById("text-percentage").innerHTML = percentage.toFixed(2)+"%";

	}

	function calculate_progress_by_monitoring(id) {
		var checkBox = document.getElementById(id);
		if (checkBox.checked == true){
			monitoring_number = monitoring_number + 1;
		} else {
			monitoring_number = monitoring_number - 1;
		}
		
		percentage = (monitoring_number / target_number) * 100;
		document.getElementById("progress-bar").style.width = percentage+"%";
		document.getElementById("text-percentage").innerHTML = percentage.toFixed(2)+"%";
	}

	function show_notes(id, month){
		//$('#n'+month).each (function() { this.type = 'text'; });
		$("#div"+month).toggle(); 
		$.ajax({
			url : "<?=site_url('RiskMonitoringController/onShowNotes')?>/" + id +"/" + month,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				if(data == null){
					console.log('a');
					$('#n'+month).val("Masukkan Data");
				}
				 
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				swal('Data tidak ditemukan.');
			}
		});
			
	}

</script>


