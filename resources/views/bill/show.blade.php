@extends('layouts.master')

@section('title')
@endsection

@push('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
    <link href='/css/bill/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <div class="col-xs-12 col-sm-6">
        <h5>Welcome! This tool will help you split a tab and tips</h5>
        <form method='POST' action='/bill/create' class=''>
            {{ csrf_field() }}

            <div class="input-group">
                <span class='input-group-addon' id='basic-addon1'>Split how many ways?</span>
                <input type='text'
                       class='form-control'
                       id='numberOfWays'
                       name='numberOfWays'
                       placeholder='eg. 3'
                       aria-describedby='basic-addon1'
                       value='{{ old('numberOfWays', $numberOfWays) }}'>
                <span class='input-group-addon' id='basic-addon3'>* Required</span>
            </div>
            @include('module.error-field', ['field' => 'numberOfWays'])

            <div class="input-group">
                <span class='input-group-addon' id='basic-addon2'>How much was the tab?</span>
                <input type='text'
                       class='form-control'
                       id='total'
                       name='total'
                       placeholder='eg. 49.99'
                       aria-describedby='basic-addon2'
                       value='{{ old('total', $total) }}'>
                <span class='input-group-addon' id='basic-addon4'>* Required</span>
            </div>
            @include('module.error-field', ['field' => 'total'])

            <div class="input-group">
                <label class="input-group-addon" for="serviceSelect">How was the service? </label>
                <select name="service" class="custom-select form-control" id="serviceSelect">
                    <option value="20" {{(old('service', $service) == 20) ? 'selected' : ''}}>Excellent (20% Tip)</option>
                    <option value="18" {{(old('service', $service) == 18) ? 'selected' : ''}}>Good (18% Tip)</option>
                    <option value="15" {{(old('service', $service) == 15) ? 'selected' : ''}}>Fair (15% Tip)</option>
                    <option value="10" {{(old('service', $service) == 10) ? 'selected' : ''}}>Bad (10% Tip)</option>
                </select>
            </div>
            <div class="input-group">
                <label class="form-check-label" for="defaultCheck1">Round up</label>
                <input name="roundUp"
                       class="form-control form-check-input"
                       type="checkbox"
                       value="1"
                       id="defaultCheck1"
                        {{old('roundUp', $roundUp) ? 'checked' : ''}}
                >
            </div>
            <input type='submit' class='btn btn-primary btn-md' value='Calculate'>
        </form>
        @if(count($errors) > 0)
            <div class='alert alert-danger'>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if($total)
            <p class='alert alert-success'>{{'Each person owes: ' . $resultTotal}} </p>
        @endif
    </div>
@endsection
