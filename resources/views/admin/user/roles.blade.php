@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Create a Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST" action="role/create" >
              @csrf
                <div class="card-body">
                @if(\Session::has('success'))
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ \Session::get('success') }}
                    </div>
                @endif
                @error('role_name')
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ $message }}
                    </div>
                @enderror
                <div class="input-group input-group-lg">
                  <input type="text"  name="role_name" placeholder="Enter role name" class="form-control">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-success btn-flat">Go!</button>
                  </span>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        @foreach($permissions as $permission)
                        <div class="col-sm-4 col-md-2">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-on-success">
                                <input type="checkbox" name="role_permissions[]" class="custom-control-input" value="{{$permission->name}}" id="{{$permission->id}}">
                                <label class="custom-control-label" for="{{$permission->id}}">{{$permission->name}}</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
    </div>
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
                      <th>Role Name</th>
                      <th>Created On</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)
                        <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                            <a class="btn "><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn  btn-danger btn-s" onclick="return confirm('Are you sure ?')" href="{{route('role.destroy',$role->id)}}"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                        <td>
                            @if($role->name === 'super.admin')
                                <span class="badge bg-danger">You can't delete Super Admin</span>
                            @else
                                <p></p>
                            @endif
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
    </div>
@endsection