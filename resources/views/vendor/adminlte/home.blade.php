@extends('adminlte::layouts.app')

{{--@section('htmlheader_title')--}}
	{{--{{ trans('adminlte_lang::message.home') }}--}}
{{--@endsection--}}


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			@yield('partials')
		</div>
	</div>
@endsection
