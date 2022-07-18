@extends('layouts.admin')

@section('content')
<request-show :data="{{ json_encode([
    'urlEdit' => route('admin.request.edit', $request['id']),
    'urlBack' => route('admin.request.index'),
    'request' => $request
]) }}"></request-show>
@endsection
