@extends('layouts.app_public')

@section('content')
<div class="contacts-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 section-title">
                <h2>{{__('public_pages.contacts')}}</h2>
            </div>
            <div class="col-xs-12">
                <form method="POST" action="">
                    {{ csrf_field() }}
                    <input type="text" class="form-control" placeholder="{{__('public_pages.client_email')}}" name="client_email">
                    <textarea class="form-control" placeholder="{{__('public_pages.client_message')}}" name="client_message"></textarea>
                    <button type="submit" class="submit">{{__('public_pages.send_message')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
