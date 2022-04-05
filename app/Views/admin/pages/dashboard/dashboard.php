<div class="iq-navbar-header" style="height: 215px;">
   <div class="container-fluid iq-container">
      <div class="row">
            <div class="col-md-12">
               <div class="flex-wrap d-flex justify-content-between align-items-center">
                  <div>
                        <h1>Hello, <?=session()->get('name')?>!</h1>
                        <p>Welcome to Risk Register Apps !</p>
                  </div>
               </div>
            </div>
      </div>
   </div>
      <div class="iq-header-img">
         <img src="../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
         <img src="../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
         <img src="../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
         <img src="../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
         <img src="../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
         <img src="../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
      </div>
   </div>          <!-- Nav Header Component End -->
<!--Nav End-->
</div>
<div class="conatiner-fluid content-inner mt-n5 py-0">
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="row row-cols-1">
         <div class="overflow-hidden d-slider1 ">
            <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                           <svg class="card-slie-arrow" width="24" height="24px" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                           </svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Total Kategori Risiko</p>
                           <h4 class="counter"><?=$total_risk_category?></h4>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                           <svg class="card-slie-arrow" width="24" height="24px" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                           </svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Total Divisi</p>
                           <h4 class="counter"><?=$total_division?></h4>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                           <svg class="card-slie-arrow" width="24" height="24px" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                           </svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Total KPI</p>
                           <h4 class="counter"><?=$total_kpi?></h4>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
         </div>
      </div>
   </div>

   <div class="col-md-12 col-lg-12">
      <div class="row row-cols-1">
         <div class="overflow-hidden d-slider1 ">
            <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
               <div class="card">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div>
                           <span><b>Perum PPD</b></span>
                           <div class="mt-2">
                           <h2 class="counter"><?= number_format((float)$progress_percentage_corporate->percentage_progress, 2, '.', '');?>%</h2>
                              
                           </div>
                        </div>
                        <div>
                           <span class="badge bg-warning">
                              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="m479.66 268.7l-32-151.81C441.48 83.77 417.68 64 384 64H128c-16.8 0-31 4.69-42.1 13.94s-18.37 22.31-21.58 38.89l-32 151.87A16.65 16.65 0 0 0 32 272v112a64 64 0 0 0 64 64h320a64 64 0 0 0 64-64V272a16.65 16.65 0 0 0-.34-3.3Zm-384-145.4v-.28c3.55-18.43 13.81-27 32.29-27H384c18.61 0 28.87 8.55 32.27 26.91c0 .13.05.26.07.39l26.93 127.88a4 4 0 0 1-3.92 4.82H320a15.92 15.92 0 0 0-16 15.82a48 48 0 1 1-96 0A15.92 15.92 0 0 0 192 256H72.65a4 4 0 0 1-3.92-4.82Z"/><path fill="currentColor" d="M368 160H144a16 16 0 0 1 0-32h224a16 16 0 0 1 0 32Zm16 64H128a16 16 0 0 1 0-32h256a16 16 0 0 1 0 32Z"/></svg>
                           </span>
                        </div>
                     </div>
                     
                     <div class="mt-3">
                        <div class="progress bg-soft-warning shadow-none w-100" style="height: 6px">
                           <div class="progress-bar bg-warning" data-toggle="progress-bar" role="progressbar" aria-valuenow="<?=$progress_percentage_corporate->percentage_progress?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </div>
               </div>
               </li>

               <?php foreach($progress_percentage as $progress){ ?>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">         
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <div>
                                 <span><b><?=$progress['name']?></b></span>
                                 <div class="mt-2">
                                    <h2 class="counter"><?= number_format((float)$progress['percentage_progress'], 2, '.', '');?>%</h2>
                                 </div>
                              </div>
                              <div>
                                 <span class="badge bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="m479.66 268.7l-32-151.81C441.48 83.77 417.68 64 384 64H128c-16.8 0-31 4.69-42.1 13.94s-18.37 22.31-21.58 38.89l-32 151.87A16.65 16.65 0 0 0 32 272v112a64 64 0 0 0 64 64h320a64 64 0 0 0 64-64V272a16.65 16.65 0 0 0-.34-3.3Zm-384-145.4v-.28c3.55-18.43 13.81-27 32.29-27H384c18.61 0 28.87 8.55 32.27 26.91c0 .13.05.26.07.39l26.93 127.88a4 4 0 0 1-3.92 4.82H320a15.92 15.92 0 0 0-16 15.82a48 48 0 1 1-96 0A15.92 15.92 0 0 0 192 256H72.65a4 4 0 0 1-3.92-4.82Z"/><path fill="currentColor" d="M368 160H144a16 16 0 0 1 0-32h224a16 16 0 0 1 0 32Zm16 64H128a16 16 0 0 1 0-32h256a16 16 0 0 1 0 32Z"/></svg>
                                 </span>
                              </div>
                           </div>
                           <div class="mt-3">
                              <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                 <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="<?=$progress['percentage_progress']?>" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  </li>
               <?php } ?>
           
            </ul>
         </div>
      </div>
   </div>
     
   <div class="col-md-12 col-lg-12">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="mb-2 card-title">Risk Map Sebelum Mitigasi - Inherent</h4>    
                  </div>
                  
                  <div class="dropdown"> 
                     <select class="form-control" id="year" name="year" onchange="update_matrix()">
                        <option value="2021">2021</option>
                        <option value="2022" selected>2022</option>
                     </select>
                  </div>
               </div>
               <div class="p-0 card-body">
               </br>
               
                  <div class="bd-example table-responsive" style="padding-right:20px;">
                  
                     <table id="table" name="table" width="100%" class="table table-sm" style="border-collapse: inherit;text-align:center;font-size: small;" onload="insertContent();">
                           <tr>
                              <td rowspan="6" width="5%" style="writing-mode: vertical-rl;">Tingkat Kemungkinan</td>
                              <td width="10%">Sangat Besar<br/>(5)</td>
                              <td id="15" name="td" style="background-color:#f6e65a;" width="17%"></td>
                              <td id="25" name="td" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="35" name="td" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="45" name="td" style="background-color:#ff1e00;" width="17%"></td>
                              <td id="55" name="td" style="background-color:#ff1e00;" width="17%"></td>
                           </tr>
                           <tr>
                              <td>Besar<br/>(4)</td>
                              <td id="14" name="td" style="background-color:#5ce878;"></td>
                              <td id="24" name="td" style="background-color:#f6e65a;"></td>
                              <td id="34" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="44" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="54" name="td" style="background-color:#ff1e00;"></td>
                           </tr>
                           <tr>
                              <td>Sedang<br/>(3)</td>
                              <td id="13" name="td" style="background-color:#5ce878;"></td>
                              <td id="23" name="td" style="background-color:#f6e65a;"></td>
                              <td id="33" name="td" style="background-color:#f6e65a;"></td>
                              <td id="43" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="53" name="td" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Kecil<br/>(2)</td>
                              <td id="12" name="td" style="background-color:#5ce878;"></td>
                              <td id="22" name="td" style="background-color:#5ce878;"></td>
                              <td id="32" name="td" style="background-color:#f6e65a;"></td>
                              <td id="42" name="td" style="background-color:#f6e65a;"></td>
                              <td id="52" name="td" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Sangat Kecil<br/>(1)</td>
                              <td id="11" name="td" style="background-color:#5ce878;"></td>
                              <td id="21" name="td" style="background-color:#5ce878;"></td>
                              <td id="31" name="td" style="background-color:#5ce878;"></td>
                              <td id="41" name="td" style="background-color:#5ce878;"></td>
                              <td id="51" name="td" style="background-color:#f6e65a;"></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td>Tidak<br/>Signifikan<br/>(1)</td>
                              <td>Minor<br/>(2)</td>
                              <td>Medium<br/>(3)</td>
                              <td>Signifikan<br/>(4)</td>
                              <td>Sangat<br/>Signifikan<br/>(5)</td>
                           </tr>
                           <tr>
                              <td ></td>
                              <td ></td>
                              <td colspan="5">Tingkat Dampak</td>
                           </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <div class="col-md-12 col-lg-12">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="mb-2 card-title">Risk Map Progress Mitigasi</h4>    
                  </div>
                  
               </div>
               <div class="p-0 card-body">
               </br>
               
                  <div class="bd-example table-responsive" style="padding-right:20px;">
                  
                     <table id="table" name="table" width="100%" class="table table-sm" style="border-collapse: inherit;text-align:center;font-size: small;" onload="insertContent();">
                           <tr>
                              <td rowspan="6" width="5%" style="writing-mode: vertical-rl;">Tingkat Kemungkinan</td>
                              <td width="10%">Sangat Besar<br/>(5)</td>
                              <td id="residual_15" name="residual_15" style="background-color:#f6e65a;" width="17%"></td>
                              <td id="residual_25" name="residual_25" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="residual_35" name="residual_35" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="residual_45" name="residual_45" style="background-color:#ff1e00;" width="17%"></td>
                              <td id="residual_55" name="residual_55" style="background-color:#ff1e00;" width="17%"></td>
                           </tr>
                           <tr>
                              <td>Besar<br/>(4)</td>
                              <td id="residual_14" name="residual_14" style="background-color:#5ce878;"></td>
                              <td id="residual_24" name="residual_24" style="background-color:#f6e65a;"></td>
                              <td id="residual_34" name="residual_34" style="background-color:#ecd4e0;"></td>
                              <td id="residual_44" name="residual_44" style="background-color:#ecd4e0;"></td>
                              <td id="residual_54" name="residual_54" style="background-color:#ff1e00;"></td>
                           </tr>
                           <tr>
                              <td>Sedang<br/>(3)</td>
                              <td id="residual_13" name="residual_13" style="background-color:#5ce878;"></td>
                              <td id="residual_23" name="residual_23" style="background-color:#f6e65a;"></td>
                              <td id="residual_33" name="residual_33" style="background-color:#f6e65a;"></td>
                              <td id="residual_43" name="residual_43" style="background-color:#ecd4e0;"></td>
                              <td id="residual_53" name="residual_53" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Kecil<br/>(2)</td>
                              <td id="residual_12" name="residual_12" style="background-color:#5ce878;"></td>
                              <td id="residual_22" name="residual_22" style="background-color:#5ce878;"></td>
                              <td id="residual_32" name="residual_32" style="background-color:#f6e65a;"></td>
                              <td id="residual_42" name="residual_42" style="background-color:#f6e65a;"></td>
                              <td id="residual_52" name="residual_52" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Sangat Kecil<br/>(1)</td>
                              <td id="residual_11" name="residual_11" style="background-color:#5ce878;"></td>
                              <td id="residual_21" name="residual_21" style="background-color:#5ce878;"></td>
                              <td id="residual_31" name="residual_31" style="background-color:#5ce878;"></td>
                              <td id="residual_41" name="residual_41" style="background-color:#5ce878;"></td>
                              <td id="residual_51" name="residual_51" style="background-color:#f6e65a;"></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td>Tidak<br/>Signifikan<br/>(1)</td>
                              <td>Minor<br/>(2)</td>
                              <td>Medium<br/>(3)</td>
                              <td>Signifikan<br/>(4)</td>
                              <td>Sangat<br/>Signifikan<br/>(5)</td>
                           </tr>
                           <tr>
                              <td ></td>
                              <td ></td>
                              <td colspan="5">Tingkat Dampak</td>
                           </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-12 col-lg-12">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="mb-2 card-title">Risk Map Setelah Mitigasi - Residual Risk</h4>    
                  </div>
                  
               </div>
               <div class="p-0 card-body">
               </br>
               
                  <div class="bd-example table-responsive" style="padding-right:20px;">
                  
                     <table id="table" name="table" width="100%" class="table table-sm" style="border-collapse: inherit;text-align:center;font-size: small;" onload="insertContent();">
                           <tr>
                              <td rowspan="6" width="5%" style="writing-mode: vertical-rl;">Tingkat Kemungkinan</td>
                              <td width="10%">Sangat Besar<br/>(5)</td>
                              <td id="target_15" name="td" style="background-color:#f6e65a;" width="17%"></td>
                              <td id="target_25" name="td" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="target_35" name="td" style="background-color:#ecd4e0;" width="17%"></td>
                              <td id="target_45" name="td" style="background-color:#ff1e00;" width="17%"></td>
                              <td id="target_55" name="td" style="background-color:#ff1e00;" width="17%"></td>
                           </tr>
                           <tr>
                              <td>Besar<br/>(4)</td>
                              <td id="target_14" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_24" name="td" style="background-color:#f6e65a;"></td>
                              <td id="target_34" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="target_44" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="target_54" name="td" style="background-color:#ff1e00;"></td>
                           </tr>
                           <tr>
                              <td>Sedang<br/>(3)</td>
                              <td id="target_13" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_23" name="td" style="background-color:#f6e65a;"></td>
                              <td id="target_33" name="td" style="background-color:#f6e65a;"></td>
                              <td id="target_43" name="td" style="background-color:#ecd4e0;"></td>
                              <td id="target_53" name="td" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Kecil<br/>(2)</td>
                              <td id="target_12" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_22" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_32" name="td" style="background-color:#f6e65a;"></td>
                              <td id="target_42" name="td" style="background-color:#f6e65a;"></td>
                              <td id="target_52" name="td" style="background-color:#ecd4e0;"></td>
                           </tr>
                           <tr>
                              <td>Sangat Kecil<br/>(1)</td>
                              <td id="target_11" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_21" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_31" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_41" name="td" style="background-color:#5ce878;"></td>
                              <td id="target_51" name="td" style="background-color:#f6e65a;"></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td>Tidak<br/>Signifikan<br/>(1)</td>
                              <td>Minor<br/>(2)</td>
                              <td>Medium<br/>(3)</td>
                              <td>Signifikan<br/>(4)</td>
                              <td>Sangat<br/>Signifikan<br/>(5)</td>
                           </tr>
                           <tr>
                              <td ></td>
                              <td ></td>
                              <td colspan="5">Tingkat Dampak</td>
                           </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
</div>
<style>
   .table tbody tr td{
      height:100%;
      white-space:normal;
      width:200px;
   }

   .text-wrap{
      white-space:normal;
   }
   .width-200{
      width:200px;
   }
</style>

<?= $this->include("js/dashboard")?>
