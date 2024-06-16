<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestor De Emoções Ulbra</title>

      <!-- jQuery -->
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <!-- Configuração global para o jQuery enviar o token CSRF em todas as solicitações AJAX -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/paginaInicial.css') }}" rel="stylesheet">
   
    <!-- Google Fonts - Montserrat -->
    <link rel="stylesheet" href="{{ asset('css/googleFonts.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

</head>
<body>

    <div id="app">
        @yield('content')
    </div>

    <!-- Bootstrap JS (opcional, dependendo dos componentes que eu uso) -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
