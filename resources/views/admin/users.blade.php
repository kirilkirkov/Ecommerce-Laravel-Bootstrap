@extends('layouts.app_admin')

@section('content')
<div class="card card-cascade narrower">
    <div class="table-responsive">
        <table class="table">
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>#</th>
                    <th>{{__('admin_pages.user_name')}}</th>
                    <th>{{__('admin_pages.user_email')}}</th>
                    <th>{{__('admin_pages.user_created_at')}}</th>
                    <th>{{__('admin_pages.user_updated_at')}}</th>
                    <th class="text-right">
                        <button class="btn btn-sm btn-secondary waves-effect waves-light" data-toggle="modal" data-target="#modalAddEditUsers">
                            {{__('admin_pages.add_user')}}
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td class="text-right">
                        <a href="?edit={{$user->id}}" class="btn btn-sm btn-secondary waves-effect waves-light">{{__('admin_pages.edit_user')}}</a>
                        <a href="{{lang_url('admin/delete/user/'.$user->id)}}" class="btn btn-sm btn-secondary waves-effect waves-light confirm" data-my-message="{{__('admin_pages.are_u_sure_delete_u')}}">{{__('admin_pages.delete_user')}}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $users->links() }}
<!-- Modal Add/Edit users -->
<div class="modal fade" id="modalAddEditUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{__('admin_pages.user_settings')}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="formManageUsers">
                    {{ csrf_field() }}
                    <input type="hidden" name="edit" value="{{isset($_GET['edit']) ? $_GET['edit'] : 0 }}">
                    <div class="md-form">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" name="name" value="{{$userInfo != null? $userInfo->name : ''}}" id="defaultForm-name" class="form-control">
                        <label for="defaultForm-name">{{__('admin_pages.user_name')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="text" name="email" value="{{$userInfo != null? $userInfo->email : ''}}" id="defaultForm-email" class="form-control">
                        <label for="defaultForm-email">{{__('admin_pages.user_email')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" name="password" id="defaultForm-pass" class="form-control">
                        <label for="defaultForm-pass">{{__('admin_pages.user_password')}}</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin_pages.close')}}</button>
                <button type="button" class="btn btn-secondary" onclick="updateUser()">{{__('admin_pages.save_changes')}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    @php
    if (isset($_GET['edit'])) {
        @endphp
        $(document).ready(function() {
            $('#modalAddEditUsers').modal('show');
        });
        $("#modalAddEditUsers").on("hidden.bs.modal", function() {
            window.location.href = "{{ lang_url('admin/users') }}";
        });
        @php
    }
    @endphp
</script>
@endsection