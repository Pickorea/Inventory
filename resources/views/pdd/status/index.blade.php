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
                    <a href="{{ route('status.create') }}"><i class="fas fa-plus"></i> {{ __('Create') }}</a>
                        <x-slot name="header">
                        <div class="row">

                            <div class="col">
                                <h3>@lang('Status')</h3>
                            </div>
                            <div class="col-auto">
                                
                                    <!-- <div class="form-group float-left">
                                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                                    </div> -->
                                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                                    <a href="{{route('status.create')}}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                       
                            <table class="table table-hover mx-0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>
                                 
                                        Action
                                 
                                </th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('status.show', $item->id) }}"><i class="fas fa-eye"></i> {{ __('Show') }}</a>
                                      
                                            <a href="{{ route('status.edit', $item->id) }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                       
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


