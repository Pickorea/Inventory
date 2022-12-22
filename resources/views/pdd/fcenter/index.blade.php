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
                                
                                  
                                    <a href="{{route('fishcenter.create')}}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                        <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                        <link rel="stylesheet"
                             href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">     

                            <table id="example" class="table table-hover mx-0 table table-striped">
                            <thead class ="table-dark">
                            <tr>
                                <th>Fish Center</th>
                                <th>Island Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                               
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                     <td>{{ $item->island->name }}</td>
                                     <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('fishcenter.show', $item->name) }}"><i class="fas fa-eye">Show</i></a>
                                 
                                            <a href="{{ route('fishcenter.edit', $item->id) }}"><i class="fas fa-edit">Edit</i></a>
                                 
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

