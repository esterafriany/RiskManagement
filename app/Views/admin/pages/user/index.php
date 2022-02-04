<div class="conatiner-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data User</h4>
               </div>
            </div>
            <div class="card-body">
				<p class="mb-0">
					<svg class ="me-2 text-primary" width="24" height="24" viewBox="0 0 24 24">
					   <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
					</svg>
					Daftar User
				 </p>
				 <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalDefault">
				 </button>
				 <div class="modal fade" id="exampleModalDefault" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
				 <div class="table-responsive" >
				 <table id="uTable" class="table table-striped">
				 <thead>
					<tr>
					   <th>Nama User</th>
					   <th>Email</th>
					   <th>Group</th>
					   <th>Status</th>
					   <th>Aksi</th>
					
					</tr>
				 </thead>
				 
				 </table>
				 
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Library Bundle Script -->
<script src="../assets/js/core/libs.min.js"></script>

<!-- External Library Bundle Script -->
<script src="../assets/js/core/external.min.js"></script>

<!-- Widgetchart Script -->
<script src="../assets/js/charts/widgetcharts.js"></script>

<!-- mapchart Script -->
<script src="../assets/js/charts/vectore-chart.js"></script>
<script src="../assets/js/charts/dashboard.js" ></script>

<!-- fslightbox Script -->
<script src="../assets/js/plugins/fslightbox.js"></script>

<!-- Settings Script -->
<script src="../assets/js/plugins/setting.js"></script>

<!-- Form Wizard Script -->
<script src="../assets/js/plugins/form-wizard.js"></script>

<!-- AOS Animation Plugin-->
<script src="../assets/vendor/aos/dist/aos.js"></script>

<!-- App Script -->
<script src="../assets/js/hope-ui.js" defer></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#uTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			lengthMenu: [5, 10, 20, 50, 100],
			"iDisplayLength": 5,
			language: {
				emptyTable: "Belum ada Data User.",
				zeroRecords: "Tidak ada Data User ditemukan.",
			},
			'ajax': {
				'url': "<?=site_url('UserController/getUsers')?>",
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
					data: 'user_name'
				},
				{
					data: 'email'
				},
				{
					data: 'group_name'
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
						return '<a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><span class="btn-inner"><svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"><path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>'
						
					},
				},
			]
		});
	});
</script>

