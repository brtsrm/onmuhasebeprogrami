<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                @if(\App\Models\Rapor::FaturaHatirlatici() != 0 )
                    @foreach(\App\Models\Rapor::FaturaHatirlatici() as $hatirlatici)
                    <a href="{{$hatirlatici["uri"]}}" class="dropdown-item">
                        <!-- Message Start -->

                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">

                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>

                                <p class="text-sm">{{$hatirlatici["name"]}}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                    {{$hatirlatici["musteriAdi"]}}
                                    - {{$hatirlatici["fiyat"]}}</p>
                            </div>
                            <!-- Message End -->
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    @endforeach
                @endif
            </div>
        </li>
    </ul>
</nav>