<?= $this->include('admin/template/_partials/js')?>

<script>
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

		// edit
		$btn_edit_detail_monitoring.on("click", function (e) {
						
			//output
			var input = document.getElementsByName('output[]');
			var output = [];
			for (var i = 0; i < input.length; i++) {
                var a = input[i];
				output[i] = a.value;		
            }

			//evidence
			//var inputt = document.getElementsByName('evidence[]');
			var input1 = document.getElementById("myFiles").files;
			var totalfiles = document.getElementById('myFiles').files.length;
			var evidence = [];
			// var evidences = [];
			// var file={}
			// for (var i = 0; i < input1.length; i++) {
            //     var a = input1[i];
				
			// 	file.toJSON = {
			// 		'lastMod'    : input1[i].lastModified,
			// 		'lastModDate': input1[i].lastModifiedDate,
			// 		'name'       : input1[i].name,
			// 		'size'       : input1[i].size,
			// 		'type'       : input1[i].type,
			// 	} 

			// 	evidences.push(file);
            // }

			// for (var i = 0; i < inputt.length; i++) {
			// 	var a = inputt[i];
				
			// 	evidence[i] = a.value;
			// }

			if(totalfiles > 0 ){
				var formData = new FormData();

				// Read selected files
				for (var index = 0; index < totalfiles; index++) {
					formData.append("myFiles[]", document.getElementById('myFiles').files[index]);
				}

				var xhttp = new XMLHttpRequest();

				// Set POST method and ajax file path
				xhttp.open("POST", "<?php echo base_url('admin/RiskMonitoringController/onAddDetailMonitoring')?>", true);

				// call on request changes state
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {

						var response = this.responseText;

						console.log(response + " File uploaded.");

					}
				};

				// Send request with data
				xhttp.send(formData);

				}else{
				alert("Please select a file");
				}
			

		});
		
	});
	

</script>


