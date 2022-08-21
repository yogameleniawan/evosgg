@extends('admin.layouts.app')
@section('css')
    <style>
    .container {
        position: relative;
        text-align: center;
    }


    .date {
        position: absolute;
        top: 10px;
        left: 50px;
    }

    .time {
        position: absolute;
        top: 70px;
        left: 50px;
    }

    .stage {
        position: absolute;
        top: 10px;
        right: 30px;
    }

    .season {
        position: absolute;
        top: 145px;
        left: 50px;
    }

    .first_team_logo {
        position: absolute;
        top: 190px;
        left: 50px;
    }

    .first_team_input {
        position: absolute;
        top: 292px;
        left: 50px;
    }

    .first_team_score {
        position: absolute;
        top: 231px;
        left: 274px;
    }

    .second_team_logo {
        position: absolute;
        top: 194px;
        right: 30px;
    }

    .second_team_input {
        position: absolute;
        top: 292px;
        right: 30px;
    }

    .second_team_score {
        position: absolute;
        top: 231px;
        right: 274px;
    }
    </style>
@endsection

@section('breadcumb')
<li><a href="javascript:void(0);">Match</a></li>
@endsection
@section('title')
Match
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="mb-3">
            @section('title_table')
            Match
            @endsection
        </h3>
        <button type="button" onclick="addModal()" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add</button>
        <div class="table-responsive " style="margin-top:15px;">
            <table id="data_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Season</th>
                        <th>Home Team</th>
                        <th>Home Team Score</th>
                        <th>Away Team</th>
                        <th>Away Team Score</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Stage</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Vertically Centered modal Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content" id="modal-content">

        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let table = $('#data_table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('match.index') }}",
            columns: [
                {
                    data: 'game_name',
                    name: 'games.name'
                },
                {
                    data: 'season',
                    name: 'season'
                },
                {
                    data: 'first_team_logo',
                    name: 'first_team_logo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'first_team_score',
                    name: 'first_team_score'
                },
                {
                    data: 'second_team_logo',
                    name: 'second_team_logo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'second_team_score',
                    name: 'second_team_score'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'stage',
                    name: 'stage'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
    });
    $(document).ready(function () {
        $('#data_table tfoot th').each(function () {
            var title = $('#data_table thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                '" />');
        });
        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });

        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                // console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });

</script>
<script>
    function previewImageFirst() {
        const image = document.querySelector('#first_team_logo');
        const imgPreview = document.querySelector('.img-preview-first');
        imgPreview.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewImageSecond() {
        const image = document.querySelector('#second_team_logo');
        const imgPreview = document.querySelector('.img-preview-second');
        imgPreview.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<script>
    function addModal()
    {
        let html = `<div class="modal-body">
                <form id="form-data" action="{{route('match.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="container">
                            <img src="{{url('assets/images/match/bg.png')}}" alt="Image" style="width:100%;">
                            <div class="date"><input type="date" name="date"></div>
                            <div class="time"><input type="time" name="time"></div>
                            <div class="stage"><input type="text" name="stage" placeholder="Stage"></div>
                            <div class="season"><input type="text" name="season" placeholder="Season"></div>
                            <div class="first_team_logo">
                                <img class="img-preview-first img-fluid mb-3 col-sm-2">
                            </div>
                            <div class="first_team_input">
                                <input type="file" id="first_team_logo" name="first_team_logo" onchange="previewImageFirst()" style="font-size:10px">
                            </div>
                            <div class="first_team_score">
                                <input type="number" min="0" name="first_team_score" style="width: 60px">
                            </div>
                            <div class="second_team_logo">
                                <img class="img-preview-second" style="width: 100px">
                            </div>
                            <div class="second_team_input">
                                <input type="file" id="second_team_logo" name="second_team_logo" onchange="previewImageSecond()" style="font-size:10px">
                            </div>
                            <div class="second_team_score">
                                <input type="number" min="0" name="second_team_score" style="width: 60px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="choices form-select" name="game_id" id="game_id">

                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <div id="btn-loader" class="loader d-none"></div>
                <button id="btn-action" onclick="addData()" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block" >Add</span>
                </button>
            </div>`
        $('#modal-content').html(html)
        getGame()
    }

    function editModal(data)
    {
        let html = `<div class="modal-body">
                <form id="form-data" enctype="multipart/form-data">
                    <input name="id" value="${data.id}" type="hidden">
                    <div class="form-group">
                        <div class="container">
                            <img src="{{url('assets/images/match/bg.png')}}" alt="Image" style="width:100%;">
                            <div class="date"><input type="date" name="date" value="${data.date}"></div>
                            <div class="time"><input type="time" name="time" value="${data.time}"></div>
                            <div class="stage"><input type="text" name="stage" placeholder="Stage" value="${data.stage}"></div>
                            <div class="season"><input type="text" name="season" placeholder="Season" value="${data.season}"></div>
                            <div class="first_team_logo">
                                <img class="img-preview-first" style="width: 100px" src="{{ url('${data.first_team_logo}') }}">
                            </div>
                            <div class="first_team_input">
                                <input type="file" id="first_team_logo" name="first_team_logo" onchange="previewImageFirst()" style="font-size:10px">
                            </div>
                            <div class="first_team_score">
                                <input type="number" min="0" name="first_team_score" style="width: 60px" value="${data.first_team_score}">
                            </div>
                            <div class="second_team_logo">
                                <img class="img-preview-second" style="width: 100px" src="{{ url('${data.second_team_logo}') }}">
                            </div>
                            <div class="second_team_input">
                                <input type="file" id="second_team_logo" name="second_team_logo" onchange="previewImageSecond()" style="font-size:10px">
                            </div>
                            <div class="second_team_score">
                                <input type="number" min="0" name="second_team_score" style="width: 60px" value="${data.second_team_score}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="choices form-select" name="game_id" id="game_id">

                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <div id="btn-loader" class="loader d-none"></div>
                <button id="btn-action" onclick="editData(${data.id})" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block" >Update</span>
                </button>
            </div>`
        $('#modal-content').html(html)
        getGame()
        $('#game_id option[value="' + data.game_id + '"]').attr('selected', 'selected');
    }

    function deleteModal(data)
    {
        let html = `<div class="modal-body">
                <form id="form-data" enctype="multipart/form-data">
                    <input name="id" value="${data.id}" type="hidden">
                    <div class="form-group">
                        <div class="container">
                            <img src="{{url('assets/images/match/bg.png')}}" alt="Image" style="width:100%;">
                            <div class="date"><input type="date" name="date" value="${data.date}" disabled></div>
                            <div class="time"><input type="time" name="time" value="${data.time}" disabled></div>
                            <div class="stage"><input type="text" name="stage" placeholder="Stage" value="${data.stage}" disabled></div>
                            <div class="season"><input type="text" name="season" placeholder="Season" value="${data.season}" disabled></div>
                            <div class="first_team_logo">
                                <img class="img-preview-first" style="width: 100px" src="{{ url('${data.first_team_logo}') }}">
                            </div>
                            <div class="first_team_input">
                                <input type="file" id="first_team_logo" name="first_team_logo" onchange="previewImageFirst()" style="font-size:10px" disabled>
                            </div>
                            <div class="first_team_score">
                                <input type="number" name="first_team_score" style="width: 60px" value="${data.first_team_score}" disabled>
                            </div>
                            <div class="second_team_logo">
                                <img class="img-preview-second" style="width: 100px" src="{{ url('${data.second_team_logo}') }}">
                            </div>
                            <div class="second_team_input">
                                <input type="file" id="second_team_logo" name="second_team_logo" onchange="previewImageSecond()" style="font-size:10px" disabled>
                            </div>
                            <div class="second_team_score">
                                <input type="number" name="second_team_score" style="width: 60px" value="${data.second_team_score}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="choices form-select" name="game_id" id="game_id" disabled>

                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <div id="btn-loader" class="loader d-none"></div>
                <button id="btn-action" onclick="deleteData(${data.id})" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block" >Delete</span>
                </button>
            </div>`
        $('#modal-content').html(html)
        getGame()
        $('#game_id option[value="' + data.game_id + '"]').attr('selected', 'selected');
    }

    function addData()
    {
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        let data = new FormData($('#form-data')[0]);
        $.ajax({
            url: '{{route('match.store')}}',
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
                        text: 'Match add unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Match add successful',
                    backgroundColor: '#435ebe',
                }).showToast();
                $('#btn-loader').addClass('d-none')
                table.ajax.reload()
                $('#exampleModalCenter').modal('hide');
                const imgPreview = document.querySelector('.img-preview');
                imgPreview.src = '';
            }
        });
    }

    function editData(id)
    {
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        let data = new FormData($('#form-data')[0]);
        data.append('_method', 'PATCH');
        $.ajax({
            url: `{{route('match.update','id')}}`,
            type: 'POST',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            statusCode: {
                500: function(response) {
                    console.log(response)
                    Toastify({
                        text: 'Match edit unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Match edit successful',
                    backgroundColor: '#435ebe',
                }).showToast();
                $('#btn-loader').addClass('d-none')
                table.ajax.reload()
                $('#exampleModalCenter').modal('hide');
                const imgPreview = document.querySelector('.img-preview');
                imgPreview.src = '';
            }
        });
    }

    function deleteData(id)
    {
        let id_data = id;
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        $.ajax({
            url: `{{route('match.destroy','id')}}`,
            type: "DELETE",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': id_data,
            },
            statusCode: {
                500: function(response) {
                    console.log(response)
                    Toastify({
                        text: 'Match delete unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Match delete successful',
                    backgroundColor: '#435ebe',
                }).showToast();
                $('#btn-loader').addClass('d-none')
                table.ajax.reload()
                $('#exampleModalCenter').modal('hide');
                const imgPreview = document.querySelector('.img-preview');
                imgPreview.src = '';
            }
        });
    }

    function getGame()
    {
        $.ajax({
            async: false,
            url: '{{route('game.create')}}',
            type: "GET",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data.data.forEach(item => {
                    $('#game_id').append(`<option value='${item.id}'>${item.name}</option>`)
                });
            }
        });
    }
</script>
@endsection
