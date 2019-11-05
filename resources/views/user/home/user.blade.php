@inject('mainPresenter', 'App\Presenters\MainPresenter')
@extends('user.basic.mainHome')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
@endsection

@section('pageJs')
    <script src="{{ asset('js/home/index.js') }}"></script>
@endsection

@section('navbar')
    @include('user.basic.header')
@endsection

@section('footer')
    @include('user.basic.footer')
@endsection

@section('contents')
    <div class="card">
        <div class="card-header">
            <div class="btn">{{ $mainPresenter->showText('user') }}<small class="ml-3 text-secondary">@if($user->times){{ $user->times }} {{ $mainPresenter->showText('userLoginTimes') }}@endif</small></div>
            @include('user.home.common.userMailCheck')
        </div>
        <div class="card-body message-board">
            <form id="update-order-form" action="#" method="POST" onsubmit="return false">
                <table class="table table-hover" style="border: 1px solid #dee2e6;">
                    <tbody>
                    <tr>
                        <th scope="row">{{ $mainPresenter->showText('userName') }}</th>
                        <td><label class="js-user-name">{{ $user->name }}</label><input type="text" name="name" value="{{ $user->name }}" class="js-user js-user-input-name hide"></td>
                        <td>
                            <a href="#" class="js-user-modify" data-class="js-user-name" data-input="js-user-input-name">{{ $mainPresenter->showText('userToChange') }}</a>
                            <a href="#" class="js-user-reset js-user-name hide" data-class="js-user-name" data-input="js-user-input-name" data-value="{{ $user->name }}">還原</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">{{ $mainPresenter->showText('userEmail') }}</th>
                        <td><label class="js-user-email">{{ $user->email }}</label><input type="text" name="email" value="{{ $user->email }}" class="js-user js-user-input-email hide"></td>
                        <td>
                            <a href="#" class="js-user-modify" data-class="js-user-email" data-input="js-user-input-email">{{ $mainPresenter->showText('userToChange') }}</a>
                            <a href="#" class="js-user-reset js-user-email hide" data-class="js-user-email" data-input="js-user-input-email" data-value="{{ $user->email }}">還原</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">{{ $mainPresenter->showText('userSexType') }}</th>
                        <td>
                            <label class="js-user-sex">{{ $mainPresenter->showText('userSex.' . $user->sex) }}</label>
                            <select class="js-user js-user-input-sex hide" name="sex">
                                @foreach($mainPresenter->showText('userSex') as $key => $text)
                                    <option value="{{ $key }}" @if($user->sex == $key) selected @endif>{{ $text }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a href="#" class="js-user-modify" data-class="js-user-sex" data-input="js-user-input-sex">{{ $mainPresenter->showText('userToChange') }}</a>
                            <a href="#" class="js-user-reset js-user-sex hide" data-class="js-user-sex" data-input="js-user-input-sex" data-value="{{ $user->sex }}">{{ $mainPresenter->showText('userToRevert') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">{{ $mainPresenter->showText('userPhone') }}</th>
                        <td><label class="js-user-phone">{{ $user->phone }}</label><input type="text" name="phone" value="{{ $user->phone }}" class="js-user js-user-input-phone hide"></td>
                        <td>
                            <a href="#" class="js-user-modify" data-class="js-user-phone" data-input="js-user-input-phone">{{ $mainPresenter->showText('userToChange') }}</a>
                            <a href="#" class="js-user-reset js-user-phone hide" data-class="js-user-phone" data-input="js-user-input-phone" data-value="{{ $user->phone }}">{{ $mainPresenter->showText('userToRevert') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">{{ $mainPresenter->showText('userAddress') }}</th>
                        <td><label class="js-user-address">{{ $user->address }}</label><input type="text" name="address" value="{{ $user->address }}" class="js-user js-user-input-address hide"></td>
                        <td>
                            <a href="#" class="js-user-modify" data-class="js-user-address" data-input="js-user-input-address">{{ $mainPresenter->showText('userToChange') }}</a>
                            <a href="#" class="js-user-reset js-user-address hide" data-class="js-user-address" data-input="js-user-input-address" data-value="{{ $user->address }}">{{ $mainPresenter->showText('userToRevert') }}</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="button" class="btn btn-danger js-user-update hide">{{ $mainPresenter->showText('userToSave') }}</button>
                </div>
            </form>
        </div>
        @include('user.home.common.tool')
    </div>
@endsection
