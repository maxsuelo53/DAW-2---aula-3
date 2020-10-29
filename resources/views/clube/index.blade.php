@extends("template.app")

@section("nome_tela","Clube")

@section("cadastro")
        <form action="/clube" method="POST" enctype="multipart/form-data">
			<div class="row">
                <div class="col-3">
                    <label class="font-weight-bold">Nome:</label>
                    <input type="text" name="nome" value="{{ $clube->nome}}" class="form-control" required />
                </div>
				<div class="form-group col-4">
					<label class="font-weight-bold">Foto:</label>
                    <input type="file" name="foto" value="" class="form-control"/>	
				</div>
                <input type="hidden" name="id" value="{{$clube->id}}">
                @csrf
                <div class="col-3">
                    <button type="submit" class="btn btn-success botao"><i class="fas fa-save"></i> Salvar</button>                
                    <a href="/posicao" class="btn btn-info botao"><i class="fas fa-plus-square"></i> Novo</a>
                </div>
            </div>
		</form>
@endsection


@section("listagem")    
    <br/>
	<div class="row">
		<table class="table table-striped text-center">
			<thead class="thead-dark">
				<tr class="text-uppercase">
					<th>Clube</th>
					<th>Escudo</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>	
			<tdbody>
				@foreach ($clubes as $clube)
					<tr >
						<td class="text-uppercase"> {{ $clube->nome}} </td>
						<td> 
							@if ($clube->foto != "")
							<img src="{{ asset('storage/'.$clube->foto) }}" width="100" />
							@else
								-
							@endif
						</td>
						<td>
							<a href="/clube/{{$clube->id}}/edit" class="btn btn-dark"><i class="fas fa-pencil-alt"></i> Editar</a>
						</td>
						<td>
							<form action="/clube/{{$clube->id}}" method="POST">
								@csrf
								<input type="hidden" name="_method" value="delete"/>
								<button type="submit" class="btn btn-danger"  onclick="return confirm('Deseja realmente exlcuir?');"><i class="fas fa-trash-alt"></i> Excluir</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
	</div>
@endsection
