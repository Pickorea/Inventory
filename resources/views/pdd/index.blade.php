@extends('layouts.app')

@section('title', __('PDD Dashboard'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('PDD') @lang('M&E Dashboard')
                    </x-slot>

                    <x-slot name="body">
                    <div class="album py-5 bg-light">
                <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Assets.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('asset.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Index')</a>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Islands.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('island.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Islands')</a>
                           
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Fish Centers.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('fishcenter.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Fish Center')</a>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Charts.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('chart.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Chart')</a>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Donors.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('donor.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Donors')</a>
                       
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col">
                    <div class="card shadow-sm">
                        

                        <div class="card-body">
                        <p class="card-text">Shares.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <a href="{{ route('share.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Share')</a>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
                        <a href="{{ route('island.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Islands')</a>
                        <a href="{{ route('donor.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Donors')</a>
                        <a href="{{ route('fishcenter.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Fish Center')</a>
                        <a href="{{ route('asset.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Asset')</a>
                        <a href="{{ route('share.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Share')</a>
                        <a href="{{ route('chart.index') }}" class="btn btn-sm btn-outline-secondary">@lang('Chart')</a>
                        {{--<a href="" class="btn btn-sm btn-outline-secondary">@lang('Area')</a>
                        <a href="" class="btn btn-sm btn-outline-secondary">@lang('Offence')</a>
                        <a href="" class="btn btn-sm btn-outline-secondary">@lang('Fishing Method')</a>
                        <a href="" class="btn btn-sm btn-outline-secondary">@lang('Penalty')</a>
                        <a href="" class="btn btn-sm btn-outline-secondary">@lang('Confiscated Item')</a>--}}
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
