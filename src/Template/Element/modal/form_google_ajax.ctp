<div class="modal fade loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div  style="padding: 20px">
                <h1 class="text-center login-title">Sending photo users</h1>
                <div class="progress progress-striped active" >
                    <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <div class="counting"></div>
                    </div>

                </div>
                <div class="bg-info">
                    <div  id="status"></div>
                    <div class="text-danger" id="user"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(function () {
        $('.loginModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $.post( "/students/count_student", function(data) {
            $("#count_user").text(data.length);
            var count = 0;
            var max = data.length;
            $(".progress-bar").attr('aria-valuemax',max);
            $.each(data, function(key,value){
                $("#status").text('Sending :'+1+" from "+max);
                $("#user").text("User: "+value.user_name+"@tdmu.edu.ua");
                $.post( "/sync/LDB_ToGoogle_photo/"+value.user_name, function(sync) {
                    if (sync=="Ok") {
                        $("#status").text('Sending :'+(count+1)+" from "+max);
                        $("#user").text("User: "+value.user_name+"@tdmu.edu.ua");
                        count++;

                        $(".progress-bar").attr('aria-valuenow',count);
                        $(".progress-bar").attr('style','width:'+count/max*100+'%');
                        $(".counting").text(Math.round(count/max*100)+'%');
                    }
                    if (count==max){
                        $('.loginModal').modal('hide')
                    }
                });

            });

        }, "json");
    });
</script>