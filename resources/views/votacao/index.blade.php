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
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe">
        <thead>
            <tr>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Titulo</th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">
                    <abbr title="Rotten Tomato Rating">Ação</abbr>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
            <tr>
                <td class="title">{{ $item->titulo }}</td>
                <td>
                    <a class="btn btn-icon waves-effect waves-light btn-info m-b-5" href="{{ route('item.edit',$item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['item.destroy', $item->id],'style'=>'display:inline']) !!}
                        {{ Form::button('<i class="fa fa-remove" aria-hidden="true"></i> Excluir', ['class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'type' => 'submit']) }}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->render() !!}
    </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      </div>
</div>
@stop