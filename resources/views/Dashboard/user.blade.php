@extends('Dashboard.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                           User Id
                        </th>
                        <th style="width: 20%">
                             Name
                        </th>
                        <th style="width: 30%">
                            Image
                        </th>
                        <th>
                            Type
                        </th>

                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $users)
                    <tr>
                        <td>
                            {{$users->id}}
                        </td>
                        <td>
                            <a>
                                {{$users->name}}
                            </a>
                            <br/>
                            <small>
                                {{$users->created_at}}
                            </small>
                        </td>
                        <td>
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                </li>

                            </ul>
                        </td>

                        <td>
                            {{$users->userType}}
                        </td>

                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{route('users.show',$users)}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{route('users.edit',$users)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form action="{{route('users.destroy',$users)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">  Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection



