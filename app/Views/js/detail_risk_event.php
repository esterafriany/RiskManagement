<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		
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
					
					penampung += `<table width="650"><tr><td><input type="text" name="risk_cause[]" value="${result[i]['risk_cause']}" class="form-control" placeholder="Masukkan Penyebab Risiko">
						</td><td>
						<button type="button" id="" class="btn btn-outline-danger btn-sm" 
						onClick="delete_risk_cause(${result[i]['id']})" ><i class="fas fa-trash-alt"></i></button></td></tr></table>`;
			
				}

				document.getElementById("riskCauseList").innerHTML = penampung;
				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

		$("#add-more-cause").click(function () {
			$("#riskCauseList").last().append(
				'<table width="650"><tr><td><input type="text" name="risk_cause[]" value="" class="form-control" placeholder="Masukkan Penyebab Risiko">' +
				'</td><td><button type="button"  name="remove" id="" class="btn btn-outline-primary btn-sm remove" ><i class="fas fa-trash-alt"></i></button></td></tr></table>'+
				''
			);
		});

	});
	$(document).on('click', '.remove', function () {
        $(this).parents('tr').remove();
    });

	function delete_risk_cause(id){
		
		var list = $('#riskCauseList').html();
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
				url : "<?=site_url('RiskCauseController/onDeleteRiskCause')?>/" + id,
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
</script>
