<?= $this->include('admin/template/_partials/js')?>

<script>
	var table = $('#riskMonitoringTable');
	$(document).ready(function() {
		var year = document.getElementById('year_selected').value;

		table = $('#riskMonitoringTable').DataTable({
			scrollX: 				true,
			paging: 				true,
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
				'url': "<?=site_url('RiskMonitoringController/getRiskMonitoring')?>/" + year,
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
					data: 'risk_event'
				},
				{
					data: 'risk_mitigation',
					render: function (data, type, item) {
						if(item.risk_mitigation != null){
							return "<div class='text-wrap width-200'>" + item.risk_mitigation + "</div>";
						}else{
							return '';
						}
					},
				},
				{
					data: 'risk_mitigation_detail',
					render: function (data, type, item) {
						if(item.risk_mitigation_detail != null){
							return '<a class="text-wrap width-200" href="<?=base_url()?>/admin/detail-risk-monitoring/'+item.id+'/'+item.id_risk_mitigation+'/'+item.id_risk_event+'">'+item.risk_mitigation_detail+'</a>';
						}else{
							return '-';
						}
					},
				},
				{
					data: 'division_name'
				},
				{
					data: 'progress_percentage',
					render: function (data, type, item) {
						if(item.progress_percentage != null){
							return item.progress_percentage + ' %';
						}else{
							return '-';
						}
					},
				}
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [0,1,2,3]
                }
            ]
		});
	});

	function update_risk_table(){
        year = document.getElementById('year_selected').value;
        
		if ( $.fn.dataTable.isDataTable('#riskMonitoringTable') ) {
			$('#riskMonitoringTable').DataTable().destroy();
		}
		
		$('#riskMonitoringTable').DataTable({
			scrollX: true,
			paging: true,
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
				'url': "<?=site_url('RiskMonitoringController/getRiskMonitoring')?>/" + year,
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
					console.log(data.aaData);
					// Datatable data
					return data.aaData;
				}
			},
			'columns': [
				{
					data: 'risk_event'
				},
				{
					data: 'risk_mitigation',
					render: function (data, type, item) {
						if(item.risk_mitigation != null){
							return "<div class='text-wrap width-200'>" + item.risk_mitigation + "</div>";
						}else{
							return '';
						}
					},
				},
				{
					data: 'risk_mitigation_detail',
					render: function (data, type, item) {
						if(item.risk_mitigation_detail != null){
							return '<a class="text-wrap width-200" href="<?=base_url()?>/admin/detail-risk-monitoring/'+item.id+'/'+item.id_risk_mitigation+'/'+item.id_risk_event+'">'+item.risk_mitigation_detail+'</a>';
						}else{
							return '-';
						}
					},
				},
				{
					data: 'division_name'
				},
				{
					data: 'progress_percentage',
					render: function (data, type, item) {
						if(item.progress_percentage != null){
							return item.progress_percentage + ' %';
						}else{
							return '-';
						}
					},
				}
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [0,1,2,3]
                }
            ]
		});

		$('.toggle-vis').on( 'change', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = $('#riskMonitoringTable').DataTable().column( $(this).attr('data-column') );
			//var column = table.column( $(this).attr('data-column') );
			// Toggle the visibility
			column.visible( ! column.visible() );
		});
    }

</script>
