@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Novo item</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
  
  <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastrar item</h3>
          <a href="{{ route('item.create') }}" type="button" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Item</a>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
    {!! Form::open(array('route' => 'item.store','files'=>true**,'method'=>'POST')) !!}
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label">Titulo</label>
                    {!! Form::text('titulo', null, array('placeholder' => 'Titulo completo','class' => 'form-control')) !!}
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Imagem</label>
                    {!! Form::file('imagem', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
    </div>
    <div class="form-actions pull-right">
        <a href="{{url('/usuarios')}}" type="button" class="btn btn-danger">Voltar</a>
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
    </div>
    {!! Form::close() !!}
    </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      </div>
</div>
@stop
