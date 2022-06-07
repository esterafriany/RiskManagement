<?php 
$session = session();
if($session->get('state_message')){
	if($session->get('state_message') == 'error'){ ?>
	<script>
		$(document).ready(function() {
		swal("Error","Data gagal ditambahkan. Pastikan Data Output, Target dan Realisasi tidak kosong.","error");
		});
	</script>
<?php }else if($session->get('state_message') == 'success'){ ?>
	<script>
		$(document).ready(function() {
		swal("Success","Data berhasil ditambahkan.","success");
		});
	</script>
<?php }else if($session->get('state_message') == 'file'){ ?>
	<script>
		$(document).ready(function() {
		swal("Success","File berhasil di-upload.","success");
		});
	</script>
<?php }
}?>


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
					
					$("#t"+target_month).prop("checked", true );
					$('#n'+target_month).val(result[i]['notes']);
					$('#e'+target_month).prop('disabled', false);
					if(result[i]['notes'] != ""){
						$('#btn_notes'+target_month).removeClass("btn btn-sm btn-icon btn-warning").addClass("btn btn-sm btn-icon btn-primary");      
					}
					
					var arr1 = result[i]['monitoring_month'].split("-");
        			var monitoring_month = arr1[arr1.length - 2];
					
					if(monitoring_month != "00"){
						monitoring_sum = monitoring_sum + 1;
						$("#m"+monitoring_month).prop( "checked", true );
					}
				}
				
				percentage = (monitoring_sum / count) * 100;

				document.getElementById("progress-bar").style.width = percentage+"%";
				document.getElementById("progress_percentage").value = percentage.toFixed(2);
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
		
		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
		});
		
	});

	function delete_evidence(id,id_detail_monitoring){
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
				url : "<?=site_url('RiskMonitoringController/onDeleteEvidence')?>/" + id + "/" + id_detail_monitoring,
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
		console.log(id);
		var checkBox = document.getElementById(id);
		if (checkBox.checked == true){
			target_number = target_number + 1;
		} else {
			target_number = target_number - 1;
		}
		percentage = (monitoring_number / target_number) * 100;
		document.getElementById("progress-bar").style.width = percentage+"%";
		
		document.getElementById("progress_percentage").value = percentage.toFixed(2);
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
		document.getElementById("progress_percentage").value = percentage.toFixed(2);
		document.getElementById("text-percentage").innerHTML = percentage.toFixed(2)+"%";
	}

	function show_notes(id, month){
		$("#div"+month).toggle(); 
		$.ajax({
			url : "<?=site_url('RiskMonitoringController/onShowNotes')?>/" + id +"/" + month,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				if(data == null){
					$('#n'+month).val();
				}
				 
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				swal('Data tidak ditemukan.');
			}
		});
	}

	
	function upload_evidence(target_month, id_detail_mitigation){
		$.ajax({
			url : "<?=site_url('RiskMonitoringController/getEvidenceList')?>/" + target_month + "/" +id_detail_mitigation,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				penampung = '<table width="100%">';
				var text_temp = "";
				
				for(i = 0; i < count; i++){
					text_temp = result[i]['filename'].substring(0, 100);
					penampung += `<table width="100%">
									<tr>
										<td width="100%"> 
											<a href="<?=base_url('uploads')?>/${result[i]['id_detail_monitoring']}/${result[i]['filename']}" target="_blank">${text_temp} &nbsp;</a>
										</td>
										<td>
											<button type="button" onclick="delete_evidence('${result[i]['id']}','${result[i]['id_detail_monitoring']}')" class="btn btn-outline-danger btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
											<a type="button" href="<?php echo base_url('admin/download')?>/${result[i]['filename']}" class="btn btn-outline-success btn-sm" ><i class="fas fa-download"></i></a>
										</td>
									</tr>
								</table>`;
				}
				penampung += '</table>';


				for(i = 0; i < count; i++){
					text_temp = result[i]['filename'].substring(0, 100);
					penampung += `<tr>
								<td width="50%"> 
									<a>${text_temp} &nbsp;</a>
								</td>
								<td>
									<button type="button" onclick="delete_evidence('${result[i]['id']}','${result[i]['id_detail_monitoring']}')" class="btn btn-outline-danger btn-sm removes" ><i class="fas fa-trash-alt"></i></button>
									<a type="button" href="<?php echo base_url('admin/download')?>/${result[i]['id_detail_monitoring']}/${result[i]['filename']}" class="btn btn-outline-success btn-sm" ><i class="fas fa-download"></i></a>
								</td>
							</tr>`;
				}
				var monthName = "";
				if(target_month == "01"){
					monthName = "Januari";
				}else if(target_month == "02"){
					monthName = "Februari";
				}else if(target_month == "03"){
					monthName = "Maret";
				}else if(target_month == "04"){
					monthName = "April";
				}else if(target_month == "05"){
					monthName = "Mei";
				}else if(target_month == "06"){
					monthName = "Juni";
				}else if(target_month == "07"){
					monthName = "Juli";
				}else if(target_month == "08"){
					monthName = "Agustus";
				}else if(target_month == "09"){
					monthName = "September";
				}else if(target_month == "10"){
					monthName = "Oktober";
				}else if(target_month == "11"){
					monthName = "November";
				}else if(target_month == "12"){
					monthName = "Desember";
				}

				$('#modal-add-evidence').modal('show');
				$('.modal-title').text('Tambah Evidence - Bulan '+monthName); 
				$('[name="id_detail_mitigation"]').val(id_detail_mitigation);
				$('[name="month"]').val(target_month);
				document.getElementById("evidenceList").innerHTML = penampung;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				swal('Error get data from ajax');
			}
		});
  	}

</script>


