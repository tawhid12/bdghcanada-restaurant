<!doctype html>
<html lang="en">


@stack('style')
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>bdhscanada.com</title>

    <link rel="icon" type="image/png" href="img/favicon.png">

    <link href="{{asset('')}}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('')}}assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <link href="{{asset('')}}assets/vendor/icofont/icofont.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link href="{{asset('')}}assets/css/osahan.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('')}}assets/vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('')}}assets/vendor/owl-carousel/owl.theme.css">
    @stack('styles')
</head>

<body>


    @yield('content')



    
    <section class="footer-bottom-search pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <p class="text-black">POPULAR Cities</p>
                    <div class="search-links">
                        @forelse($cities as $ct)
                        <a href="#">{{$ct->name}}</a> | 
                        @empty
                        @endforelse    
                    </div>
                    <p class="mt-4 text-black">POPULAR FOOD</p>
                    <div class="search-links">
                        <a href="#">Fast Food</a> | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a
                            href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South
                            Indian</a> | <a href="#">Punjabi Food</a> | <a href="#">Fast Food</a> | <a
                            href="#">Chinese</a> | <a href="#">Street Food</a> | <a href="#">Continental</a> | <a
                            href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South Indian</a> | <a
                            href="#">Punjabi Food</a><a href="#">Fast Food</a> | <a href="#">Chinese</a> | <a
                            href="#">Street Food</a> | <a href="#">Continental</a> | <a href="#">Mithai</a> | <a
                            href="#">Cafe</a> | <a href="#">South Indian</a> | <a href="#">Punjabi Food</a> | <a
                            href="#">Fast Food</a> | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a
                            href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South
                            Indian</a> | <a href="#">Punjabi Food</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="pt-4 pb-4 text-center">
        <div class="container">
            <p class="mt-0 mb-0">© Copyright 2022 BDHScanada. All Rights Reserved</p>
            <!-- <small class="mt-0 mb-0"> Made with <i class="fas fa-heart heart-icon text-danger"></i> by
                <a class="text-danger" target="_blank" href=""></a> - <a class="text-primary" target="_blank" href=""></a>
            </small> -->
        </div>
    </footer>

    <!-- <script src="{{asset('')}}assets/vendor/jquery/jquery-3.3.1.slim.min.js" type="text/javascript"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('')}}assets/vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{asset('')}}assets/vendor/owl-carousel/owl.carousel.js" type="text/javascript"></script>

    <script src="{{asset('')}}assets/js/custom.js" type="text/javascript"></script>
    @stack('scripts')
</body>



</html>
