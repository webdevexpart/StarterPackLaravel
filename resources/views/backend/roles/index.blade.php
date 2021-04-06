@extends('layouts.backend.app')

@section('title', 'Roles')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Roles</div>
            </div>
            <div class="page-title-actions">
                @if(Auth::user()->hasPermission('app.roles.create'))
                <a href="{{ route('app.roles.create') }}" class="btn-shadow mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    <span class="ml-1">Create Role</span>
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Permissions</th>
                            <th class="text-center">Updated_At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                <td class="text-center">{{ $role->name }}</td>
                                <td class="text-center">
                                    @if($role->permissions->count() > 0)
                                        <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                                    @else
                                        <span class="badge badge-danger">No permission found :(</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @if(Auth::user()->hasPermission('app.roles.edit'))
                                    <a href="{{ route('app.roles.edit',$role->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(Auth::user()->hasPermission('app.roles.destroy'))
                                    @if($role->deletable == true)
                                    <button onclick="deleteData({{$role->id}})" type="button" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <form id="delete-form-{{ $role->id }}" method="POST" action="{{ route('app.roles.destroy',$role->id) }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush
