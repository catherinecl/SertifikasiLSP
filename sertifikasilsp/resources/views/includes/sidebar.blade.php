<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perpus</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Members -->
    <li class="nav-item {{ request()->is('member*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('member.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Members</span>
        </a>
    </li>

    <!-- Nav Item - Book Data -->
    <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('buku.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Book Data</span>
        </a>
    </li>

    <!-- Nav Item - Book Category -->
    <li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Book Category</span>
        </a>
    </li>

    <!-- Nav Item - Borrow Book -->
    <li class="nav-item {{ request()->is('pinjam*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pinjam.index') }}">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Borrow Book</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->