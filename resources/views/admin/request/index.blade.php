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
                            <label>リストリクエスト</label>
                            <!-- <div class="box-action">
                                <a href="{{ route('admin.request.create') }}" class="btn btn-primary btn-action">
                                    <i class="fa fa-plus"></i>新規登録
                                </a>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="searchFrom pull-right">
                                        <form action="{{ route('admin.request.index') }}" class="form-inline">
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
                            @if (!$requests->isEmpty())
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12 group-select-page d-flex">
                                        <limit-page-option :limit-page-option="{{ json_encode([20, 50, 100]) }}"
                                            :new-size-limit="{{ $newSizeLimit }}"></limit-page-option>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12 group-paginate">
                                        {{ $requests->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
                                    </div>
                                </div>
                                <table class="table table-responsive-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>@sortablelink('name', '名前')</th>
                                            <th>@sortablelink('city', '市区都')</th>
                                            <th>@sortablelink('price_lower', '物件価格下限')</th>
                                            <th>@sortablelink('price_upper', '物件価格上限')</th>
                                            <th>@sortablelink('revenue_yield', '利回り')</th>
                                            <th>@sortablelink('construction_year', '築年数')</th>
                                            <th>@sortablelink('walkrange', '駅徒歩')</th>
                                            <th>@sortablelink('comment', '一言コメント')</th>
                                            <th>@sortablelink('created_at', '会員登録日')</th>
                                            <th class="w-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td>{{ $request->name }}</td>
                                                <td>{{ $request->city }}</td>
                                                <td>{{ $request->price_lower }}</td>
                                                <td>{{ $request->price_upper }}</td>
                                                <td>{{ $request->revenue_yield }}</td>
                                                <td>{{ $request->construction_year }}</td>
                                                <td>{{ $request->walkrange }}</td>
                                                <td>{{ $request->comment }}</td>
                                                <td>{{ Carbon::parse($request->created_at)->format('Y年m月d日') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" id="action"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-expanded="false">操作選択</button>
                                                        <ul class="dropdown-menu" aria-labelledby="action">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.request.show', $request->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fa fa-eye"></i>確認・編集
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <btn-delete-confirm
                                                                    :message-confirm="{{ json_encode('このユーザーを削除しますか？') }}"
                                                                    :delete-action="{{ json_encode(route('admin.request.destroy', $request->id)) }}">
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
                                    {{ $requests->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
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
