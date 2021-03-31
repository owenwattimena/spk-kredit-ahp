<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('/') ? 'active ' : '' }}" href="{{ url('/') }}"><i
                                class="fa fa-fw fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('ahp/*') ? 'active ' : '' }}" href="#"
                            data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                            aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>AHP</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('ahp/kriteria') || request()->is('ahp/kriteria/*') ? 'active ' : '' }}"
                                        href="{{ route('ahp.kriteria') }}">Kriteria</a>
                                    <a class="nav-link {{ request()->is('ahp/subkriteria') || request()->is('ahp/subkriteria/*') ? 'active ' : '' }}"
                                        href="{{ route('ahp.subkriteria') }}">Subkriteria</a>
                                    <a class="nav-link {{ request()->is('ahp/alternatif') || request()->is('ahp/alternatif/*') ? 'active ' : '' }}"
                                        href="{{ route('ahp.alternatif') }}">Alternatif</a>
                                    <a class="nav-link {{ request()->is('ahp/matrix') || request()->is('ahp/matrix/*') ? 'active ' : '' }}"
                                        href="{{ route('ahp.matrix') }}">Matrix Perbandingan</a>
                                    <a class="nav-link {{ request()->is('ahp/ranking') ? 'active ' : '' }}"
                                        href="{{ route('ahp.ranking') }}">Ranking</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="nav-item ">
                        <a class="nav-link" href="#"><i class="fa fa-fw fa-user-circle"></i>User</a>
                    </li> --}}
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
