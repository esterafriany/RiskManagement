
<div class="container-fluid content-inner mt-n5 py-0">
	<div class="row">
      <div class="col-sm-12" style="padding-top:75px;">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Monitoring Mitigasi Risiko</h4>
               </div>
			</div>
            <div class="card-body">
            </div>
            <div class="card-footer">
               
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="submit" id="btn-add-detail-monitoring"  class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>
<?= $this->include('admin/template/_partials/js')?>

<?php if($flashdata == 'error'){ ?>
   <script>
 

    $(document).ready(function() {
       
      swal("Test","Tessss","error");
    });
    
</script>
<?php } ?>


