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
                            <li></li>
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
                    <li>
                        <a href="{{url('formularios')}}">
                            <i class="fa fa-check sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Formularios</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{url('/')}}">
                            <i class="fa fa-bar-chart-o sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Mis Notas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-menu">
                            <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-check sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Formularios</span>
                        </a>
                        <ul>
                            @foreach(Auth::user()->preferredCompany->surveysNotExam() as $s)
                                <li>
                                    <a href="{{route('formularios.registros.index', $s->id)}}">
                                        <span class="sidebar-nav-mini-hide">{{$s->short_name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-menu">
                            <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-book sidebar-nav-icon"></i>
                            <span class="sidebar-nav-mini-hide">Protocolos</span>
                        </a>
                        <ul>
                            @foreach(Auth::user()->protocolsForStudy() as $p)
                                <li>
                                    <a href="{{route('estudiar', $p->id)}}">
                                        <i class="fa fa-file-text sidebar-nav-icon"></i>
                                        <span class="sidebar-nav-mini-hide">{{$p->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide" style="margin-bottom:10px;">
        <div class="text-center col-md-12">
            {{ HTML::image(Auth::user()->preferredCompany->logo, Auth::user()->preferredCompany->name, array('style' => 'width:80%;')) }}
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>