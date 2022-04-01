<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale-1, shrink-to-fit-no">
  <meta http-equiv="x-ua-compatible" content="ie-edge">
  <title>
      @yield('title') | Jaykart
  </title>

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <style>
      .ui-widget{
          z-index: 2024;
      }

  </style>

</head>
<body>

    @include('layouts.inc.front-navbar')

    <main>
        @yield('content')
    </main>
    
    @include('layouts.inc.front-footer')

<!-- SCRIPTS -->

<!-- JQuery -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Bootstrap core Javascript -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('assets/js/mdb.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){

        src = "{{route('searchproductajax')}}";
        $("#search_text" ).autocomplete({
        source: function(request, response){
            $.ajax({
            url: src,
            data: {
                term: request.term
            },
            dataType: "json",
            success: function (data) {
                response(data);
            }
            });
        },
        minlenght: 1,
        });

        $(document).on('click','.ui-menu-item', function () {
        $('#search-form').submit();
        });

    });
</script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="{{asset('assets/js/custom.js') }}"></script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


</body>
</html>