<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
        <div class="sidebar-brand-icon ">
            <i class="fa-sharp fa-solid fa-cart-shopping"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Abi</div>
    </a>



    <?php if (in_groups('admin')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            User Management
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-solid fa-gauge-high fa-beat-fade"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - User List -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/listuser'); ?>">
                <i class="fas fa-solid fa-user fa-beat-fade"></i>
                <span>User List</span></a>
        </li>

        <!-- Nav Item - Add Shop -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/Shop'); ?>">
                <i class=" fas fa-solid fa-shop fa-beat-fade"></i>
                <span>Add Shop</span></a>
        </li>
        <!-- Nav Item - About Edit -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/about'); ?>">
                <i class="fas fa-sharp fa-regular fa-circle-info"></i>
                <span>About Edit</span></a>
        </li>

        <!-- Nav Item - Edit status -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/status'); ?>">
                <i class="fas fa-solid fa-book-open-reader"></i>
                <span>Edit status</span></a>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Karyawan Management
        </div>

        <!-- Divider -->

        <!-- Nav Item - Edit status -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Karyawans'); ?>">
                <i class="fas fa-solid fa-book-open-reader"></i>
                <span>Karyawan</span></a>
        </li>

    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User Profile
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-solid fa-user fa-beat-fade"></i>
            <span>My Profile</span></a>
    </li>

    <!-- Nav Item - Edit Profile -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/edit'); ?>">
            <i class="fas fa-solid fa-user-pen fa-beat-fade"></i>
            <span>Edit Profile</span></a>
    </li>
    <!-- Nav Item - History Cekout -->
    <li class="nav-item">
        <?php if (in_groups('admin')) : ?>
            <a class="nav-link" href="<?= base_url('admin/history'); ?>">
            <?php else : ?>
                <a class="nav-link" href="<?= base_url('user/history'); ?>">
                <?php endif; ?>
                <i class="fas fa-sharp fa-light fa-scroll"></i>
                <span>History Cekout</span>
                </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout'); ?>">
            <i class="fa-solid fa-right-from-bracket fa-fade"></i>
            <span>Logout</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>