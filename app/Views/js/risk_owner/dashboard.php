<?= $this->include('admin/template/_partials/js')?>

<script type="text/javascript">

    var division_id;
	$(document).ready(function() {
        var year = document.getElementById('year').value;
        var id_division = document.getElementById('id_division').value;
        division_id = id_division;
        $.ajax({
            url : "<?=site_url('RiskOwner/DashboardController/onGetDataMatrixRiskOwner')?>/" + year + "/" + id_division,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                var count1 = data['all_data_matrix'].length;
				var count2 = data['data_matrix_risk_owner'].length;

                var myarray = [];
                for(j = 0; j < count2 ; j++){
                    myarray.push(data['data_matrix_risk_owner'][j]['id']);
                }
        
                var i = 0;
                for(i = 0; i < count1 ; i++){
                    if(jQuery.inArray(data['all_data_matrix'][i]['id'], myarray) !== -1){
                        //in array
                        //risk map before mitigation
                        document.getElementById(data['all_data_matrix'][i]['td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        
                        //risk map after mitigation
                        document.getElementById("target_"+ data['all_data_matrix'][i]['target_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             

                        //risk map progress mitigation
                        if(data['all_data_matrix'][i]['final_level_residual'] != 0){
                            document.getElementById("residual_"+ data['all_data_matrix'][i]['residual_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        }
                    }else{
                        //not in array
                        //risk map before mitigation
                        document.getElementById(data['all_data_matrix'][i]['td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        
                        //risk map after mitigation
                        document.getElementById("target_"+ data['all_data_matrix'][i]['target_td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             

                        //risk map progress mitigation
                        if(data['all_data_matrix'][i]['final_level_residual'] != 0){
                            document.getElementById("residual_"+ data['all_data_matrix'][i]['residual_td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        }
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

    function show_alert(){
        swal("Warning","Risiko ini tidak dialokasikan pada Divisi Anda. Silahkan pilih risiko lain.","warning");
    }

    function update_matrix(){
        year = document.getElementById('year').value;
        
        $.ajax({
		// url : "<?=site_url('DashboardController/onGetDataMatrix')?>/" + year,
        url : "<?=site_url('RiskOwner/DashboardController/onGetDataMatrixRiskOwner')?>/" + year + "/" + division_id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
            $('#table tr>td').each(function() {
                $(this).find("#td").html("");
            });

            //inherent
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

            //progress
            document.getElementById('residual_15').innerHTML = "";
            document.getElementById('residual_25').innerHTML = "";
            document.getElementById('residual_35').innerHTML = "";
            document.getElementById('residual_45').innerHTML = "";
            document.getElementById('residual_55').innerHTML = "";
            document.getElementById('residual_14').innerHTML = "";
            document.getElementById('residual_24').innerHTML = "";
            document.getElementById('residual_34').innerHTML = "";
            document.getElementById('residual_44').innerHTML = "";
            document.getElementById('residual_54').innerHTML = "";
            document.getElementById('residual_13').innerHTML = "";
            document.getElementById('residual_23').innerHTML = "";
            document.getElementById('residual_33').innerHTML = "";
            document.getElementById('residual_43').innerHTML = "";
            document.getElementById('residual_53').innerHTML = "";
            document.getElementById('residual_12').innerHTML = "";
            document.getElementById('residual_22').innerHTML = "";
            document.getElementById('residual_32').innerHTML = "";
            document.getElementById('residual_42').innerHTML = "";
            document.getElementById('residual_52').innerHTML = "";
            document.getElementById('residual_11').innerHTML = "";
            document.getElementById('residual_21').innerHTML = "";
            document.getElementById('residual_31').innerHTML = "";
            document.getElementById('residual_41').innerHTML = "";
            document.getElementById('residual_51').innerHTML = "";

            //residual
            document.getElementById('target_15').innerHTML = "";
            document.getElementById('target_25').innerHTML = "";
            document.getElementById('target_35').innerHTML = "";
            document.getElementById('target_45').innerHTML = "";
            document.getElementById('target_55').innerHTML = "";
            document.getElementById('target_14').innerHTML = "";
            document.getElementById('target_24').innerHTML = "";
            document.getElementById('target_34').innerHTML = "";
            document.getElementById('target_44').innerHTML = "";
            document.getElementById('target_54').innerHTML = "";
            document.getElementById('target_13').innerHTML = "";
            document.getElementById('target_23').innerHTML = "";
            document.getElementById('target_33').innerHTML = "";
            document.getElementById('target_43').innerHTML = "";
            document.getElementById('target_53').innerHTML = "";
            document.getElementById('target_12').innerHTML = "";
            document.getElementById('target_22').innerHTML = "";
            document.getElementById('target_32').innerHTML = "";
            document.getElementById('target_42').innerHTML = "";
            document.getElementById('target_52').innerHTML = "";
            document.getElementById('target_11').innerHTML = "";
            document.getElementById('target_21').innerHTML = "";
            document.getElementById('target_31').innerHTML = "";
            document.getElementById('target_41').innerHTML = "";
            document.getElementById('target_51').innerHTML = "";
            // var i = 0;
            // for(i = 0; data.length ; i++){
				
            //     document.getElementById(data[i]['td_id']).innerHTML += `
            //     <a class="badge rounded-pill bg-primary text-white">R${data[i]['risk_number_manual']}</a>` ;         
                
            //     if(data[i]['residual_td_id'] != '00'){
            //         document.getElementById('residual_'+ data[i]['residual_td_id']).innerHTML += `<a class="badge rounded-pill bg-primary text-white">R${data[i]['risk_number_manual']}</a>` ;  
            //     }

            //     document.getElementById('target_' + data[i]['target_td_id']).innerHTML += `<a class="badge rounded-pill bg-primary text-white">R${data[i]['risk_number_manual']}</a>` ;  
            // }


            var count1 = data['all_data_matrix'].length;
				var count2 = data['data_matrix_risk_owner'].length;

                var myarray = [];
                for(j = 0; j < count2 ; j++){
                    myarray.push(data['data_matrix_risk_owner'][j]['id']);
                }

                var i = 0;
                for(i = 0; i < count1 ; i++){
                    if(jQuery.inArray(data['all_data_matrix'][i]['id'], myarray) !== -1){
                        //in array
                        //risk map before mitigation
                        document.getElementById(data['all_data_matrix'][i]['td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        
                        //risk map after mitigation
                        document.getElementById("target_"+ data['all_data_matrix'][i]['target_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             

                        //risk map progress mitigation
                        if(data['all_data_matrix'][i]['final_level_residual'] != 0){
                            document.getElementById("residual_"+ data['all_data_matrix'][i]['residual_td_id']).innerHTML += `<a href="<?=base_url()?>/risk_owner/get-detail-risk-mitigation/${data['all_data_matrix'][i]['id']}" class="badge rounded-pill bg-primary text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        }
                    }else{
                        //not in array
                        //risk map before mitigation
                        document.getElementById(data['all_data_matrix'][i]['td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        
                        //risk map after mitigation
                        document.getElementById("target_"+ data['all_data_matrix'][i]['target_td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             

                        //risk map progress mitigation
                        if(data['all_data_matrix'][i]['final_level_residual'] != 0){
                            document.getElementById("residual_"+ data['all_data_matrix'][i]['residual_td_id']).innerHTML += `<a onClick="show_alert()" class="badge rounded-pill bg-danger text-white"><b>R${data['all_data_matrix'][i]['risk_number_manual']}</b></a>` ;             
                        }
                    }
                    
                }
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Data tidak ditemukan.');
		}
	  });
    }
  
</script>
