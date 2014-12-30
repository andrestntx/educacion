<html>
	<head>
		<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
	</head>
	<body>
		<h2 class="text-center"> {{Auth::user()->preferredCompany->name}} </h2>
		<h3 class="text-center">Lista de Chequeo - {{$survey->name}}, # {{$resolvedSurvey->id}}</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<p>Fecha de Registro: {{$resolvedSurvey->created_at}}</p>
			</div>
		</div> 
		@foreach($resolvedSurvey->answers as $answer)
			<blockquote>
			  <p style="margin:0 0 2px 0;">{{$answer->question->text}}</p>
			  <p style="margin:0; font-size:14px;">{{$answer->text}}</p>
			</blockquote>
		@endforeach()
		<p>Elaborado por: {{$resolvedSurvey->user->name}}</p>
	</body>
</html>