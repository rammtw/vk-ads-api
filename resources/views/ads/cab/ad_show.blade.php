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
                    <div class="panel-heading"><a href="{{ route('cab.show', $account->id) }}">К списку кампаний</a> | {{ $ad->name }}</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{$ad->id}}</th>
                                <td>{{$ad->name}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <h3>{{$ad->name}}</h3>
                        <p>Cтатус объявления: {{$ad->status}}</p>
                        <p>Дневной лимит: {{$ad->day_limit}}</p>
                        <p>Лимит объявления: {{$ad->all_limit}}</p>
                        <p>Цена за 1000 показов: {{$ad->cpm}} руб.</p>
                        <p>Ограничение показов: {{$ad->impressions_limited}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
