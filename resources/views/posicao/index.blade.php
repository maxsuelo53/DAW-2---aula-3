@extends("template.app")

@section("nome_tela","Posição")


@section("cadastro")
        <form action="/posicao" method="POST">
			<div class="row">
                <div class="col-3 form-group">
                    <label class="font-weight-bold">Posição:</label>
                    <input type="text" name="posicao" value="{{ $posicao->descricao}}" class="form-control" required />
                </div>
                <input type="hidden" name="id" value="{{$posicao->id}}">
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
		<table class="table table-striped ">
			<thead class="thead-dark">
				<tr class="text-uppercase">
					<th>Posição</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>	
			<tdbody>
				@foreach ($posicoes as $posicao)
					<tr >
						<td class="text-uppercase"> {{ $posicao->descricao}} </td>
						<td>
							<a href="/posicao/{{$posicao->id}}/edit" class="btn btn-dark"><i class="fas fa-pencil-alt"></i> Editar</a>
						</td>
						<td>
							<form action="/posicao/{{$posicao->id}}" method="POST">
								@csrf
								<input type="hidden" name="_method" value="delete"/>
								<button type="submit" class="btn btn-danger"  onclick="return confirm('Deseja realmente exlcuir?');"><i class="fas fa-trash-alt"></i> Excluir</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
@endsection

