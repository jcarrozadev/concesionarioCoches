@if ($errors->any())
    @foreach ($errors->all() as $error)
            <script>
                swal({
                    title: "¡Error!",
                    text: "{{ $error }}",
                    icon: "error",
                });
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            swal({
                title: "¡Correcto!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif