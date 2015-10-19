<!DOCTYPE html>
<html lang="pt-BR" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Projetos</title>
    @if(Config::get('app.debug'))
        <link rel="stylesheet" href="{{ asset('build/css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('build/css/components.css') }}"/>
        <link rel="stylesheet" href="{{ asset('build/css/flaticon.css') }}"/>
        <link rel="stylesheet" href="{{ asset('build/css/font-awesome.css') }}"/>
    @else
        <link rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
        @endif

                <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/#/home') }}">Home</a></li>
                <li class="dropdown">
                    <a href="{{ url('/#/clients') }}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Clientes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/#/clients') }}">Listar Clientes</a></li>
                        <li><a href="{{ url('/#/client/new') }}">Novo Cliente</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ url('/#/project') }}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Projetos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/#/projects') }}">Listar Projetos</a></li>
                        <li><a href="{{ url('/#/project/new') }}">Novo Projeto</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" ng-if="user.name == ''">
                <li><a href="{{ url('/#/login') }}">Login</a></li>
                <li><a href="{{ url('/#/register') }}">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" ng-if="user.name != ''">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false" ng-model="user.name">@{{user.name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/#/logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div ng-view></div>

@if(Config::get('app.debug'))
    <script src="{{ asset('build/js/vendor/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-route.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-resource.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-animate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-messages.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/navbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/query-string.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/vendor/ng-file-upload.min.js') }}" type="text/javascript"></script>

    {{--Controllers--}}
    <script src="{{ asset('build/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/login.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/home.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/client/clientList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/client/clientNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/client/clientEdit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/client/clientRemove.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/project/projectList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/projectNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/projectEdit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/projectRemove.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/project/note/noteList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteEdit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteRemove.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/project/task/taskList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskEdit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskRemove.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/project/member/memberList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/member/memberNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/member/memberRemove.js') }}" type="text/javascript"></script>

    <script src="{{ asset('build/js/controllers/project/file/fileList.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileNew.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileEdit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileRemove.js') }}" type="text/javascript"></script>

    {{--Directives--}}
    <script src="{{ asset('build/js/directives/fileDownload.js') }}" type="text/javascript"></script>

    {{--Filters--}}
    <script src="{{ asset('build/js/filters/date-br.js') }}" type="text/javascript"></script>

    {{--Services--}}
    <script src="{{ asset('build/js/services/url.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/client.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/project.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/projectNote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/projectTask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/projectMember.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/projectFile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('build/js/services/user.js') }}" type="text/javascript"></script>
@else
    <script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>
@endif
</body>
</html>