<?= $this->include('risk_owner/template/_partials/js')?>

<script>
	var table = $('#riskMitigationTable');

	$(document).ready(function() {
		var year = document.getElementById('year_selected').value;
		
		table = $('#riskMitigationTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			language: {
				emptyTable: "Belum ada Data Risiko.",
				zeroRecords: "Tidak ada Data Risiko ditemukan.",
			},
			'ajax': {
				'url': "<?=site_url('RiskMitigationController/getRiskMitigation')?>/" + year,
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
					data: 'kpi_name'
				},
				{
					data: 'id',
					render: function (data, type, item) {
						return 'R'+item.id
						
					},
				},
				{
					Title: 'Ranking Risiko Progress',
					data: 'risk_number_residual'
				},
				{
					data: 'risk_event'
				},
				{
					data: 'is_active',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
                                 '<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/'+item.id+'" class="btn btn-sm btn-icon btn-warning" title="" data-original-title="Edit" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</a>'+
                              '</div>'
						
					},
				},
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 2
                }
            ]
		});
	});

	function update_risk_table(){
        year_selected = document.getElementById('year_selected').value;

		if ( $.fn.dataTable.isDataTable('#riskMitigationTable') ) {
			$('#riskMitigationTable').DataTable().destroy();
			//$('#riskMitigationTable').empty();
		}
		
		$('#riskMitigationTable').DataTable({
			scrollX: 				true,
			scrollCollapse: true,
			scroller:       true,

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
				'url': "<?=site_url('RiskOwner/RiskMitigationController/getRiskMitigation/')?>" + year_selected,
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
					data: 'kpi_name'
				},
				{
					Title: 'No. Risiko',
					data: 'id',
					render: function (data, type, item) {
						return 'R'+item.id
						
					},
				},
				{
					Title: 'Ranking Risiko Progress',
					data: 'risk_number_residual'
				},
				{
					data: 'risk_event'
				},
				{
					data: 'is_active',
					render: function (data, type, item) {
						return '<div class="flex align-items-center list-user-action">'+
                                 '<a href="<?=base_url()?>/admin/detail-risk-mitigations/'+item.id+'" class="btn btn-sm btn-icon btn-warning" title="" data-original-title="Edit" href="#">'+
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                          '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                          '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'+
                                       '</svg>'+
                                 '</a>'+
                              '</div>'
						
					},
				},
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 2
                }
            ]
		});


		$('.toggle-vis').on( 'change', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = $('#riskMitigationTable').DataTable().column( $(this).attr('data-column') );
	
			// Toggle the visibility
			column.visible( ! column.visible() );
		});
    }

</script>
