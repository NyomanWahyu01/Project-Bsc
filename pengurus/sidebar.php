<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Tombol Toggle Sidebar -->
<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- MENU SIDEBAR -->
<aside class="menu-sidebar2" id="sidebar">
    <div class="logo-container">
        <div class="logo-center">
            <img src="assets/images/logo-bsc.png" alt="Logo BSC" class="logo-img">
            <h3 class="logo-text">PENGURUS</h3>
        </div>
        <button class="close-sidebar" onclick="toggleSidebar()">&times;</button>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">BSC SMAPUL</div>
        <nav class="navbar-sidebar2">
            <ul class="navbar__list">
                <li class="menu-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <a href="index.php"><i class="fas fa-home"></i>Dashboard</a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'kelola_anggota.php') ? 'active' : ''; ?>">
                    <a href="kelola_anggota.php"><i class="fas fa-users"></i>Kelola Anggota</a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'kelola_pengurus.php') ? 'active' : ''; ?>">
                    <a href="kelola_pengurus.php"><i class="fas fa-user-cog"></i>Kelola Pengurus</a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'kelola_juara.php') ? 'active' : ''; ?>">
                    <a href="kelola_juara.php"><i class="fas fa-trophy"></i>Kelola Juara</a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'kelola_coach.php') ? 'active' : ''; ?>">
                    <a href="kelola_coach.php"><i class="fas fa-user-tie"></i>Kelola Coach</a>
                </li>
                <li class="menu-item">
                    <a href="logout.php"><i class="fas fa-power-off"></i>Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR -->

<!-- CSS MODERN SIDEBAR -->
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
    }
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #2c3e50;
        color: white;
        padding: 10px 15px;
        border: none;
        font-size: 22px;
        z-index: 1201;
        border-radius: 6px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(44,62,80,0.5);
        z-index: 1200;
        transition: opacity 0.3s;
    }
    .menu-sidebar2 {
        background-color: #2c3e50;
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
        box-shadow: 2px 0 6px rgba(0,0,0,0.1);
        color: white;
        overflow-y: auto;
        z-index: 1202;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        transform: translateX(0);
    }
    .logo-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 20px 15px 10px 15px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        position: relative;
    }
    .logo-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
    }
    .logo-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin-bottom: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
    .logo-text {
        font-size: 18px;
        font-weight: bold;
        color: white;
        margin-bottom: 2px;
    }
    .user-login {
        font-size: 15px;
        color: #1abc9c;
        margin-top: 2px;
        font-weight: 500;
        background: rgba(255,255,255,0.08);
        padding: 4px 12px;
        border-radius: 8px;
        margin-bottom: 2px;
    }
    .close-sidebar {
        display: none;
        background: none;
        border: none;
        color: #fff;
        font-size: 28px;
        cursor: pointer;
        margin-left: 10px;
        margin-top: 2px;
        z-index: 1203;
    }
    .menu-sidebar2__content {
        padding: 10px 0;
    }
    .account2 {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        padding-bottom: 10px;
        color: white;
    }
    .navbar__list {
        list-style: none;
        margin: 0;
        padding: 0;
        flex: 1;
    }
    .navbar__list li {
        margin: 5px 0;
    }
    .menu-item a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: #ecf0f1;
        font-size: 15px;
        border-radius: 8px;
        transition: background 0.3s, padding-left 0.3s;
    }
    .menu-item a i {
        margin-right: 10px;
        font-size: 16px;
    }
    .menu-item a:hover,
    .menu-item.active a {
        background-color: #1abc9c;
        padding-left: 25px;
        color: white;
    }
    @media (max-width: 900px) {
        .menu-sidebar2 {
            width: 220px;
        }
    }
    @media (max-width: 768px) {
        .sidebar-toggle {
            display: block;
            z-index: 1301;
        }
        .sidebar-overlay.show {
            display: block;
            opacity: 1;
            z-index: 1300;
        }
        .menu-sidebar2,
        .menu-sidebar2.show {
            z-index: 1302;
        }
        .menu-sidebar2 {
            width: 85vw;
            max-width: 340px;
            transform: translateX(-100%);
            box-shadow: none;
        }
        .menu-sidebar2.show {
            transform: translateX(0);
            box-shadow: 2px 0 12px rgba(0,0,0,0.18);
        }
        .close-sidebar {
            display: block;
        }
        body.sidebar-open .content {
            margin-left: 85vw !important;
            width: 100vw !important;
        }
        .content {
            margin-left: 0 !important;
            width: 100vw !important;
        }
        body.sidebar-open {
            overflow: hidden;
        }
    }
    @keyframes slideInDown {
        0% {
            transform: translateY(-100%) scaleY(0.8);
            opacity: 0;
        }
        100% {
            transform: translateY(0) scaleY(1);
            opacity: 1;
        }
    }
    .menu-sidebar2.slideInDown {
        animation: slideInDown 0.5s cubic-bezier(.4,2,.6,1);
    }
</style>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const isOpen = sidebar.classList.toggle('show');
    overlay.classList.toggle('show', isOpen);
    document.body.classList.toggle('sidebar-open', isOpen);
    if(isOpen) {
        sidebar.classList.add('slideInDown');
    } else {
        sidebar.classList.remove('slideInDown');
    }
}
// Tutup sidebar jika resize ke desktop
window.addEventListener('resize', function() {
    if(window.innerWidth > 768) {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').classList.remove('show');
        document.body.classList.remove('sidebar-open');
    }
});
// Tutup sidebar otomatis saat klik menu di mobile
window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.menu-item a').forEach(function(link) {
        link.addEventListener('click', function() {
            if(window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('show');
                document.getElementById('sidebarOverlay').classList.remove('show');
                document.body.classList.remove('sidebar-open');
            }
        });
    });
});
</script>