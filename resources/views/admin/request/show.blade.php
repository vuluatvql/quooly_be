@extends('layouts.admin')

@section('content')
<request-show :data="{{ json_encode([
    'urlEdit' => route('admin.request.edit', $request['id']),
    'urlBack' => session()->get('admin.request.list')[0] ?? route('admin.request.index'),
    'request' => $request
]) }}"></request-show>
@endsection
