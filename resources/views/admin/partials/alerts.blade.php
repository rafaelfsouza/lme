@if(count($errors->all()))

    @php

        $mensagem = '';
        foreach($errors->all() as $error){
          $mensagem .= $error.'<br />';
        }

    @endphp

    <script type="text/javascript">
        $(document).ready(function(){
            swal({
                title: 'Ops, encontramos um erro!',
                html: '{!! $mensagem !!}',
                type: 'error',
                cancelButtonText: 'Ok'
            })
        });
    </script>

@endif

@if (session('success'))
    <script>
        window.swal({
            type: 'success',
            title: '{{ session('success') }}',
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
@endif

@if (session('warning'))
    <script>
        window.swal({
            type: 'warning',
            title: '{{ session('warning') }}',
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
@endif
