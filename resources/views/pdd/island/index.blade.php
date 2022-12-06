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
                    <a href="{{ route('island.create') }}"><i class="fas fa-plus"></i> {{ __('Create') }}</a>
                        <x-slot name="header">
                        <div class="row">

                            <div class="col">
                                <h3>@lang('Islands')</h3>
                            </div>
                            <div class="col-auto">
                                
                                   
                                    <a href="{{route('island.create')}}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                            <!-- our project just needs Font Awesome Solid + Brands -->
                            <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
                            <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
                            <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
                                <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                                <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                      
                       
                            <link rel="stylesheet"
                             href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">                     
                        <table id="example" class="display table table-sm table table-striped" style="width:100%">
                               
                                <thead class ="table-dark">
                                    <tr>
                                    <th>Island Name</th>
                                        <th>Fish Center Name</th>
                                        <th>Action</th>
                            
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $item)
                                    <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>  
                                    <td><a href="{{ route('island.show', $item->id) }}"><i class="fas fa-eye">Show</i></a>
                                    <a href="{{ route('island.edit', $item->id) }}"><i class="fa-solid fa-pen-to-square"></i>Edit</a>       </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>No Stock Take for the this Island at the moments</td>
                                    </tr>
                                @endforelse
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


