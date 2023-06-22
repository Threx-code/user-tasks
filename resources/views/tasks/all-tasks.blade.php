@extends("layouts.app")
@section("content")
    @include('nav_bar')
    @include('tasks.filter-by-project')
    <div class="table all-tasks">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Task Name</th>
                <th scope="col">Priority</th>
                <th scope="col">Project Name</th>
                <th scope="col">Date Created</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($tasks))
                @foreach($tasks as $key => $task)
                    <tr class="task-row{{$task->id}}">
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->projects->name ?? ''}}</td>
                        <td>{{ $task->created_at }}</td>
                        <td><a href="{{url('task/edit/'. $task->id)}}">Edit</a></td>
                        <td>
                            <form method="post" class="delete{{$task->id}}" action="{{ route('task.delete')}}">
                                @csrf
                                <input type="hidden" name="task_id"  value="{{$task->id}}" >
                                <input type="submit" class="submit{{$task->id}}" value="Delete">
                            </form>

                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $(".delete{{$task->id}}").on("submit", (function(e){
                                        e.preventDefault();
                                        $(".submitLoader").show();
                                        $.ajaxSetup({
                                            headers:{
                                                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                                            }
                                        });

                                        $.ajax({
                                            url:"{{ route('task.delete')}}",
                                            method:'POST',
                                            data:new FormData(this),
                                            contentType:false,
                                            processData:false,
                                            success:function(data){
                                                if(data == "Task deleted successfully"){
                                                    $('.task-row{{$task->id}}').hide();
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
            @endif
            </tbody>
        </table>
        {{$tasks->links()}}
    </div>
@endsection
