<?= $this->include('admin/template/_partials/js')?>

<script>
	var table = $('#riskEventTable');
	$(document).ready(function() {
		var $btn_add_risk_event = $("#btn-add-risk-event");
		var $btn_edit_risk_event = $("#btn-edit-risk-event");
		var year = document.getElementById('year_selected').value;
		
		table = $('#riskEventTable').DataTable({
			scrollX: 	true,
			scrollCollapse: true,
			scroller:       true,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			order: [[2, 'asc']],
			language: {
				emptyTable: "Belum ada Risiko Utama.",
				zeroRecords: "Tidak ada Data Risiko Utama ditemukan.",
			},
			'ajax': {
				'url': "<?=site_url('RiskEventController/getRiskEvent/')?>" + year,
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
			'columns': [
				{
					data: 'objective'
				},
				{
					data: 'kpi_name'
				},
				{
					data: 'risk_number_manual',
					render: function (data, type, item) {
						return 'R'+item.risk_number_manual;
					},
				},
				{
					data: 'risk_event'
				},
				
				{
					data: 'year'
				},
				{
					data: 'is_active',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
								'<a class="btn btn-sm btn-icon btn-warning" href="<?=base_url()?>/admin/detail-risk-event/'+item.id+'" title="" data-original-title="Edit" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</a>&nbsp;'+
                                 '<button class="btn btn-sm btn-icon btn-danger" onclick="delete_risk_event('+item.id+')" title="" data-original-title="Delete" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">'+
                                          '<path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</button>'+
                              '</div>'
						
					},
				},
			],
            columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [0,1,3]
                }
            ]
			
		});

		$('.toggle-vis').on( 'change', function (e) {
			e.preventDefault();
		 
			// Get the column API object
			var column = table.column( $(this).attr('data-column') );
	
			// Toggle the visibility
			column.visible( ! column.visible() );
		});
	
		// add risk event
		$btn_add_risk_event.on("click", function (e) {
		var table = $('#riskEventTable').DataTable();
        $.ajax({
				url : "<?php echo base_url('admin/RiskEventController/onAddRiskEvent')?>",
				type: "POST",
				data: $('#form-add-risk-event').serialize(),
				dataType: "JSON",

				success: function(response)
				{
					console.log(response);
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
					swal("Warning","Gagal menambah data. Pastikan semua field terisi.","warning");
				}
			});
		
		});

	});

	function delete_risk_event(id){
		var table = $('#riskEventTable').DataTable();
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
				url : "<?=site_url('RiskEventController/onDeleteRiskEvent')?>/" + id,
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
						table.ajax.reload(null, false);
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

	function change_level(){
		var final_level = document.getElementById("final_level");
		var probability_level = document.getElementById('probability_level').value;
		var impact_level = document.getElementById('impact_level').value;
		
		if(probability_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}
	}

	function change_level1(){
		var final_level = document.getElementById("final_level");
		var probability_level = document.getElementById('probability_level').value;
		var impact_level = document.getElementById('impact_level').value;
		
		if(impact_level.value != ""){
			final_level.value = parseInt(probability_level) * parseInt(impact_level);
		}

	}

	function update_risk_table(){
        year_selected = document.getElementById('year_selected').value;
		if ( $.fn.dataTable.isDataTable('#riskEventTable') ) {
			$('#riskEventTable').DataTable().destroy();
			$('#riskEventTable').empty();
		}
		
		//table = $('#riskEventTable').DataTable({
		$('#riskEventTable').DataTable({
			'fixedColumns': true,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			language: {
				emptyTable: "Belum ada Risiko Utama.",
				zeroRecords: "Tidak ada Data Risiko Utama ditemukan.",
			},
			'ajax': {
				'url': "<?=site_url('RiskEventController/getRiskEvent/')?>" + year_selected,
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
			'columns': [
				{
					title: "Sasaran",
					data: 'objective'
				},
				{
					title: "KPI",
					data: 'kpi_name'
				},
				{
					title: "Nomor Risiko",
					data: 'risk_number_manual',
					render: function (data, type, item) {
						return 'R'+item.risk_number_manual;
					},
					
				},
				{
					title: "Risiko Utama",
					data: 'risk_event'
				},
				
				{
					title: "Tahun",
					data: 'year'
				},
				{
					title: "Aksi",
					data: 'is_active',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
								'<a class="btn btn-sm btn-icon btn-warning" href="<?=base_url()?>/admin/detail-risk-event/'+item.id+'" title="" data-original-title="Edit" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</a>&nbsp;'+
                                 '<button class="btn btn-sm btn-icon btn-danger" onclick="delete_risk_event('+item.id+')" title="" data-original-title="Delete" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">'+
                                          '<path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</button>'+
                              '</div>'
						
					},
				},
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [0,1,3]
                }
            ]
		});


		$('.toggle-vis').on( 'change', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = $('#riskEventTable').DataTable().column( $(this).attr('data-column') );
			//var column = table.column( $(this).attr('data-column') );
			// Toggle the visibility
			column.visible( ! column.visible() );
		});
    }
	
</script>
