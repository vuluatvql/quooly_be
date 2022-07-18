@extends('layouts.admin')

@section('content')
<user-create :data="{{ json_encode([
    'urlStore' => route('admin.user.store'),
    'urlCheckEmail' => route('admin.user.checkEmail'),
    'urlBack' => session()->get('admin.user.list')[0] ?? route('admin.user.index'),
    'industryTypes' => $industryTypes ?? [],
    'jobTypes' => $jobTypes ?? [],
    'propertyBuilding' => $propertyBuilding ?? [],
    'propertyDivision' => $propertyDivision ?? [],
    'propertyKodateChintai' => $propertyKodateChintai ?? [],
    'prefectures' => $prefectures ?? [],
]) }}"></user-create>
@endsection
