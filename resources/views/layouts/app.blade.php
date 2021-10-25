<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'POS Inventory') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- CSS Libraries -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/stisla/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/stisla/css/components.css') }}">
        <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                @include('layouts.navbar')
                @include('layouts.sidebar')

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            @isset($header_content)
                                {{ $header_content }}
                            @else
                                {{ __('Halaman') }}
                            @endisset
                        </div>

                        <div class="section-body">
                            {{ $slot }}
                        </div>
                    </section>
                </div>
            </div>
        </div>

        @isset($modal)
            {{ $modal }}
        @endisset

        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="{{ asset('assets/stisla/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <!-- Template JS File -->
        <script src="{{ asset('assets/stisla/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/stisla/js/custom.js') }}"></script>

        <script>
            $('.ajax-form').submit(function(e) {
                e.preventDefault()
                let form = $(this)
                let formData = new FormData(this)

                $.ajax({
                        dataType: "json",
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: formData,
                        headers: {
                        'Accept': 'application/json',
                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                    beforeSend: function() {
                        form.find('.btn-save').addClass('disabled')
                        form.find('.btn-save').addClass('btn-progress')
                        form.find(':submit').prop('disabled', true)
                    },
                    complete: function(data) {
                        form.find('.btn-save').removeClass('disabled')
                        form.find('.btn-save').removeClass('btn-progress')
                        form.find(':submit').prop('disabled', false)
                    },
                    success: function(result){
                        Swal.fire(
                            'Success!',
                            result.data.message,
                            'success'
                        ).then(function() {
                            if (result.data.location) window.location.hash = result.data.location

                            if (result.data.redirect) {
                                window.location.replace(result.data.redirect)
                            } else if (result.data.debug) {
                                console.log(result.data.debug)
                            } else if (!result.data.norefresh) {
                                location.reload(true)
                            }

                            if (result.data.reset) {
                                form[0].reset()
                            }
                        })
                    },
                    error: function(err){
                        // if (err.status == 422) {
                            let errors = document.createElement('ul');

                            $.each(err.responseJSON.error.errors, function (i, error) {
                                let item = document.createElement('li')
                                item.innerHTML = error.message
                                errors.appendChild(item)
                            })

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: errors
                            })
                        // } else {
                        //     Swal.fire({
                        //         icon: 'error',
                        //         title: 'Oops...',
                        //         text: 'Something went wrong!',
                        //     })
                        // }
                    }
                })
            })
        </script>

        @isset($script)
            {{ $script }}
        @endisset
    </body>
</html>
