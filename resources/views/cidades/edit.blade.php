<h2>Alterar Cidade</h2>
<form action="{{ route('cidades.update', $dados['id']) }}" method="POST">
   @csrf
   @method('PUT')
   <a href="{{route('cidades.index')}}"><h4>voltar</h4></a>
   <label>Nome: </label> <input type='text' name='nome' value='{{$dados['nome']}}'>
   <label>Porte: </label> <input type='text' name='porte' value='{{$dados['porte']}}'>
   <input type="submit" value="Salvar">
</form>