<?= $this->include('admin/template/_partials/js')?>

<script type="text/javascript">
	$(document).ready(function() {
        var year = document.getElementById('year').value;
        //set td id value
        
        $.ajax({
		url : "<?=site_url('DashboardController/onGetDataMatrix')?>/" + year,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
            var i = 0;
            for(i = 0; data.length ; i++){
                document.getElementById(data[i]['td_id']).innerHTML += `<a href="" class="badge rounded-pill bg-primary text-white">R${data[i]['id']}</a>` ;   
                             
            }
            
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data tidak ditemukan.');
		}
	  });
		
    });

    function update_matrix(){
        year = document.getElementById('year').value;
        
        $.ajax({
		url : "<?=site_url('DashboardController/onGetDataMatrix')?>/" + year,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
            
            $('#table tr>td').each(function() {
                $(this).find("#td").html("");
            });

            document.getElementById('11').innerHTML = "";
            var i = 0;
            for(i = 0; data.length ; i++){
				
                document.getElementById(data[i]['td_id']).innerHTML += `
                <a class="badge rounded-pill bg-primary text-white">R${data[i]['id']}</a>` ;         
            }
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data tidak ditemukan.');
		}
	  });
    }
  
</script>
