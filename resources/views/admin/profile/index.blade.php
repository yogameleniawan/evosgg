@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcumb')
<li><a href="javascript:void(0);">Profile</a></li>
@endsection
@section('title')
Profile
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="mb-3">
            @section('title_table')
            Profile
            @endsection
        </h3>
        <form id="form-data" enctype="multipart/form-data">
            <label for="email"> Email</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off" value="{{Auth::user()->email}}">
                </div>
            </div>

            <label for="password"> Password</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                </div>
            </div>
            <div id="btn-loader" class="loader d-none"></div>
        </form>
        <button id="btn-action" onclick="updateData()" class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block" >Update</span>
        </button>
    </div>
</div>

@endsection

@section('script')
<script>
    function updateData()
    {
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        let data = new FormData($('#form-data')[0]);
        $.ajax({
            url: '{{route('profile.update')}}',
            type: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            statusCode: {
                500: function(response) {
                    console.log(response)
                    Toastify({
                        text: 'Profile update unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Profile update successful',
                    backgroundColor: '#435ebe',
                }).showToast();
                $('#btn-loader').addClass('d-none')
                $('#btn-action').removeClass('d-none')
                $('#email').val(data.data.email)
            }
        });
    }
</script>
@endsection
