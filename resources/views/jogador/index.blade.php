@extends("template.app")

@section("nome_tela","Jogador")


@section("cadastro")
        <form action="/jogador" method="post" class="row">
                <div class="col-6 form-group">
                    <label class="font-weight-bold">Jogador:</label>
                    <input type="text" name="nome" value="{{ $jogador->nome }}" class="form-control" required />
                </div>
                <div class="col-6 form-group">
                    <label class="font-weight-bold">Data de Nascimento:</label>
                    <input type="text" name="data" value="{{ $jogador->data_nascimento}}" class="form-control" required />
                </div>
				
				<div class="form-group col-6">
					<label class="font-weight-bold">Posição:</label>
					<select name="posicao" class="form-control" required>
						<option value=""></option>
						@foreach ($posicoes as $posicao)
							@if ($posicao->id == $jogador->posicao)
								<option value="{{ $posicao->id}}" selected="selected">{{$posicao->descricao}} </option>
							@else
								<option value="{{ $posicao->id}}">{{$posicao->descricao}} </option>
							@endif
						@endforeach
					</select>
				</div>

				<div class="form-group col-6">
					<label class="font-weight-bold">Clube:</label>
					<select name="clube" class="form-control" required >
						<option value=""></option>
						@foreach($clubes as $clube)
							@if ($clube->id == $jogador->clube)
								<option value="{{$clube->id}}" select="selected"> {{$clube->nome}}</option>
							@else
							<option value="{{$clube->id}}"> {{$clube->nome}}</option>
							@endif
						@endforeach
					</select>
				</div>


				<input type="hidden" name="id" value="{{$jogador->id}}"> 

				@csrf
                <div class="col-3 form-group">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>                
                    <a href="/jogador" class="btn btn-info"><i class="fas fa-plus-square"></i> Novo</a>
                </div>

		</form>
@endsection


@section("listagem")    
    <br/>
		<table class="table table-striped text-center ">
			<thead class="thead-dark">
				<tr class="text-uppercase ">
					<th>Nome</th>
					<th>Posição</th>
                    <th>Data de nascimento</th>
					<th>Clube</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>	
			<tdbody>
				@foreach ($jogadores as $jogador)
					<tr >
						<td class="text-uppercase"> {{ $jogador->nome }} </td>
						<td class="text-uppercase"> {{$jogador->posicao}} </td>
                        <td class="text-uppercase"> {{$jogador->data_nascimento}} </td>	
						<td class="text-uppercase"> {{$jogador->clube}} </td>					
						<td>
							<a href="/jogador/{{$jogador->id}}/edit" class="btn btn-dark"><i class="fas fa-pencil-alt"></i> Editar</a>
						</td>
						<td>
							<form action="/jogador/{{$jogador->id}}" method="POST">
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
