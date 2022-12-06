@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-forms.post action="{{ route('fishcenter.store') }}" class="">
        <x-frontend.card>
            <x-slot name="header">
                @lang('Create') @lang('Fish Center')
            </x-slot>

            <x-slot name="body">
                <x-forms.textfield required type="text" name="name" label="{{ __('Name') }}" value="{{ $item->name }}" />
                
                <div class="form-group">
                            <label for="island_id">@lang('Island')</label>
                            <select name="island_id" name="island_id" class="form-control" required>
                                @foreach($islands as $island)
                                    <option value="{{ $island->id }}" @if($island->id == old('island_id', $item->island_id))selected="true"@endif> {{ $island->name }}</option>
                                @endforeach
                            </select>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                <a href="{{ route('island.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
            </x-slot>
        </x-frontend.card>
    </x-forms.post>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
