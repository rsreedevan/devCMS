@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Roles</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created On</th>
                      <th>Roles</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                          @foreach($user->roles as $role)
                            <span class="badge bg-warning">{{ $role }}</span>
                          @endforeach
                        </td>
                        <td>
                            <a class="btn " href="{{ route('user.edit', $user->id) }}"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn  btn-danger btn-s" onclick="return confirm('Are you sure ?')" href="{{route('user.destroy',$user->id)}}"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create a User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="user/create">
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
                    <input type="email"  name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter email">
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
                    <input type="name"  name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter your name">
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-12"><h5>Roles</h5> </div>
                    @foreach($roles as $role)
                      <div class="col-sm-4 col-md-6">
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="roles[]" class="custom-control-input" value="{{$role->name}}" id="{{$role->id}}">
                            <label class="custom-control-label" for="{{$role->id}}">{{$role->name}}</label>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-12"><h5>Permissions</h5> </div>
                    @foreach($permissions as $permission)
                      <div class="col-sm-4 col-md-6">
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="permissions[]" class="custom-control-input" value="{{$permission->name}}" id="permission{{$permission->id}}">
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
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
    </div>
@endsection