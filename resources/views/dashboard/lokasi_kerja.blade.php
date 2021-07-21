@extends('layouts.app')
@section('title')
<title>Dashboard - Peruri Covid</title> 
@endsection
@section('header')
<div class="container">
    <div class="page-header-content pt-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
                <h1 class="page-header-title">
                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </h1>
                <div class="page-header-subtitle">Example dashboard overview and content summary</div>
            </div>
            <div class="col-12 col-xl-auto mt-4">
                <button class="btn btn-white btn-sm line-height-normal p-3" id="reportrange">
                    <i class="mr-2 text-primary" data-feather="calendar"></i>
                    <span></span>
                    <i class="ml-1" data-feather="chevron-down"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<style>
    #tbl_jsea tbody tr {

        cursor: pointer;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-text card-header-info">
                    <div class="card-text">
                        <h4 class="card-category">Selamat Datang di Aplikasi e-Rewards Perum Peruri</h4>
                    </div>
                </div>
                <input type="hidden" id='hidden_pangkat' value="{{$userData->pangkat}}">
                <input type="hidden" id='hidden_sto' value="{{$userData->unit}}">
                <input type="hidden" id='hidden_dir' value="{{$userData->direktorat}}">
                <input type="hidden" id='hidden_direktur' value="{{$userData->dir}}">
                <input type="hidden" id='hidden_passwd' value="{{$userData->password_change_at}}">
                
                <div class="card-body ">
                    {{-- <input type="file" name="avatar" id='avatar'> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.modal_change_passwd')
@endsection
@section('scripts')

<script>
    $(document).ready(function () {
// const inputElement = document.querySelector('input[id="avatar"]');
// const pond = FilePond.create( inputElement );
// // FilePond.setOptions({
// //     server: '/upload'
// // });

// FilePond.setOptions({
//     // allowDrop: false,
//     allowReplace: true,
//     instantUpload: false,
//   server: {
//     url: '/upload', 
//     headers: {
//       'X-CSRF-TOKEN': '{{ csrf_token() }}'
//     }
//   }
// }); 

        var paramDataUser = {
            pangkat: $('#hidden_pangkat').val(),
            sto: $('#hidden_sto').val(),
            direktorat: $('#hidden_dir').val(),
            dir: $('#hidden_direktur').val(),
            
        }
        localStorage.setItem('dataUser', JSON.stringify(paramDataUser))

        $("#show_hide_password button").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
        $("#show_hide_password_new button").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password_new input').attr("type") == "text") {
                $('#show_hide_password_new input').attr('type', 'password');
                $('#show_hide_password_new i').addClass("fa-eye-slash");
                $('#show_hide_password_new i').removeClass("fa-eye");
            } else if ($('#show_hide_password_new input').attr("type") == "password") {
                $('#show_hide_password_new input').attr('type', 'text');
                $('#show_hide_password_new i').removeClass("fa-eye-slash");
                $('#show_hide_password_new i').addClass("fa-eye");
            }
        });


        //modal untuk change password belum 
        if($('#hidden_passwd').val()==''){
          $('#formChangePasswd').modal({backdrop: 'static', keyboard: false})
        }

        $('#edit_password').on('submit', function (event) {
            event.preventDefault();
            var paramData = new FormData(this) 
            sendData(paramData, '#action_button')
            $('#formChangePasswd').modal()
        })

        function sendData(param, idbutton) {

            $.ajax({
                url: "{{route('first.change')}}",
                
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: param,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(idbutton).text('proses menyimpan...');
                    $(idbutton).prop('disabled', true);
                },
                success: function (data) {

                    $(idbutton).text('Simpan');
                    $(idbutton).prop('disabled', false);
                    if (data.error) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                    $('#formChangePasswd').modal('toggle')
                }
            })
        }

    })

</script>
@endsection
