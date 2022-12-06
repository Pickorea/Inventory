@extends('layouts.app')

@section('title', __('View Status'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-frontend.card>
        <x-slot name="header">
            @lang('View') @lang('Status')
        </x-slot>

        <x-slot name="body">
            <div class=""><label>@lang('Name')</label><p>{{ $item->name }}</p></div>
        </x-slot>
        <x-slot name="footer">
        
                <a href="{{ route('status.edit', $item) }}" class="btn btn-primary">@lang('Edit')</a>
       
            <a href="{{ route('status.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
        </x-slot>
    </x-frontend.card>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
