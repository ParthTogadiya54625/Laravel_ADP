@extends('frontend.layouts.main_layout')
@section('title', 'dashboard')
@push('page_css')
@endpush

@section('content')
    <h3 style="display: inline;">Welcome : {{auth()->user()->full_name}} ({{ucwords(str_replace("-", " ", auth()->user()->roles[0]->name))}})</h3>
@endsection

@push('page_script')
@endpush
