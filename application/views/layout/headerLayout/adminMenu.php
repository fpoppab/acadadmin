<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-home-cog"></i>
        </span>
        <span class="nav-link-title">
            Setting
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("School", "school"); ?>
                <div class="dropend">
                    <?php menu_a("Permission", "users"); ?>
                    <?php menu_a("Room and Homeroom", "room"); ?>
                    <?php menu_a("Subject teacher", "subject-teacher"); ?>
                </div>
            </div>
        </div>
    </div>
</li>
<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-books"></i>
        </span>
        <span class="nav-link-title">
            Course
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("Syllabus", "syllabus"); ?>
                <?php menu_a("Course", "course"); ?>
                <?php menu_a("Course register", "course-register"); ?>
            </div>
        </div>
    </div>
</li>
<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-users-group"></i>
        </span>
        <span class="nav-link-title">
            Personnel
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("Personnel", "personnel"); ?>
            </div>
        </div>
    </div>
</li>
<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-school"></i>
        </span>
        <span class="nav-link-title">
            Student
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("Student information", "student"); ?>
                <?php menu_a("Student promote", "student-promote"); ?>
                <?php menu_a("Student report", "student-report"); ?>
            </div>
        </div>
    </div>
</li>

<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-school"></i>
        </span>
        <span class="nav-link-title">
            General
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("building", "building"); ?>
                <?php menu_a("public relations", "public-relations"); ?>
                <?php menu_a("learning resources", "learning-resources"); ?>
                <?php menu_a("school vehicle", "vehicle"); ?>
                <?php menu_a("school nutrition", "nutrition"); ?>
            </div>
        </div>
    </div>
</li>
<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-table-options"></i>
        </span>
        <span class="nav-link-title">
            Timetable
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <?php menu_a("Timetable config", "/"); ?>
                <?php menu_a("Timetable setting", "/"); ?>
            </div>
        </div>
    </div>
</li>