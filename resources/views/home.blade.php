@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
  
  <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Resultado da votação</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="table-responsive">
  <table class="table">
  <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Votos</th>
    </tr>
    @foreach($results as $result)
    <tr>
      <td>{{$result->titulo}}</td>
      <td>
      <!-- Progress bars -->
      <div class="clearfix">
          <span class="pull-left">{{$result->voto->count()}}</span>
          <small class="pull-right">{{ number_format(($result->voto->count()/$total_votes) * 100,2, '.', ',') }}%</small>
        </div>
        <div class="progress xs">
          <div class="progress-bar progress-bar-green" style="width: {{ ($result->voto->count()/$total_votes) * 100 }}%"></div>
        </div>
      
      </td>
    </tr>
    @endforeach
    </table>
</div>
        </div>
        <!-- /.box-body -->
      </div>
      
      </div>
</div>
    
@stop