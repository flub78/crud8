<!-- index.blade.php -->

@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped"  id="maintable">
    <thead>
        <tr>
          <td>ID</td>
          <td>Game Name</td>
          <td>Game Price</td>
          <td >Edit</td>
          <td >Delete</td>
        </tr>
    </thead>
    
    <tbody>
        @foreach($games as $game)
        <tr>
            <td>{{$game->id}}</td>
            <td>{{$game->name}}</td>
            <td>{{$game->price}}</td>
            <td><a href="{{ route('games.edit', $game->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('games.destroy', $game->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  
    <a href="{{url('games')}}/create"><button type="submit" class="btn btn-primary" >@lang('general.create') @lang('games.element')</button></a> 
  
<div>

	<script type="text/javascript">
	<!--
	$(document).ready( function () {
	    $('#maintable').DataTable();
	} );
	//-->
	</script>

</div>
@endsection


