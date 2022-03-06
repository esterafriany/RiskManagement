
<!doctype html>
<html lang="en" dir="ltr">
  <head>
      <?= $this->include('risk_owner/template/_partials/head')?>
  </head>
  <body class="  ">
  <?= $this->include('risk_owner/template/_partials/loader')?>
    
    <aside class="sidebar sidebar-default navs-rounded-all ">
    <?= $this->include('risk_owner/template/_partials/aside')?>
    </aside>
    <main class="main-content">
      <div class="position-relative">
      <?= $this->include('risk_owner/template/_partials/navbar')?>
        <?= $this->include('risk_owner/template/_partials/content')?>
      <?= $this->include('risk_owner/template/_partials/footer')?>
    </main>
    <?= $this->include('risk_owner/template/_partials/button-setting')?>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" data-bs-scroll="true" data-bs-backdrop="true" aria-labelledby="offcanvasExampleLabel">
    <?= $this->include('risk_owner/template/_partials/offcanvas')?>
    
    </div>
  </body>
</html>