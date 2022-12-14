@extends('layouts.app')

@section('title', __('View Crime'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-frontend.card>
        <x-slot name="header">
            @lang('View') @lang('Fish Center')
        </x-slot>

        <x-slot name="body">
            <div class=""><label>@lang('Name')</label><p></p></div>
            <table class="table table-hover mx-0">
                            <thead class ="table-light">
                            <tr>
                               
                                <th>Fish Center Name</th>
                                <th>Asset Name</th>
                                <th>Quantity Allocated</th>
                                <th>
                                 
                                        <a href="{{ route('fishcenter.create') }}"><i class="fas fa-plus"></i></a>
                                 
                                </th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($item as $object)
                                <tr>
                                                 
                                <td>{{ $object->fishCenterName}}</td>
                                <td>{{ $object->assetName}}</td>
                                <td>{{ $object->allocated_quantity}}</td>
                          
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
        </x-slot>
        <x-slot name="footer">
            @can('kiims.edit')
                <a href="{{ route('island.edit', $item) }}" class="btn btn-primary">@lang('Edit')</a>
            @endcan
            <a href="{{ route('island.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
        </x-slot>
    </x-frontend.card>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
