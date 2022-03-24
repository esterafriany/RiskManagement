<?= $this->include('admin/template/_partials/js')?>

<script>
	
	$(document).ready(function() {
		var $btn_edit_risk_residual = $("#btn-edit-risk-residual");
			
		// add risk event
		$btn_edit_risk_residual.on("click", function (e) {
			
        $.ajax({
				url : "<?php echo base_url('admin/RiskEventController/onAddRiskResidual')?>",
				type: "POST",
				data: $('#form-add-risk-residual').serialize(),
				dataType: "JSON",

				success: function(response)
				{
					//console.log(response);
					$('.modal-backdrop.show').css('opacity','0');
					$('.modal-backdrop').css('z-index','-1');
					$('#modal-add-group').modal("hide");
				   
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
					swal("Error","Gagal menambah data. Pastikan semua field terisi","error");

				}
			});
		
		});

	});

	function change_level(){
		var final_level = document.getElementById("final_level_residual");
		var probability_level = document.getElementById('probability_level_residual').value;
		var impact_level = document.getElementById('impact_level_residual').value;
		
		if(probability_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

	}

	function change_level1(){
		var final_level = document.getElementById("final_level_residual");
		var probability_level = document.getElementById('probability_level_residual').value;
		var impact_level = document.getElementById('impact_level_residual').value;
		
		if(impact_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

	}
	
</script>
