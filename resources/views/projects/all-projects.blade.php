@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <p class="alert alert-info result" style="margin-left: 0px; margin-top: -3px; display: none;"></p>
    @if(!empty($projects))
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Project Name</th>
                <th scope="col">Date Created</th>
                <th scope="col">Total Tasks Created</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>

                @foreach($projects as $key => $project)
                    <tr class="project-row{{$project->id}}">
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ count($project->tasks) }}</td>
                        <td><a href="{{url('task/project/edit/'. $project->id)}}">Edit</a></td>
                        <td>
                            <form method="post" class="delete{{$project->id}}" action="{{ route('task.project.delete')}}">
                                @csrf
                                <input type="hidden" name="project_id" value="{{$project->id}}">
                                <input type="submit" class="submit{{$project->id}}" value="Delete">
                            </form>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $(".delete{{$project->id}}").on("submit", (function(e){
                                        e.preventDefault();
                                        $(".submitLoader").show();
                                        $.ajaxSetup({
                                            headers:{
                                                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                                            }
                                        });

                                        $.ajax({
                                            url:"{{ route('task.project.delete')}}",
                                            method:'POST',
                                            data:new FormData(this),
                                            contentType:false,
                                            processData:false,
                                            success:function(data){
                                                if(data == "Project deleted successfully"){
                                                    $('.project-row{{$project->id}}').hide();
                                                }
                                                $('.result').html(data);
                                            },
                                            error:function(xhr){
                                                var data = xhr.responseJSON;

                                                if($.isEmptyObject(data.errors) == false){
                                                    $.each(data.errors, function(key, result){
                                                        $('.result').html(result);
                                                    });
                                                }
                                            }
                                        })
                                    }))
                                })

                            </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$projects->links()}}
    @else

        <main role="main" class="container starter-template">
            <div class="row">
                    <div class="site-section">
                        <div class="container">
                            <div id="posts" class="row no-gutter">
                                <div class="col-lg-8 offset-lg-2 col-md-9 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h1>Sorry no project created yet</h1>
                                            <a href="{{url('/')}}" ><button type="submit" class="btn btn-primary mb-4">Create new project</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>



    @endif
@endsection
