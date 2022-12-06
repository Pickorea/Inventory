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
                            {{ Breadcrumbs::render('donor', $donor) }}
                            </div>
                            <!-- <div class="col">
                                <h3>@lang('Donations of') {{$donor->name}}</h3>
                            </div> -->
                            <div class="col-auto">
                           
                            <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                         
                            <a  href="{{ route('report.showpdf', $donor['id'] ) }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __(' To PDF') }}</button></a>  
  
                        </div>
                        
                     </div>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                            <table class="table table-hover mx-0 table-striped" >
                            <thead class ="table-light">
                            <tr>
                               
                                <th>Quantity</th>
                               
                               
                                <th>
                                Asset Name
                                       
                                 
                                </th>

                                <th>
                                 
                                Unit Price
                           
                          </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as  $item)
                                <tr>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit_price }}</td>
                             
                               
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
