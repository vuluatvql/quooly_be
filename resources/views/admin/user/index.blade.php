@php
use App\Components\SearchQueryComponent;
use Carbon\Carbon;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <label>ユーザー管理</label>
                            <div class="box-action">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-action">
                                    <i class="fa fa-plus"></i>新規登録
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="searchFrom pull-right">
                                        <form action="{{ route('admin.user.index') }}" class="form-inline">
                                            <div>
                                                <input name="search_input" class="form-control"
                                                    placeholder="お名前、メールアドレスから検索" value="{{ $request->search_input }}"
                                                    autocomplete="off" type="control" id="search_input">
                                                <button type="submit" class="btn btn-primary w-100"><i
                                                        class="fa fa-search"></i> &nbsp; 検索</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if (!$users->isEmpty())
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12 group-select-page d-flex">
                                        <limit-page-option :limit-page-option="{{ json_encode([20, 50, 100]) }}"
                                            :new-size-limit="{{ $newSizeLimit }}"></limit-page-option>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12 group-paginate">
                                        {{ $users->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
                                    </div>
                                </div>
                                <table class="table table-responsive-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>@sortablelink('name', 'お名前')</th>
                                            <th>@sortablelink('furigana_name', 'ふりがな')</th>
                                            <th>@sortablelink('email', 'メールアドレス')</th>
                                            <th>@sortablelink('phone_number', '電話番号')</th>
                                            <th>@sortablelink('userOptional.annual_income', '年収')</th>
                                            <th>@sortablelink('userOptional.user_income', '自己資金')</th>
                                            <th>@sortablelink('created_at', '会員登録日')</th>
                                            <th class="w-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->furigana_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->userOptional?->annual_income }}</td>
                                                <td>{{ $user->userOptional?->user_income }}</td>
                                                <td>{{ Carbon::parse($user->created_at)->format('Y年m月d日') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" id="action"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-expanded="false">操作選択</button>
                                                        <ul class="dropdown-menu" aria-labelledby="action">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.user.edit', $user->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fa fa-eye"></i>確認・編集
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <btn-delete-confirm
                                                                    :message-confirm="{{ json_encode('このユーザーを削除しますか？') }}"
                                                                    :delete-action="{{ json_encode(route('admin.user.destroy', $user->id)) }}">
                                                                </btn-delete-confirm>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="group-paginate">
                                    {{ $users->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
                                </div>
                            @else
                                <data-empty></data-empty>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
