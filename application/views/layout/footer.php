<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary"
                            rel="noopener">Documentation</a></li>
                    <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; 2023
                        <a href="#" class="link-secondary">PANNAWAT INTER GROUP CO., LTD</a>.
                        All rights reserved.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?php echo base_url();?>/tabler/js/tabler.min.js?1684106062" defer></script>
<script>
    $("#menu-logout").click(function (e) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("auth/logout"); ?>",
        }).done(function (data) {
            location.reload();
        });
    });
</script>
</body>

</html>