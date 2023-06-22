<div class="col-lg-12  col-md-5 col-sm-12 col-xs-12">
    <button class="btn btn-primary back-btn" style="float: left; display: none">Back</button>
    <div class="row">
        <div class="col-lg-4 offset-lg-8 col-md-12 col-sm-12 col-xs-12">
            <form method="post" class="addNew_data" action="{{ route('task.project-tasks')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Filter by Projects</label>
                    <div class="form-group">
                        <select class="form-control form-control-lg project-selector" name="project_id">
                            <option value=""></option>
                            @if(!empty($projects))
                                @foreach($projects as $key => $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="table specific-task"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".project-selector").on("change", (function(){
            var project_id = $(".project-selector").val();
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                }
            });

           $.ajax({
                url:"{{ route('task.project-tasks')}}",
                method:'POST',
                data:"project_id="+project_id,
                dataType:"text",
                success:function(data){
                    $(".all-tasks").hide();
                    $(".back-btn").show()
                    $(".specific-task").show()
                    $('.specific-task').html(data);
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
        }));

        $(".back-btn").click( function(){
            $(".all-tasks").show();
            $(".specific-task").hide()
            $(".back-btn").hide()
        })
    })

</script>
