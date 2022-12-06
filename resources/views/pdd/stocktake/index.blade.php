@extends('layouts.app')

@section('title', __('Stock Take').' '.__('Dashboard'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <x-frontend.card>
                        <x-slot name="header">
                        <div class="row">

                            <div class="col">
                                <h3>@lang('FISH CENTERS STOCK TAKE RESULTS')</h3>
                            </div>
                            <div class="col-auto">
               
                  
                    <a href="{{ route("donor.create") }}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                
            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">

                            <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                        <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                      
                       
                        <link rel="stylesheet"
                            href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

                        <table id="example" class="display table table-sm table table-striped" style="width:100%">
                               
                                <thead class ="table-dark">
                                    <tr>
                                    <th>Island Name</th>
                                        <th>Fish Center Name</th>
                                        <th>Qty Allocated</th>
                                        <th>Stock On Hand</th>
                                        <th>Missing</th>
                                        <th>Defects</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td>{{$item->island}}</td> 
                                        <td>{{$item->name}}</td> 
                                        <td>{{$item->allocated_quantity}}</td>
                                        <td>{{$item->onhand}}</td> 
                                        <td>{{$item->Missing}}</td> 
                                        <td>{{$item->defects}}</td> 
                                        
                                        <td>{{$item->stock_take_date}}</td>                 
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

@push('after-scripts')

@endpush