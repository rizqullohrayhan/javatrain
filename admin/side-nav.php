<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "
    <script>
        let url = 'login.php';
        window.location.href = url;
    </script>
    ";
}
require('koneksi.php');
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($page=='index'){echo 'active';}?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <li class="nav-item <?php if($page=='kereta'){echo 'active';}?>">
                <a class="nav-link" href="kereta.php">
                    <i class="fas fa-fw fa-train"></i>
                    <span>Kereta</span></a>
            </li>
            <li class="nav-item <?php if($page=='stasiun'){echo 'active';}?>">
                <a class="nav-link" href="stasiun.php">
                    <i class="fas fa-fw fa-route"></i>
                    <span>Stasiun</span></a>
            </li>
            <li class="nav-item <?php if($page=='tiket'){echo 'active';}?>">
                <a class="nav-link" href="tiket.php">
                    <i class="fas fa-fw fa-ticket-alt"></i>
                    <span>Tiket</span></a>
            </li>
            <li class="nav-item <?php if($page=='riwayat'){echo 'active';}?>">
                <a class="nav-link" href="log_pesan.php">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>Riwayat Pesanan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="db/dblogout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Log Out</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->