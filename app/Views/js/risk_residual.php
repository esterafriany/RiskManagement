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
		var level = parseInt(probability_level) * parseInt(impact_level);

		if(probability_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

		if(level == 1 || level == 2 || level == 3 || level == 4){
            risk_analysis_residual.value = "R";
        }else if(level == 5 || level == 6 || level == 8 || level == 9){
            risk_analysis_residual.value = "M";
        }else if(level == 10 || level == 12 || level == 15 || level == 16){
            risk_analysis_residual.value = "T";
        }else if(level == 20 || level == 25){
            risk_analysis_residual.value = "E";
        }
	}

	function change_level1(){
		var final_level = document.getElementById("final_level_residual");
		var risk_analysis_residual = document.getElementById("risk_analysis_residual");
		var probability_level = document.getElementById('probability_level_residual').value;
		var impact_level = document.getElementById('impact_level_residual').value;
		
		var level = parseInt(probability_level) * parseInt(impact_level);

		if(impact_level.value != ""){
			final_level.value = level;
		}

		if(level == 1 || level == 2 || level == 3 || level == 4){
            risk_analysis_residual.value = "R";
        }else if(level == 5 || level == 6 || level == 8 || level == 9){
            risk_analysis_residual.value = "M";
        }else if(level == 10 || level == 12 || level == 15 || level == 16){
            risk_analysis_residual.value = "T";
        }else if(level == 20 || level == 25){
            risk_analysis_residual.value = "E";
        }

	}
	
</script>
