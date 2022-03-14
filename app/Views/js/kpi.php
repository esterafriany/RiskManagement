<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		var $btn_add_kpi = $("#btn-add-kpi");
		var $btn_edit_kpi = $("#btn-edit-kpi");
		
		$('#kpiTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			language: {
				emptyTable: "Belum ada KPI.",
				zeroRecords: "Tidak ada Data KPI ditemukan.",
			},
			'ajax': {
				'url': "<?=site_url('KPIController/getKPI')?>",
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
					data: 'name'
				},
				{
					data:  'is_active',
					render: function (data, type, item) {
						if (item.is_active == "0") {
							return '<span class="badge bg-danger">Tidak Aktif</span>';
						} else if (item.is_active == "1") {
							return '<span class="badge bg-primary">Active</span>';
						} else {
							return '<span class="badge bg-info">-</span>';
						}
					},					
				},
				{
					data: 'is_active',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
                                 '<button class="btn btn-sm btn-icon btn-warning" onclick="edit_kpi('+item.id+')" title="" data-original-title="Edit" href="#">'+
                                    '<span class="btn-inner">'+
                                       '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                    '</span>'+
                                 '</button>&nbsp;'+
                                 '<button class="btn btn-sm btn-icon btn-danger" onclick="delete_kpi('+item.id+')" title="" data-original-title="Delete" href="#">'+
                                    '<span class="btn-inner">'+
                                       '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">'+
                                          '<path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                    '</span>'+
                                 '</button>'+
                              '</div>'
						
					},
				},
			]
		});
	
	// add kpi
    $btn_add_kpi.on("click", function (e) {
		var table = $('#kpiTable').DataTable();
        $.ajax({
				url : "<?php echo base_url('admin/KPIController/onAddKPI')?>",
				type: "POST",
				data: $('#form-add-kpi').serialize(),
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
					swal("Error","Gagal menambah data. Pastikan semua field terisi.","error");

				}
			});
		
		
		});
		

	// // edit kpi
    $btn_edit_kpi.on("click", function (e) {
		var table = $('#kpiTable').DataTable();
        $.ajax({
				url : "<?=site_url('KPIController/onEditKPI')?>/" + document.getElementById('id').value,
				type: "POST",
				data: $('#form-edit-kpi').serialize(),
				dataType: "JSON",

				success: function(response)
				{
					//if success close modal and reload ajax table
					//$('body').removeClass('modal-open');
					$('.modal-backdrop.show').css('opacity','0');
					$('.modal-backdrop').css('z-index','-1');
					$('#modal-add-group').modal("hide");
				   
					swal({
					  title: "Sukses!",
					  text: "Data sukses diubah!",
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
					swal("Error","Gagal mengubah data. Pastikan semua field terisi","error");
				}
			});
		});
	});
	
	function edit_kpi(id){
	
	  //Ajax Load data from ajax
	  $.ajax({
		url : "<?=site_url('KPIController/onDetailKPI')?>/" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="id"]').val(data.id);
			$('[name="name"]').val(data.name);
			$('[name="description"]').val(data.description);
			$('[name="is_active"]').val(data.is_active);
			$('[name="level"]').val(data.level);
			$('[name="year"]').val(data.year);
 
			$('#modal-edit-kpi').modal('show');
			$('.modal-title').text('Edit KPI'); 
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data Risk Category tidak ditemukan.');
		}
	  });
	}
	
	function delete_kpi(id){
		var table = $('#kpiTable').DataTable();
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
				url : "<?=site_url('KPIController/onDeleteKpi')?>/" + id,
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
</script>
