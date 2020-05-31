@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update user - {{ $user->name }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    @error('email')
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ $message }}
                      </div>
                    @enderror
                    <label for="email">Email address</label>
                    <input type="email"  name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    @error('name')
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ $message }}
                      </div>
                    @enderror
                    <label for="name">Name</label>
                    <input type="name"  name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="Enter your name">
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-12"><h5>Roles</h5> </div>
                    @foreach($roles as $role)
                      <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" @if(in_array($role->name, $user->roles->toArray(), true)) checked @endif name="roles[]" class="custom-control-input" value="{{ $role->name}}" id="{{$role->id}}">
                            <label class="custom-control-label" for="{{ $role->id }}">{{$role->name}}</label>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-12"><h5>Permissions</h5> </div>
                    @foreach($permissions as $permission)
                      <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" @if(in_array($permission->name, $user->permissions->toArray(), true)) checked @endif name="permissions[]" class="custom-control-input" value="{{$permission->name}}" id="permission{{$permission->id}}">
                            <label class="custom-control-label" for="permission{{$permission->id}}">{{$permission->name}}</label>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                    <div class="form-check">
                      <input type="checkbox" name="newsletter" class="form-check-input" id="newsletter">
                      <label class="form-check-label" for="newsletter">Subscribe to newsletter</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="far fa-save"> </i>  Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
    </div> 
@endsection