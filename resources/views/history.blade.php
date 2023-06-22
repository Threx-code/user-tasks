<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lucky Number History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">History</th>
                    </tr>
                    </thead>
                    <tbody class="historyResult"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".historyForm").on("submit", (function(e){
            e.preventDefault();
            $(".clickHistory").click();
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                }
            });

            $.ajax({
                url:"{{ route('history')}}",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){
                    $('.historyResult').html(data);
                },
                error:function(xhr){
                    var data = xhr.responseJSON;
                    if($.isEmptyObject(data.errors) == false){
                        $.each(data.errors, function(key, result){
                            $('.historyResult').html(result);
                        });
                    }
                }
            })
        }))
    })

</script>
