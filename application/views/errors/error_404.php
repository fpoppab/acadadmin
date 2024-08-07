<?php $this->load->view("layout/meta"); ?>

<body data-bs-theme="<?php echo $this->session->userdata("userTheme"); ?>">
    <!-- <script src="./tabler/js/demo-theme.min.js?1684106062"></script> -->
    <div class="page">
        <div class="page-wrapper">

            <div class="empty">
                <div class="empty-header">404</div>
                <p class="empty-title">Oops… You just found an error page</p>
                <p class="empty-subtitle text-secondary">
                    We are sorry but the page you are looking for was not found
                </p>
                <div class="empty-action">
                    <a href="./." class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        Take me home
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>