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
					console.log(data);
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
							return item.risk_mitigation;
						}else{
							return '';
						}
					},
				},
				{
					data: 'id',
					render: function (data, type, item) {
						if(item.id > 0){
							return '<a href="<?=base_url()?>/admin/detail-risk-monitoring/'+item.id+'" class="badge rounded-pill bg-primary text-white">'+item.id+'</a>';
						}else{
							return '';
						}
					},
				},
				{
					data: 'risk_mitigation_detail',
					render: function (data, type, item) {
						if(item.risk_mitigation_detail != ""){
							return item.risk_mitigation_detail;
						}else{
							return '';
						}
					},
				},
				{
					data: 'division_name'
				},
				{
					data: 'progress_percentage',
					render: function (data, type, item) {
						if(item.progress_percentage != ""){
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
                    targets: [0,1,3]
                }
            ]
		});
	});

	function update_risk_table(){
        year_selected = document.getElementById('year_selected').value;
        
		if ( $.fn.dataTable.isDataTable('#riskMonitoringTable') ) {
			$('#riskMonitoringTable').DataTable().destroy();
		}
		
		$('#riskMonitoringTable').DataTable({
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
				'url': "<?=site_url('RiskMonitoringController/getRiskMonitoring/')?>" + year_selected,
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
					data: 'risk_mitigation'
				},
				{
					data: 'id',
					render: function (data, type, item) {
						if(item.id > 0){
							return '<a href="" class="badge rounded-pill bg-primary text-white">'+item.id+'</a>';
						}else{
							return '';
						}
					},
				},
				{
					data: 'risk_mitigation_detail',
					render: function (data, type, item) {
						if(item.risk_mitigation_detail != ""){
							return item.risk_mitigation_detail;
						}else{
							return '';
						}
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
			var column = $('#riskMonitoringTable').DataTable().column( $(this).attr('data-column') );
	
			// Toggle the visibility
			column.visible( ! column.visible() );
		});
    }

</script>
