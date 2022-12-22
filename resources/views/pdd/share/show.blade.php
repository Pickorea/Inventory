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
                                <h3>@lang('Items Allocated to Fish Centers')</h3>
                            </div>
                            <div class="col-auto">
                                
                                    <!-- <div class="form-group float-left">
                                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                                    </div> -->
                                    {{--<button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>--}}
                                    

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                            <table class="table table-hover mx-0">
                            <thead class ="table-dark">
                            <tr>
                               
                            <th>#</th>
                            <th>
                                 
                                 Fish Centers Name
                           
                          </th>
                                <th>Allocated Quantity</th>
                               
                               
                               

                                <th>
                                 
                                 Asset Name
                           
                                </th>

                                <th>
                                 
                                Date
                           
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                        
                            @foreach($items as  $item)
                                <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->center }}</td>
                                <td>{{ $item->allocated_quantity }}</td>
                            
                                <td>{{ $item->asset }}</td>
                                <td>{{ date('d M Y', strtotime($item->share_date)) }}</td>
                               {{-- <td>
                                        <form action="{{ route('report.sharespdf', $item->share_date) }}"> <a href="{{ route('report.sharespdf', $item->share_date) }}" class="btn btn-outline-info" id="exportBtn">@lang('PDF')</a></form>                                 
                                       
                                 
                                 </td>--}}
                               
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
