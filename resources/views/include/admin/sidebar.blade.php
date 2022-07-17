@php
$routeName = \Route::currentRouteName();
$routeUser = [
    'admin.user.index',
    'admin.user.create',
    'admin.user.store',
    'admin.user.show',
    'admin.user.edit',
    'admin.user.update'
];
$routeContact = [
    'admin.contact.index',
    'admin.contact.create',
    'admin.contact.store',
    'admin.contact.show',
    'admin.contact.edit',
    'admin.contact.update'
];
$routeRequest = [
    'admin.request.index',
    'admin.request.create',
    'admin.request.store',
    'admin.request.show',
    'admin.request.edit',
    'admin.request.update'
];
@endphp
<div class="sidebar sidebar-dark sidebar-fixed sidebar-lg-show" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img class="sidebar-brand-full" src="{{ url('images/logo.png') }}" width="55" height="46">
        <img class="sidebar-brand-narrow" src="{{ url('images/logo.png') }}" width="55" height="46">
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset">
                    <div class="simplebar-content-wrapper">
                        <div class="simplebar-content">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                                    <i class="nav-icon fa fa-home" aria-hidden="true"></i>
                                    ホーム
                                </a>
                            </li>
                        </div>
                        <div class="simplebar-content">
                            <li class="nav-item">
                                <a class="nav-link {{ in_array($routeName, $routeUser) ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                                    <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                                    ユーザー管理
                                </a>
                            </li>
                        </div>
                        <div class="simplebar-content">
                            <li class="nav-item">
                                <a class="nav-link {{ in_array($routeName, $routeContact) ? 'active' : '' }}" href="{{ route('admin.contact.index') }}">
                                    <i class="nav-icon fa fa-phone" aria-hidden="true"></i>
                                    問い合わせ一覧
                                </a>
                            </li>
                        </div>
                        <div class="simplebar-content">
                            <li class="nav-item">
                                <a class="nav-link {{ in_array($routeName, $routeRequest) ? 'active' : '' }}" href="{{ route('admin.request.index') }}">
                                    <i class="nav-icon fa fa-retweet" aria-hidden="true"></i>
                                    リストリクエスト
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="simplebar-placeholder" style="width: auto; height: 841px;"></div> --}}
        {{-- </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 93px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div> --}}
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
