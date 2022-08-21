@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcumb')
<li><a href="javascript:void(0);">Squad</a></li>
@endsection
@section('title')
Squad
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="mb-3">
            @section('title_table')
            Squad
            @endsection
        </h3>
        <button type="button" onclick="addModal()" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add</button>
        <div class="table-responsive " style="margin-top:15px;">
            <table id="data_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Name</th>
                        <th>Image</th>
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
            ajax: "{{ route('Squad.index') }}",
            columns: [
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
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
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });

</script>
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
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
                <form id="form-data" enctype="multipart/form-data">
                    <label for="name"> Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <select class="choices form-select">
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button" class="form-control" placeholder="Button" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button_link" class="form-control" placeholder="Button Link" autocomplete="off" required>
                        </div>
                    </div>

                    <label for="image"> Image</label>

                    <div class="form-group">
                        <img class="img-preview img-fluid mb-3 col-sm-2">
                        <div class="form-line">
                            <input type="file" id="image" class="form-control" name="image" onchange="previewImage()">
                        </div>
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
    }

    function editModal(data)
    {
        let html = `<div class="modal-body">
                <form id="form-data" enctype="multipart/form-data">
                    <input name="id" value="${data.id}" type="hidden">
                    <label for="title"> Title</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" placeholder="Title" autocomplete="off" value="${data.title}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="description" class="form-control" placeholder="Description" autocomplete="off" value="${data.description}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button" class="form-control" placeholder="Button" autocomplete="off" value="${data.button}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button_link" class="form-control" placeholder="Button Link" autocomplete="off" value="${data.button_link}">
                        </div>
                    </div>

                    <label for="image"> Image</label>

                    <div class="form-group">
                        <img class="img-preview img-fluid mb-3 col-sm-2" src="{{ url('${data.image}') }}">
                        <div class="form-line">
                            <input type="file" id="image" class="form-control" name="image" onchange="previewImage()">
                        </div>
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
    }

    function deleteModal(data)
    {
        let html = `<div class="modal-body">
                <form id="form-data" enctype="multipart/form-data">
                    <input id="id" name="id" value="${data.id}" type="hidden">
                    <label for="title"> Title</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" placeholder="Title" autocomplete="off" value="${data.title}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="description" class="form-control" placeholder="Description" autocomplete="off" value="${data.description}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button" class="form-control" placeholder="Button" autocomplete="off" value="${data.button}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="button_link" class="form-control" placeholder="Button Link" autocomplete="off" value="${data.button_link}">
                        </div>
                    </div>

                    <label for="image"> Image</label>
                    <div class="form-group">
                        <img class="img-preview img-fluid mb-3 col-sm-2" src="{{ url('${data.image}') }}">
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
    }

    function addData()
    {
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        let data = new FormData($('#form-data')[0]);
        $.ajax({
            url: '{{route('Squad.store')}}',
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
                        text: 'Squad add unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Squad add successful',
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
            url: `{{route('Squad.update','id')}}`,
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
                        text: 'Squad edit unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                console.log(data)
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Squad edit successful',
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
        $('#btn-loader').removeClass('d-none')
        $('#btn-action').addClass('d-none')
        $.ajax({
            url: `{{route('Squad.destroy','id')}}`,
            type: "DELETE",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': $('#id').val(),
            },
            statusCode: {
                500: function(response) {
                    console.log(response)
                    Toastify({
                        text: 'Squad delete unsuccessful',
                        backgroundColor: '#d74d4d',
                    }).showToast();
                    $('#btn-loader').addClass('d-none')
                    $('#btn-action').removeClass('d-none')
                },
            },
            success: function(data) {
                $("#form-data")[0].reset()
                Toastify({
                    text: 'Squad delete successful',
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
</script>
@endsection
