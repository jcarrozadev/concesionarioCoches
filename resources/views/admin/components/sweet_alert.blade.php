@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            swal({
                icon: 'error',
                title: '¡Error!',
                text: '{{ $error }}',
            });
        @endforeach
    </script>
@endif

@if (session('error'))
    <script>
        swal({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
        });
    </script>
@endif

@if (session('success'))
    <script>
        swal({
            icon: 'success',
            title: '¡Correcto!',
            text: '{{ session('success') }}',
        });
    </script>
@endif