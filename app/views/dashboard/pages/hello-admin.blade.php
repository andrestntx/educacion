@extends('dashboard/pages/layout')

@section('title_page') Educación Continuada @stop
@section('h1_page') Bienvenido @stop
@section('h2_page') {{Auth::user()->t02_name}} @stop

@section('content_page')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    {{$number_users}}
                </h3>
                <p style="font-size:20px;">
                    Usuarios
                </p>
            </div>
            <a href="{{url('dashboard/users')}}">
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </a>
            <a href="{{url('dashboard/users')}}" class="small-box-footer" style="font-size:16px;">
                Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>  
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    {{$number_areas}}
                </h3>
                <p style="font-size:20px;">
                    Áreas 
                </p>
            </div>
            <a href="{{url('dashboard/areas')}}">
                <div class="icon">
                    <i class="ion ion-social-buffer"></i>
                </div>
            </a>
            <a href="{{url('dashboard/areas')}}" class="small-box-footer" style="font-size:16px;">
                Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>  
    </div><!-- ./col -->

    
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    {{$number_roles}}
                </h3>
                <p style="font-size:20px;">
                    Perfiles
                </p>
            </div>
            <a href="{{url('dashboard/roles')}}">
                <div class="icon">
                    <i class="ion ion-ios7-people"></i>
                </div>
            </a>
            <a href="{{url('dashboard/roles')}}" class="small-box-footer" style="font-size:16px;">
                Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>  
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    {{$number_protocols}}
                </h3>
                <p style="font-size:20px;">
                    Protocolos
                </p>
            </div>
            <a href="{{url('dashboard/protocols')}}">
                <div class="icon">
                    <i class="ion ion-ios7-copy-outline"></i>
                </div>
            </a>
            <a href="{{url('dashboard/protocols')}}" class="small-box-footer" style="font-size:16px;">
                Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>  
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    {{$number_categories}}
                </h3>
                <p style="font-size:20px;">
                    Categorías
                </p>
            </div>
            <a href="{{url('dashboard/protocols/categories')}}">
                <div class="icon">
                    <i class="ion ion-android-folder"></i>
                </div>
            </a>
            <a href="{{url('dashboard/categories')}}" class="small-box-footer" style="font-size:16px;">
                Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>  
    </div><!-- ./col -->
@stop
