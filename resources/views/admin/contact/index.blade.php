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
                            <label>問い合わせ一覧</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="searchFrom pull-right">
                                        <form action="{{ route('admin.contact.index') }}" class="form-inline">
                                            <div>
                                                <input name="search_input" class="form-control" placeholder="検索"
                                                    value="{{ $request->search_input }}" autocomplete="off" type="control"
                                                    id="search_input">
                                                <button type="submit" class="btn btn-primary w-100"><i
                                                        class="fa fa-search"></i> &nbsp; 検索</button>
                                            </div>
                                            <!-- <a href="{{ route('admin.contact.create') }}" class="btn btn-primary btn-action-create">
                                                <i class="fa fa-plus"></i>新規登録
                                            </a> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if (!$contacts->isEmpty())
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12 group-select-page d-flex">
                                        <limit-page-option :limit-page-option="{{ json_encode([20, 50, 100]) }}"
                                            :new-size-limit="{{ $newSizeLimit }}"></limit-page-option>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12 group-paginate">
                                        {{ $contacts->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
                                    </div>
                                </div>
                                <table class="table table-responsive-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>
                                                @sortablelink('first_name', 'お名前 (姓)')
                                            </th>
                                            <th>
                                                @sortablelink('last_name', 'お名前 (名)')
                                            </th>
                                            <th>
                                                @sortablelink('first_name_furigana', 'ふりがな (姓)')
                                            </th>
                                            <th>
                                                @sortablelink('last_name_furigana', 'ふりがな (名)')
                                            </th>
                                            <th>
                                                @sortablelink('email', 'メールアドレス')
                                            </th>
                                            <th>
                                                @sortablelink('status', '状態')
                                            </th>
                                            <th class="w-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>
                                                    {{ $contact->first_name }}

                                                </td>
                                                <td>
                                                    {{ $contact->last_name }}

                                                </td>
                                                <td>
                                                    {{ $contact->first_name_furigana }}

                                                </td>
                                                <td>
                                                    {{ $contact->last_name_furigana }}

                                                </td>
                                                <td>
                                                    {{ $contact->email }}

                                                </td>
                                                <td>
                                                    {{ $contact->contact_status_text }}
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" id="action" type="button" data-coreui-toggle="dropdown" aria-expanded="false">操作選択</button>
                                                        <ul class="dropdown-menu" aria-labelledby="action">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('admin.contact.edit', $contact->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fa fa-eye"></i>確認・編集
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <btn-delete-confirm
                                                                    :message-confirm="{{ json_encode('このユーザーを削除しますか？') }}"
                                                                    :delete-action="{{ json_encode(route('admin.contact.destroy', $contact->id)) }}">
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
                                    {{ $contacts->appends(SearchQueryComponent::alterQuery($request))->links('pagination.admin') }}
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
