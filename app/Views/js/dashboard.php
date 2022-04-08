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
                    //risk map before mitigation
                    document.getElementById(data[i]['td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data[i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data[i]['id']}</b></a>` ;             
                
                    //risk map after mitigation
                    document.getElementById("target_"+ data[i]['target_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data[i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data[i]['id']}</b></a>` ;             

                    //risk map progress mitigation
                    if(data[i]['risk_number_residual'] != 0){
                        document.getElementById("residual_"+ data[i]['residual_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data[i]['id']}" class="badge rounded-pill bg-primary text-white"><b> R${data[i]['id']}</b></a>` ;             
                    }
                    
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Data tidak ditemukan.');
            }
	    });

        // $.ajax({
        //     url : "<?=site_url('DashboardController/onGetDataMatrixProgress')?>/" + year,
        //     type: "GET",
        //     dataType: "JSON",
        //     success: function(data)
        //     {
        //         var i = 0;
        //         for(i = 0; data.length ; i++){
                   
        //             //risk map progress mitigation
        //             document.getElementById("residual_"+ data[i]['td_id']).innerHTML += `<a href="" class="badge rounded-pill bg-primary text-white">R${data[i]['risk_number']}</a>` ;             

        //         }
        //     },
        //     error: function (jqXHR, textStatus, errorThrown)
        //     {
        //         swal('Data tidak ditemukan.');
        //     }
	    // });
		
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

            document.getElementById('15').innerHTML = "";
            document.getElementById('25').innerHTML = "";
            document.getElementById('35').innerHTML = "";
            document.getElementById('45').innerHTML = "";
            document.getElementById('55').innerHTML = "";
			
            document.getElementById('14').innerHTML = "";
            document.getElementById('24').innerHTML = "";
            document.getElementById('34').innerHTML = "";
            document.getElementById('44').innerHTML = "";
            document.getElementById('54').innerHTML = "";

			
            document.getElementById('13').innerHTML = "";
            document.getElementById('23').innerHTML = "";
            document.getElementById('33').innerHTML = "";
            document.getElementById('43').innerHTML = "";
            document.getElementById('53').innerHTML = "";

			
            document.getElementById('12').innerHTML = "";
            document.getElementById('22').innerHTML = "";
            document.getElementById('32').innerHTML = "";
            document.getElementById('42').innerHTML = "";
            document.getElementById('52').innerHTML = "";

			
            document.getElementById('11').innerHTML = "";
            document.getElementById('21').innerHTML = "";
            document.getElementById('31').innerHTML = "";
            document.getElementById('41').innerHTML = "";
            document.getElementById('51').innerHTML = "";
            var i = 0;
            for(i = 0; data.length ; i++){
				
                document.getElementById(data[i]['td_id']).innerHTML += `
                <a class="badge rounded-pill bg-primary text-white">R${data[i]['risk_number']}</a>` ;         
            }
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data tidak ditemukan.');
		}
	  });
    }
  
</script>
