@extends('layout.tenant')

@section('title', __t('main_menu'))

@section('contents')
    <div class="content-wrapper">
        <main-menu :data="{{ json_encode($permissions)  }}"></main-menu>
    </div>
@endsection
