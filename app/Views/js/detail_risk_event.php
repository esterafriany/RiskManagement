<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		
		var $btn_edit_risk_event = $("#btn-edit-risk-event");

		$.ajax({
			url : "<?=site_url('RiskCauseController/getRiskCauseList')?>",
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				//var data = JSON.parse(result);
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
			url : "<?=site_url('RiskMitigationController/getRiskMitigationList')?>",
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				
				for(i = 0; i < count; i++){
					
					penampung += `<table width="100%"><tr><td><input type="text" name="risk_mitigation[]" value="${result[i]['risk_mitigation']}" class="form-control" placeholder="Masukkan Mitigasi Risiko">
						</td><td>
						<button type="button" id="" class="btn btn-outline-danger btn-sm removes" 
						name="removes" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`;
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
				'<table width="100%" id="riskCauseTable"><tr><td><input type="text" name="risk_cause[]" value="" class="form-control" placeholder="Masukkan Penyebab Risiko">' +
				'</td><td><button type="button" name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
		});

		$("#add-more-mitigation").click(function () {
			$("#riskMitigationList").last().append(
				'<table width="100%" id="riskMitigationTable"><tr><td><input type="text" name="risk_mitigation[]" value="" class="form-control" placeholder="Masukkan Mitgasi Risiko">' +
				'</td><td><button type="button" name="removes" id="" class="btn btn-outline-primary btn-sm removes" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
		});

		$(document).on('click', '.remove', function () {
			$(this).parents('tr').remove();
		});

		$(document).on('click', '.removes', function () {
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
			//console.log(risk_cause);

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

	// function delete_risk_cause(id, id_risk_event){
		
	// 	var list = $('#riskCauseTable').html();
	// 	swal({
	// 		title: "Apakah anda yakin ingin hapus?",
	// 		text: "Data akan dihapus tidak dapat di-recover!",
	// 		type: "warning",
	// 		showCancelButton: true,
	// 		confirmButtonClass: "btn-danger",
	// 		confirmButtonText: "Yes",
	// 		closeOnConfirm: false
	// 	},
	// 	function () {
	// 		// ajax delete data from database
	// 		  $.ajax({
	// 			url : "<?=site_url('RiskCauseController/onDeleteRiskCause')?>/" + id,
	// 			type: "POST",
	// 			dataType: "JSON",
	// 			success: function(data)
	// 			{
	// 				swal({
	// 				  title: "Terhapus!",
	// 				  text: "Data berhasil dihapus!",
	// 				  type: "success",
	// 				  confirmButtonText: "OK"
	// 				},
	// 				function(isConfirm){
	// 				  if (isConfirm) {
	// 					document.getElementById("riskCauseList").reset();
	// 					//$('#riskCauseList').load(id_risk_event + '/#riskCauseList');
	// 				  }
	// 				});
	// 			},
	// 			error: function (jqXHR, textStatus, errorThrown)
	// 			{
	// 				swal("Oops..","Data gagal dihapus.","error");
	// 			}
	// 		});
			
	// 	});
		
	// }
</script>
