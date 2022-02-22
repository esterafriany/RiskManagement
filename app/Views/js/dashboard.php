<?= $this->include('admin/template/_partials/js')?>

<script type="text/javascript">
	$(document).ready(function() {

        //set td id value
        $.ajax({
		url : "<?=site_url('DashboardController/onGetDataMatrix')?>",
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
            var i = 0;
            for(i = 0; data.length ; i++){
                document.getElementById(data[i]['td_id']).innerHTML += `<div class="iq-media-group iq-media-group-1"><a href="#" class="iq-media-1">
                               <div class="icon iq-icon-box-3 rounded-pill"
                               style="    height: 1.5rem;
                                width: 1.5rem;
                                min-width: 1.5rem;
                                line-height: 1.2rem;
                                font-size: 0.6rem;
                                position: absolute;">R${data[i]['id']}</div>
                            </a></div>` ;   
                             
            }
            
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data tidak ditemukan.');
		}
	  });
		
    });

  
</script>
