@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
  
  <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Itens cadastrados na votação</h3>
          <a href="{{ route('item.create') }}" type="button" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Item</a>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="table-responsive">
    <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe">
        <thead>
            <tr>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Titulo</th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Voto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($votos as $key => $v)
            <tr>
                <td class="title">{{ $v->ip }}</td>
                <td class="title">{{ $v->email }}</td>
                <td class="title">{{ $v->item->titulo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      </div>
</div>
@stop