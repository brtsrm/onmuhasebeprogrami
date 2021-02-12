<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset("/")}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ön Muhasebe</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Berat SARMIŞ</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-5">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                @if(\App\Models\UserPermission::getMyController(0))

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Müşteriler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a href="{{route("musteriler.index")}}"
                                class="nav-link {{route("musteriler.index") == url()->current() ? 'active' : ''}}  ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Müşteri Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("musteriler.create")}}"
                                class="nav-link {{route("musteriler.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Müşteri Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(\App\Models\UserPermission::getMyController(1))

                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Gelir & Gider Kalemi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("kalem.index")}}"
                                class="nav-link {{route("kalem.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gelir & Gider Kalemi Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("kalem.create")}}"
                                class="nav-link {{route("kalem.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni Gelir & Gider Kalemi Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                @endif

                @if(\App\Models\UserPermission::getMyController(2))

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Ürünler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("urun.index")}}"
                                class="nav-link {{route("urun.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ürün listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("urun.create")}}"
                                class="nav-link {{route("urun.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni ürün kayıt listesi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                @endif
                @if(\App\Models\UserPermission::getMyController(3))

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Fatura
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("fatura.index")}}"
                                class="nav-link {{route("fatura.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Faturaları Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("fatura.create","gelir")}}"
                                class="nav-link {{route("fatura.create","gelir") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni Gelir Faturası Ekle</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("fatura.create","gider")}}"
                                class="nav-link {{route("fatura.create","gider") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni Gider Faturası Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                @endif

                @if(\App\Models\UserPermission::getMyController(4))
                
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Banka
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("banka.index")}}"
                                class="nav-link {{route("banka.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banka Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("banka.create")}}"
                                class="nav-link {{route("banka.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni Banka Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                @endif
                @if(\App\Models\UserPermission::getMyController(5))

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            İşlemler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("islem.index")}}"
                                class="nav-link {{route("islem.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>İşlemleri Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("islem.create",["type" => "0"])}}"
                                class="nav-link {{route("islem.create",["type" => "0"]) == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ödeme Yap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("islem.create",["type" => "1"])}}"
                                class="nav-link {{route("islem.create",["type" => "1"]) == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tahsilat Al</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                @endif

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Profil
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("profil.index")}}" class="nav-link "
                                class="nav-link {{route("profil.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ayarlar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("profil.logout")}}"
                                class="nav-link {{route("musteriler.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Çıkış Yap</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(\App\Models\UserPermission::getMyController(6))

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Kullanıcı
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route("user.index")}}"
                                class="nav-link {{route("user.index") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kullanıcı listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("user.create")}}"
                                class="nav-link {{route("user.create") == url()->current() ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kullaınıc Ekle</p>
                            </a>
                        </li>
                    </ul>
             
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield("title","Anasayfa")</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">