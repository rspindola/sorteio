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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Custom styles for this template -->
</head>

<body>


    <header class="jumbotron text-center">
        <div class="col-12 col-md-4 mx-auto text-center">
            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid d-block mx-auto">
            <p class="titulo"><span>FOCO</span><br /> NA FOTO</p>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        <div class="card-columns">
            @foreach(App\Item::all() as $item)
            <div class="card my-3">
                <a href="{{asset('/images/'.$item->imagem)}}" data-source="http://500px.com/photo/32736307"
                    title="{{$item->titulo}}">
                    <img class="card-img-top img-fluid image" src="{{asset('/images/'.$item->imagem)}}" alt="">
                    <div class="middle">
                        <div class="text">{{$item->titulo}}</div>
                    </div>
                </a>
                <p class="card-text">
                    <button class="btn btn-primary btn-sm mx-auto d-block votar btn-block my-2" data-id='{{$item->id}}'
                        data-titulo="{{$item->titulo}}">Votar</button>
                </p>
            </div>
            @endforeach
            @if((App\Item::all())->count() > 0)
            <div class="modal fade" id="excluir-moeda" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CONFIRMAÇÃO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <div class="col-md-12">
                                <p>Deseja confirmar seu voto na foto: <strong><span id="item"></strong></span>?
                            </div>
                            <form class="form" method="POST" action="{{route('voto.store')}}" style='display:inline'>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                            <input name="item_id" type="hidden" class="form-control" id="item_id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control" name="email"
                                            value="{{ old('email') }}" autocomplete="email"
                                            title="O campo e-mail deve ser preenchido" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-actions text-center">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn-sm">Confirmar</button>
                                    </div>
                                </div>
                            </form>
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
            <p class="m-0 text-center text-white">Copyright &copy; Sensorial Web House 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $('.card-columns').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title') + ' &middot; <a class="image-source-link" href="' + item.el
                        .attr('data-source') + '" target="_blank">image source</a>';
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function (element) {
                    return element.find('img');
                }
            }

        });

        // delete a post
        $('.votar').on('click', function () {
            $('#item_id').val($(this).data('id'));
            $('#item').html($(this).data('titulo'));
            $('#excluir-moeda').modal('show');
            id = $('#id_delete').val();
        });

        $('.delete').on('click', function () {
            var token = $(this).data('token');
            $.ajax({
                url: '/admin/cotacao/delete/' + id,
                type: 'post',
                data: {
                    _token: token
                },
                success: function (data) {
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