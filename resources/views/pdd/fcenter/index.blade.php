@extends('layouts.app')

@section('title', __('Islands').' '.__('Dashboard'))

@push('after-styles')
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('/') }}/css/dataTables.bootstrap4.min.css" />
@endpush

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <x-frontend.card>
                        <x-slot name="header">
                        <div class="row">

                            <div class="col">
                                <h3>@lang('Fish Centers')</h3>
                            </div>
                            <div class="col-auto">
                                
                                    <!-- <div class="form-group float-left">
                                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                                    </div> -->
                                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                                    <a href="{{route('fishcenter.create')}}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                            <table class="table table-hover mx-0 table table-striped">
                            <thead class ="table-dark">
                            <tr>
                                <th>Fish Center</th>
                                <th>Island Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                                <th>
                                 
                                        <a href="{{ route('fishcenter.create') }}"><i class="fas fa-plus"></i></a>
                                 
                                </th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                     <td>{{ $item->island->name }}</td>
                                     <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('fishcenter.show', $item->id) }}"><i class="fas fa-eye">Show</i></a>
                                 
                                            <a href="{{ route('fishcenter.edit', $item->id) }}"><i class="fas fa-edit">Edit</i></a>
                                 
                                    </td>
                                 
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $items->links() !!}


                        </x-slot>
                    </x-frontend.card>
                    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-scripts')
    <script src="{{ url('/') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let datatable = (function () {
           

            var table;

            var init = function (item) {
                var htmlTable = $(item);
                table = htmlTable.DataTable({
                    searching: false,
                    bLengthChange: false,
                    order: [[1, "asc"]],
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: htmlTable.data('href'),
                        type: 'post',
                        data: function (d) {
                            d._token = '{!! csrf_token() !!}';
                            d.search = $('input[name=search]').val();
                            d.trashed = false;
                        }
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',  name: 'id', searchable: false, sortable: false }
                    ],
                    columnDefs: [
                        {
                            "render": function ( data, type, row ) {
                                value = data;
                                return value;

                            },
                            "targets": 1
                        },
                        {
                            "render": function ( data, type, row ) {
                                value = '<a href="{{ route('island.index') }}/'+row['id']+'"><i class="fas fa-eye"></i></a>';
                                 if (permissionEdit) {
                                    value += ' <a href="{{ route('island.index') }}/'+row['id']+'/edit"><i class="fas fa-edit"></i></a>' ;
                                }
                                 return value;

                            },
                            "targets": 2
                        },
                    ]
                });
            };

            var isColumnVisible = function(columnname) {
                var column = table.column( columnname );
                return (column) ? column.visible() : false ;
            }

            var toggleColumn  = function(columnname) {
                var column = table.column( columnname );
                var visible = (! column.visible()) ;
                column.visible( visible );
            }

            var draw = function() { table.draw() ;}
            var row = function(rowSelector) { return table.row(rowSelector) ;}

            // return public methods
            return {
                init: init,
                draw: draw,
                row: row,
                isColumnVisible: isColumnVisible,
                toggleColumn: toggleColumn
            };

        })();

        $(function() {
            console.log('Starting Page Ready');
            datatable.init('#data-table');
            $('#searchBtn').on('click', function(e) {
                datatable.draw();
            });
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                datatable.draw();
            });
            console.log('Page Ready Complete');
        });

    </script>
@endpush
