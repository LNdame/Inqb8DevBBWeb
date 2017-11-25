@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
    <?php $users = App\User::all(); $beer_lovers = App\BeerLover::all(); $establishments = App\Establishment::all();
    $beers = App\Beer::all();$promotions = App\Promotion::all();?>
    <div class="container-fluid" style="background-color:white">
		<div class="row">
            <center><h4 style="font-weight: bolder!important;">Beerly Beloved Dashboard</h4></center>
            <div class="col-md-4 well-lg">
                <div class="box box-success">
                    <div class="box-header with-border">
                        {{--<h3>Users Report</h3>--}}
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="io ion-ios-people"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number">{{count($users)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%"></div>
                                </div>
                                <span class="progress-description">48% Increase in the past week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 well-lg">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        {{--<h3>Articles</h3>--}}
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Beer Lovers</span>
                                <span class="info-box-number">{{count($beer_lovers)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%"></div>
                                </div>
                                <span class="progress-description">25% Increase in the past week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 well-lg">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        {{--<h3>Users Report</h3>--}}
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="io ion-ios-contacts"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Establishments</span>
                                <span class="info-box-number">{{count($establishments)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%"></div>
                                </div>
                                <span class="progress-description">61% Increase in the past week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-4 well-lg">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        {{--<h3>Users Report</h3>--}}
                        <div class="info-box bg-blue-active">
                            <span class="info-box-icon"><i class="io ion-ios-happy"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Promotions</span>
                                <span class="info-box-number">{{count($promotions)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%"></div>
                                </div>
                                <span class="progress-description">78% Increase in the past week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 well-lg">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        {{--<h3>Articles</h3>--}}
                        <div class="info-box bg-gray-light">
                            <span class="info-box-icon"><i class="ion ion-ios-beer"></i> </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Beers</span>
                                <span class="info-box-number">{{count($beers)}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%"></div>
                                </div>
                                <span class="progress-description">37% Increase in the past week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
	</div>
@endsection
