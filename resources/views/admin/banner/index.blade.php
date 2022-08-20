@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcumb')
    <li><a href="javascript:void(0);">Banner</a></li>
@endsection
@section('title')
Banner
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-3">
            @section('title_table')
                Banner
            @endsection
        </h3>
        <a href=""><button type="button" class="btn btn-danger">Add</button></a>
        <div class="table-responsive " style="margin-top:15px;">
            <table id="data_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#data_table tfoot th').each(function() {
            var title = $('#data_table thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                '" />');
        });
        $('tfoot').each(function() {
            $(this).insertAfter($(this).siblings('thead'));
        });
        var table = $('#data_table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('banner.index') }}",
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function() {
                console.log(colIdx + '-' + this.value);
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    });

</script>
@endsection
