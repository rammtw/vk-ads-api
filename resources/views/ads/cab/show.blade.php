@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="{{auth()->user()->photo}}" alt="">
                        <p>{{auth()->user()->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="/cab">К списку кабинетов</a> | {{ $account->name }}</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr>
                                    <th scope="row"><a href="{{ route('ad.show', ['account' => $account->id , 'ad' => $ad->id]) }}">{{$ad->id}}</a></th>
                                    <td>{{$ad->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
