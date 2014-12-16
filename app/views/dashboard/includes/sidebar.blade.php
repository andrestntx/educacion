<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="{{url('/')}}" class="sidebar-title">
            <i class="fa fa-cube"></i> 
            <span class="sidebar-nav-mini-hide">Edu. Continuada</span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                @if(Auth::user()->isSuperAdmin())
                    <li>
                        <a href="#" class="sidebar-nav-menu">
                            <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-gift sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Configuración</span></a>
                        <ul>
                            <li>
                                <a href="{{url('dashboard/config/models')}}">
                                    <i class="fa fa-angle-double-right sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Modelos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('instituciones')}}">
                            <i class="fa fa-laptop sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Instituciones</span>
                        </a>
                    </li>
                @elseif(Auth::user()->isAdmin())
                    <li>
                        <a href="{{url('areas')}}">
                            <i class="fa fa-sitemap sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Areas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-menu">
                            <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-user sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Usuarios</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{url('usuarios')}}">
                                    <i class="fa fa-users sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Ver Usuarios</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('usuarios/perfiles')}}">
                                    <i class="gi gi-old_man sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Perfiles</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-menu">
                            <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-book sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Protocolos</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{url('protocolos')}}">
                                    <i class="fa fa-file-text sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Ver Protocolos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('protocolos/categorias')}}">
                                    <i class="fa fa-folder-open sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Categorias</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{url('/')}}">
                            <i class="fa fa-bar-chart-o sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Mis Notas</span>
                        </a>
                    </li>
                    <li class="sidebar-separator">Protocolos</li>
                    @foreach(Auth::user()->protocolsForStudy() as $p)
                        <li>
                            <a href="{{route('estudiar', $p->id)}}">
                                <i class="fa fa-file-text sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">{{$p->name}}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info 
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
        <div class="push-bit">
            <span class="pull-right">
                <a href="javascript:void(0)" class="text-muted"><i class="fa fa-plus"></i></a>
            </span>
            <small><strong>200.000 </strong> / 350.000 Votantes</small>
        </div>
        <div class="progress progress-mini push-bit">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%"></div>
        </div>
        <div class="text-center">
            <small>Creado con <i class="fa fa-heart text-danger"></i> por <a href="http://nuestramarca.com" target="_blank">Nuestra Marca</a></small><br>
            <small><span id="year-copy"></span> &copy; <a href="{{url('/')}}" target="_blank">VINDER 1.0</a></small>
        </div>
    </div>
    -->
    <!-- END Sidebar Extra Info -->
</div>