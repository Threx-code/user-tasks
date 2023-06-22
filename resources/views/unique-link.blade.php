@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <div class="col-lg-12 col-xs-12 tab-content">
        <div class="container">
            <div class="row justify-content-md-center align-items-center">
                <div class="col-md-7  offset-md-1">
                    <h1>What would you like to do?</h1>
                </div>
                <div class="col-md-7  mt-5">
                    <div id="response"></div>
                    <div class="row">

                        <!--================ start of generate link ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="generateLink" action="{{ route('generate-link')}}">
                                @csrf
                                <input name="token" type="hidden" value="{{$request->token}}" />
                                <button type="submit" class="btn btn-primary btn-lg extra-lg-btn">Generate New Link</button>
                            </form>
                        </div>
                        <!--================ start of Deactivate link ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="deactivateLink" action="{{ route('deactivate-link')}}">
                                @csrf
                                <input name="token" type="hidden" value="{{$request->token}}" />
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">Deactivate Link</button>
                            </form>
                        </div>
                        <!--================ start of I'm felling lucky ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="feelingLucky" action="{{ route('feeling-lucky')}}">
                                @csrf
                                <input name="token" type="hidden" value="{{$request->token}}" />
                                <input  type="hidden" data-toggle="modal" data-target="#luckyNumber" class="clickLucky"/>
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">I'm Feeling Lucky</button>
                            </form>
                        </div>
                        <!--================ start of History ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="historyForm" action="{{ route('history')}}">
                                @csrf
                                <input  type="hidden" data-toggle="modal" data-target="#history" class="clickHistory"/>
                                <input name="token" type="hidden" value="{{$request->token}}" />
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">History</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".generateLink").on("submit", (function(e){
                e.preventDefault();
                $(".submitLoader").show();
                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    url:"{{ route('generate-link')}}",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $(".submitLoader").hide();
                        $('.result').show();
                        $('#response').html(data);
                    },
                    error:function(xhr){
                        var data = xhr.responseJSON;

                        if($.isEmptyObject(data.errors) == false){
                            $.each(data.errors, function(key, result){
                                $('#response').show();
                                $(".submitLoader").hide();
                                $('#response').html(result);
                            });
                        }
                    }
                })
            }))
        });


        $(document).ready(function(){
            $(".deactivateLink").on("submit", (function(e){
                e.preventDefault();
                $(".submitLoader").show();
                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    url:"{{ route('deactivate-link')}}",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        if(data == 'link deactivated'){
                            location.reload();
                        }
                    },
                    error:function(xhr){
                        var data = xhr.responseJSON;

                        if($.isEmptyObject(data.errors) == false){
                            $.each(data.errors, function(key, result){
                                $('#response').show();
                                $(".submitLoader").hide();
                                $('#response').html(result);
                            });
                        }
                    }
                })
            }))
        })

    </script>

    @include('lucky-number')
    @include('history')
@endsection
