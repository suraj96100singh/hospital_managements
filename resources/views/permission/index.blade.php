@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Permisstion Management</h2>
        </div>
        <div class="pull-right">
        {{-- @can('permission-create') --}}
            <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New Permission</a>
            {{-- @endcan --}}
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Permission Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($permission as $key => $permissions)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permissions->name }}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('permisstion.show',$permissions->id) }}">Show</a> --}}
            {{-- @can('permission-edit') --}}
                <a class="btn btn-primary" href="{{ route('permissions.edit',$permissions->id) }}">Edit</a>
            {{-- @endcan --}}
            {{-- @can('permission-delete') --}}
                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permissions->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            {{-- @endcan --}}
        </td>
    </tr>
    @endforeach
</table>


{!! $permission->render() !!}


@endsection