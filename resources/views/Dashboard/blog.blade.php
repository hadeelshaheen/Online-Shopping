
@extends('Dashboard.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blogs</h3>

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
                            Id
                        </th>
                        <th style="width: 20%">
                            User Name
                        </th>
                        <th style="width: 30%">
                            Image
                        </th>
                        <th>
                            Content
                        </th>

                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blog as $blogs)
                    <tr>
                        <td>
                            {{$blogs->id}}
                        </td>
                        <td>
                            <a>
                                {{$blogs->name}}
                            </a>
                            <br/>
                            <small>
                                {{$blogs->created_at}}
                            </small>
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" width="300px" height="200px"  src="{{$blogs->image}}">
                                </li>

                            </ul>
                        </td>

                        <td class="project-state">
                            <span class=>{{$blogs->post}}</span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{route('blogs.show',$blogs)}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{route('blogs.edit',$blogs)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>

                            <form action="{{route('blogs.destroy',$blogs)}}" method="POST">
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
