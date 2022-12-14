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
                                <h3>@lang('Donors donates Assets/Items')</h3>
                            </div>
                           {{--<div class="col-auto">
                <form method="POST" id="search-form" class="form-inline" role="form">
                    <div class="form-group float-right">
                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                    </div>
                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                    <a href="{{ route("donor.create") }}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                </form>
            </div>--}}
                        </div>
                        </x-slot>

                        <x-slot name="body">
                        <table class="table table-hover mx-0">
                                <tr>
                                    <th class ="table-dark">
                                        Names of FishCenter
                                    </th>
                                </tr>
                      
                            @foreach ($fishcenters as $indexKey => $fishcenter )
                                <tr>

                                    <td>
                                        <input type="hidden" name="fishcenter_id" value="{{$fishcenter->id}}" />
                                                
                                        <a href="{{ route('stocktake.create', $fishcenter->id) }}"> <input type="checkbox" name="fishcenter->id"  value="{{$fishcenter->id}}" @if (!$indexKey) {!! "unchecked" !!} @endif>  {{$fishcenter->name}}</td></a>
                                    </td>
                               
                                </tr>
   
                            @endforeach
                            </tbody>
                        </table>
                     


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
