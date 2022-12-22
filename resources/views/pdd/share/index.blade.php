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
                        {!!Breadcrumbs::render('home') !!}
                            <div class="col">
                                <h3>@lang('Dated Shares')</h3>
                            </div>
                            <div class="col-auto">
                                
                                   
                                  <a href="{{route('share.indexofdonors')}}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                        <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                        <link rel="stylesheet"
                             href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">     

                            <table  id="example" class="table table-hover mx-0  table-striped">
                            <thead class="table-dark">
                            <tr>
                               
                                <th>Share Date</th>
        
                               
                                <th>
                                 
                                       Action
                                 
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as  $item)
                                <tr>
                               
                                    <td>{{ date('d M Y', strtotime($item->share_date)) }}</td>
                              
                                    <td>
                                        <a href="{{ route('share.show', $item->share_date) }}"><i class="fas fa-eye">{{ __('Show') }}</i></a>
                                    
                                        <a href="{{ route('share.edit', $item->share_date) }}"><i class="fas fa-edit">{{ __('Edit') }}</i></a>
                                 
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
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                pagingType: 'full_numbers',
                "paging":true,
                "ordering":true,
                "info":true
                
            
            
            });
        });
    </script>
    
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
