<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		
		var $btn_add_risk_detail = $("#btn-add-detail-mitigation");
		var $btn_edit_risk_event = $("#btn-edit-detail_mitigation");

		var site_url = window.location.pathname;
        var arr = site_url.split("/");
        var id_risk_mitigation = arr[arr.length - 1];
		let y = 0;
		
		$('#riskDetailMitigationTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			language: {
				emptyTable: "Belum ada Detail Mitigasi.",
				zeroRecords: "Tidak ada Detail Mitigasi.",
			},
			'ajax': {
				'url': "<?=site_url('RiskMitigationController/getDetailMitigation')?>/"+id_risk_mitigation,
				'data': function(data) {
					
					// CSRF Hash
					var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
					var csrfHash = $('.txt_csrfname').val(); // CSRF hash

					return {
						data: data,
						[csrfName]: csrfHash // CSRF Token
					};
				},
				dataSrc: function(data) {
					// Update token hash
					$('.txt_csrfname').val(data.token);

					// Datatable data
					return data.aaData;
				}
			},
			'columns': [{
					data: 'risk_mitigation_detail'
				},
				{
					data: 'id',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
                                 '<button class="btn btn-sm btn-icon btn-warning" onclick="edit_detail_risk_mitigation('+item.id+')" title="" data-original-title="Edit" href="#">'+
                                    '<span class="btn-inner">'+
                                       '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                    '</span>'+
                                 '</button>'+
                              '</div>'
						
					},					
				},
				
			]
		});
		
		// add detail mitigasi
	$btn_add_risk_detail.on("click", function (e) {
		var table = $('#riskDetailMitigationTable').DataTable();
        $.ajax({
				url : "<?php echo base_url('admin/RiskMitigationController/onAddDetailMitigation')?>",
				type: "POST",
				data: $('#form-add-detail-mitigation').serialize(),
				dataType: "JSON",

				success: function(response)
				{
					console.log(response);
					//if success close modal and reload ajax table
					//$('body').removeClass('modal-open');
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
						table.ajax.reload(null, false);
					  }
					});
				  
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal("Gagal",errorThrown,"error");
				}
			});
		
		
		});
		

	});

	function edit_detail_risk_mitigation(id){
		alert('a');
	  $.ajax({
		url : "<?=site_url('RiskMitigationController/onDetailMitigation')?>/" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="id"]').val(data.id);
			$('[name="risk_mitigation_detail"]').val(data.risk_mitigation_detail);
 
			$('#modal-edit-detail_mitigation').modal('show');
			$('.modal-title').text('Edit Detail Mitigasi'); 
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data Risk Category tidak ditemukan.');
		}
	  });
	}
	

</script>


