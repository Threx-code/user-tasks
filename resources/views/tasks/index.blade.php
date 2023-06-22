@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <main role="main" class="container starter-template">
        <div class="row">
            <div id="response"></div>
            <div class="col-lg-12 col-xs-12 tab-content">
                <div class="ftco-blocks-cover-1" style="margin-top: -150px;">
                    <div class="site-section-cover overlay">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h1 class="mb-3 text-primary">Create A Task</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-section">
                    <div class="container">
                        <div id="posts" class="row no-gutter">

                            <div class="col-lg-8 offset-lg-2 col-md-9 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form method="post" class="addNew_data" action="{{ route('task.store')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" name="name" aria-describedby="usernameHelp">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Priority</label>
                                                <div class="form-group">
                                                    <select class="form-control form-control-lg" name="priority">
                                                        <option value=""></option>
                                                        <option value="low">Low</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="high">High</option>
                                                        <option value="urgent">Urgent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if(!empty($projects))
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Projects</label>
                                                    <div class="form-group">
                                                        <select class="form-control form-control-lg" name="project_id">
                                                            <option value=""></option>
                                                            @foreach($projects as $key => $project)
                                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-primary mb-4">Submit</button>
                                            </div>
                                            <div class="submitLoader searchLoader" style="margin-left: 100px; margin-top: -73px;"></div>
                                            <p class="alert alert-info result" style="margin-left: 0px; margin-top: -3px; display: none;"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".addNew_data").on("submit", (function(e){
                e.preventDefault();
                $(".submitLoader").show();
                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    url:"{{ route('task.store')}}",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $(".submitLoader").hide();
                        $('.result').show();
                        $('.result').html(data);
                        if(data == "Profile data uploaded successfully") {
                            $(".addNew_data")[0].reset();
                        }
                    },
                    error:function(xhr){
                        var data = xhr.responseJSON;

                        if($.isEmptyObject(data.errors) == false){
                            $.each(data.errors, function(key, result){
                                $('.result').show();
                                $(".submitLoader").hide();
                                $('.result').html(result);
                            });
                        }
                    }
                })
            }))
        })

    </script>
@endsection
