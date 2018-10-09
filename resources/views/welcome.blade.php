<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 54px;
        }

        @media (min-width: 992px) {
            body {
                padding-top: 56px;
            }
        }

        .card {
            height: 100%;
        }

    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container text-center">
            <a class="navbar-brand" href="#">Sensorial</a>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4 text-center">
            <h1 class="display-3">Votação</h1>
        </header>
        <!-- Page Features -->
        <div class="row text-center parent-container">
            @foreach(App\Item::all() as $item)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <a href="{{asset('/images/'.$item->imagem)}}">
                    <img class="card-img-top" src="{{asset('/images/thumb/'.$item->imagem)}}" alt="">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$item->titulo}}</h4>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary votar" data-id='{{$item->id}}' data-titulo="{{$item->titulo}}">Votar</button>
                    </div>
                </div>
            </div>
            @endforeach
            @if((App\Item::all())->count() > 0)
            <div class="modal fade" id="excluir-moeda" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CONFIRMAR VOTO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					            <span aria-hidden="true">&times;</span>
				            </button>
                        </div>
                        <div class="modal-body text-left">
                            <div class="col-md-12">
                                <p>Deseja confirmar seu voto na foto: <strong><span id="item"></strong></span>?
                            </div>
                            {!! Form::open(['method' => 'POST','route' => ['voto.store', $item->id],'style'=>'display:inline']) !!}
                            <input name="item_id" type="hidden" class="form-control" id="item_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::email('email', null, array('placeholder' => 'Digite o e-mail para confirmação','class' => 'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-actions float-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $('.parent-container').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image'
            // other options
        });

        // delete a post
        $('.votar').on('click', function() {
            $('.modal-title').text('Excluir Moeda');
            $('#item_id').val($(this).data('id'));
            $('#item').html($(this).data('titulo'));
            $('#excluir-moeda').modal('show');
            id = $('#id_delete').val();
        });
        $('.delete').on('click', function() {
            var token = $(this).data('token');
            $.ajax({
                url: '/admin/cotacao/delete/' + id,
                type: 'post',
                data: {
                    _token: token
                },
                success: function(data) {
                    toastr.success('Cotacao excluida com sucesso!', 'Success Alert', {
                        timeOut: 5000
                    });
                    location.reload();
                }
            });
        });

    </script>
</body>

</html>
