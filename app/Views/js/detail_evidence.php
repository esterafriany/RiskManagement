<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		var $btn_add_kpi = $("#btn-add-kpi");
		var $btn_edit_kpi = $("#btn-edit-kpi");

		$("#add-more-evidence").click(function () {
			$("#evidenceList").last().append(
				`<table width="100%">
					<tr>
						<td width="100%">
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
		$(document).on('click', '.removes', function () {
			$(this).parents('tr').remove();
		});
	});

	function copy_evidence(){
		//$('#modal-add-evidence').modal('toggle');
		
		$('#modal-edit-kpi').modal('show');
		$('.modal-title').text('Edit KPI'); 
	}
</script>
