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
                    <div class="panel-heading">Кабинет</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Тип</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Название</th>
                                <th scope="col">Права пользователя</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cabs as $cab)
                                    <tr>
                                        <th scope="row"><a href="{{ route('cab.show', $cab['account_id']) }}">{{$cab['account_id']}}</a></th>
                                        <td>{{$cab['account_type'] === 'general' ? 'Обычный': 'Агентский'}}</td>
                                        <td>{{$cab['account_status'] === 1 ? 'Активен' : 'Неактивен'}}</td>
                                        <td>{{$cab['account_name']}}</td>
                                        <td>{{$cab['access_role']}}</td>
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
