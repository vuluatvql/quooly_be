@extends('layouts.admin')

@section('content')
<contact-edit :data="{{ json_encode([
    'urlUpdate' => route('admin.contact.update', $contact->id),
    'contact' => $contact,
    'contactStatusList' => $contact_status_list,
    'urlBack' => session()->get('admin.contact.list')[0] ?? route('admin.contact.index')
    ]) }}">
</contact-edit>
@endsection
