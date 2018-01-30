$(document).ready(function() {

    $('#add-user').on('submit', function() {
        $(this).submit();
    });

    setInterval(function(){
        $.ajax({
            url: base_url+"get/incomming/call",
            type: "post",
            success: function(message) {
                if(message){
                    if($('#is_calling').val() == 0){
                        document.getElementById('ringtone').play();
                        $('#is_calling').val('1');
                        message = JSON.parse(message);
                        $('#call_id').val(message.id);
                        $('#caller_id').val(message.caller_id);
                        $('#receiver_id').val(message.receiver_id);
                        $('#caller').html(message.caller_name);
                        document.getElementById('call-ring').style.display = 'block';
                    }
                }
            }
        });
    }, 3000);

    $('#cancel-call').on('click', function(){
        var call_id = $('#call_id').val();
        document.getElementById('ringtone').pause();
        $.ajax({
            url: base_url+"post/cancel/call",
            type: "post",
            data: {call_id: call_id, status: 2},
            success: function(message) {
                $('#call_id').val('0');
                $('#is_calling').val('0');
                $('#caller_id').val('0');
                $('#receiver_id').val('0');
                document.getElementById('call-ring').style.display='none';
            }
        });
    });

    $('#call-receive').on('click', function(){
        var call_id = $('#call_id').val();
        var caller_id = $('#caller_id').val();
        var receiver_id = $('#receiver_id').val();
        document.getElementById('ringtone').pause();
        $.ajax({
            url: base_url+"post/cancel/call",
            type: "post",
            data: {call_id: call_id, status: 1},
            success: function(message) {
                $('#call_id').val('0');
                $('#is_calling').val('0');
                $('#caller_id').val('0');
                $('#receiver_id').val('0');
                document.getElementById('call-ring').style.display='none';
                window.open(base_url+"private/call/receive/"+call_id+"/"+caller_id+"/"+receiver_id,'_blank');
            }
        });
    });
    
    // setTimeout(function() {
    //     document.getElementById('call-ring').style.display = 'block';
    // }, 5000);
});