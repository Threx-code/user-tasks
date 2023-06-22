<div class="modal fade" id="luckyNumber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lucky Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Your lucky number is <span id="result" style="font-size: 50px;"></span> <span id="win"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".feelingLucky").on("submit", (function(e){
            e.preventDefault();
            $(".clickLucky").click();
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                }
            });

            $.ajax({
                url:"{{ route('feeling-lucky')}}",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){
                    if(data == 0){
                        $("#win").html("You loose")
                    }else{
                        $("#win").html("You win")
                    }
                    $('#result').html(data);
                },
                error:function(xhr){
                    var data = xhr.responseJSON;

                    if($.isEmptyObject(data.errors) == false){
                        $.each(data.errors, function(key, result){
                            $('#result').html(result);
                        });
                    }
                }
            })
        }))
    })

</script>
