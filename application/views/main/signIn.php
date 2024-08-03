<body class="d-flex flex-column">
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="card card-md">
        <div class="card-header">
          <a href="#" class="navbar-brand navbar-brand-autodark"><img src="./resource/icon.png" height="80" alt=""></a>
        </div>
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Login to your account</h2>
          <form id="login-form" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input name="inUsername" type="text" class="form-control" placeholder="Your username" autocomplete="on">
            </div>
            <div class="mb-2">
              <label class="form-label">Password</label>
              <input name="inPassword" type="password" class="form-control" placeholder="Your password"
                autocomplete="off">
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input" checked />
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#login-form").submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?php echo site_url("auth/login"); ?>",
        data: $(this).serialize(),
        dataType: "json",
        encode: true,
      }).done(function (data) {
        location.reload();
      });
    });
  </script>
</body>