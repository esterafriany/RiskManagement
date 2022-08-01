<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		var $btn_add_kpi = $("#btn-add-kpi");
		var $btn_edit_kpi = $("#btn-edit-kpi");
		var site_url = window.location.pathname;
		var arr = site_url.split("/");
        var id_risk_event = arr[arr.length - 1];

		$.ajax({
			url : "<?=site_url('RiskMonitoringController/getListRiskEvent')?>/" + document.getElementById("risk_detail").value + "/" + id_risk_event,
			type: "GET",
			dataType: "JSON",
			success: function(result)
			{
				var penampung = "";
				var count = result.length;
				var num = 1;
				for(i = 0; i < count; i++){
					penampung += `<table>
									<tr>
										<td width="15%">${num}.</td>
										<td width="50px%"><a class="badge rounded-pill bg-primary text-white"><b>R${result[i]['id_risk_event']}</b></a></td>
										<td width="59%">
											<a type="button" id="copy_${result[i]['id_risk_event']}" class="btn btn-xs btn-info" onclick="copy_evidence(${result[i]['id_risk_event']})">Copy Evidence</a>
											<a type="button" id="uncopy_${result[i]['id_risk_event']}" style="display:none;" class="btn btn-xs btn-success" onclick="uncopy_evidence(${result[i]['id_risk_event']})">Copied</a>
										</td>
									</tr>
								</table>`;
					num += 1;
				}
				
				document.getElementById("riskEventList").innerHTML = penampung;
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log(jqXHR);
				alert('Error get data from ajax');
			}
		});

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

	
</script>
