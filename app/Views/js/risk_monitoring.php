<?= $this->include('admin/template/_partials/js')?>

<script>
	$(document).ready(function() {
		
		$('#riskMonitoringTable').DataTable({
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
				'url': "<?=site_url('RiskMonitoringController/getRiskMonitoring')?>",
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
					data: 'risk_event'
				},
				{
					data: 'risk_mitigation'
				},
				{
					data: 'id'
				},
				{
					data: 'risk_mitigation_detail'
				},
				
			]
		});
	});

</script>
