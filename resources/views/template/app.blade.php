<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{ asset('css/all.css')}}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css')}}" />
		<script src="{{ asset('js/bootstrap.js') }}"> </script>
		<script src="{{ asset('js/jquery.js') }}"> </script>
		<title>PAGINA - @yield("nome_tela")</title>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link"href="/"><i class="fas fa-home"></i> HOME</a></li>
					<li class="nav-item"><a class="nav-link"href="/jogador"><i class="fas fa-male"></i> JOGADOR </a></li>
					<li class="nav-item"><a class="nav-link"href="/clube"><i class="fas fa-users"></i> CLUBE </a></li>
					<li class="nav-item"><a class="nav-link"href="/posicao"><i class="fas fa-running"></i> POSIÇÃO </a></li>
				</ul>
		</nav>
		@if (Session::has("salvar"))
			<div class="alert alert-success">
				{{ Session::get("salvar") }}
			</div>
		@endif
		@if (Session::has("excluir"))
			<div class="alert alert-danger">
				{{ Session::get("excluir") }}
			</div>
		@endif


		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $erro)
						<li>{{$erro}}</li>
					@endforeach
				</ul>
			</div>

		@endif
		
		@if(!request()->is("/"))
			<div class="container">
				<h1>Cadastro - @yield("nome_tela")</h1>
				<div class="cadastro">
					@yield("cadastro")
				</div>
				<h1>Listagem - @yield("nome_tela")</h1>
				<div class="listagem">
					@yield("listagem")
				</div>
			</div>
		@else
			<div class="container" style="text-align: center;">
				<br/>
				<br/>
				<br/>
				<h1>Cadastro de Jogador</h1>
			</div>
		@endif		
	</body>
	
</html>