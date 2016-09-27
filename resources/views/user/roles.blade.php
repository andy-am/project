@extends('layouts.app')

@section('content')


    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span>Name of project</span></th>
                                    <th class="text-center"><span>Created</span></th>
                                    <th class="text-center"><span>Status</span></th>
                                </thead>
                                <tbody>
                                @foreach($user->projects as $project)
                                    <tr>
                                        <td>
                                            <img src="https://content-static.upwork.com/blog/uploads/sites/4/2009/05/project-management.jpg" alt="">
                                            <a href="#" class="user-link">{{ $project->name }}</a>
                                            <span class="user-subhead">{{ $user->role }}</span>
                                        </td>

                                        <td class="text-center">{{ date('d.m.Y H:i', strtotime($project->created_at)) }}</td>

                                        <td>
                                            <a href="#">{{ $user->email }}</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop