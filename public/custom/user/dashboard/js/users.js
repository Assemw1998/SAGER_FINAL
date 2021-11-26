$(document).ready( function () {
    $(".page-title").html("Users");
    $('#users_table').DataTable();
    var token=$('meta[name="csrf-token"]').attr('content');
    var html_for_passwords_area='<div class="col-4"><label for="current_password" class="form-label">Current Password</label><input type="password" class="form-control user-data"  name="current_password" placeholder="Current Password"></div> <div class="col-4"><label for="password" class="form-label">New Password</label><input type="password" class="form-control user-data"  name="password" placeholder="New Password"></div><div class="col-4"><label for="confirm_password" class="form-label">Confirm New Password</label><input type="password" class="form-control user-data"  name="confirm_password" placeholder="Confirm New Password"></div>';
    
    $(document).on("click",".update",function() {
        var user_id=$(this).attr("data-id");
        $(".user-id-area").html(user_id);
        $.ajax({
            type:'POST',
            url:'/dashboard/users/get',
            data: {
                _token:token,
                id:user_id,
            },
            success: function(data) {
                $.each(data, function( index, value ) {
                    $('#'+index).val(value)
                });
            },
        }).fail(function(jqXHR, textStatus, errorThrown) {
            Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
        });
    });

    $(document).on("click",".show-passwords-btn",function() {
        $('.password-area').append(html_for_passwords_area);
        $(this).html('<i class="fas fa-arrow-circle-up"></i>');
        $(this).removeClass('show-passwords-btn');
        $(this).removeClass('btn-outline-dark');
        $(this).addClass('hide-passwords-btn');
        $(this).addClass('btn-outline-success');

    });

    $(document).on("click",".hide-passwords-btn",function() {
        $('.password-area').empty();
        $(this).html('Change Password');
        $(this).removeClass('hide-passwords-btn');
        $(this).removeClass('btn-outline-success');
        $(this).addClass('show-passwords-btn');
        $(this).addClass('btn-outline-dark');

    });


    $(document).on("click",".save-updated-data",function() {
        var data={},user_id=$(".user-id-area").html(),flage=true,error="";
        data['id']=user_id;

        $(".user-data").each(function() {
            if($(this).val()!=""){
                data[$(this).attr('name')]=$(this).val();
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!"
            }
        });

        if(!isEmail(data['email'])){
            flage=false;
            error="Invalid Email";
            $("#email").css('border-color','red');
        }

        if((data['password'])){
            if(data['password']!=data['confirm_password']){
                flage=false;
                error="The new password and confirmation password do not match.!";
                $("input[name='password']").css('border-color','red');
                $("input[name='confirm_password']").css('border-color','red');
            }else if(!PasswordValidation(data['password'])){
                flage=false;
                error="New password does not follow the standes!";
                $("input[name='password']").css('border-color','red');
                $("input[name='confirm_password']").css('border-color','red');
            }
        }

        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            $.ajax({
                type:'POST',
                url:'/dashboard/users/update',
                data: {
                    _token:token,
                    id:user_id,
                    data:data
                },
                success: function(data) {
                    if(data==1){
                        Alert('Updated','User information have been updated successfully','green','btn-green',true);
                    }else{
                        Alert('Validation Error',data,'red','btn-red',false);
                    }
                    
                },
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
            });
        }
    });

    $(document).on("click",".add-new-user-btn",function() {
        var data={},flage=true,error="";

        $(".user-data-add").each(function() {
            if($(this).val()!=""){
                data[$(this).attr('name')]=$(this).val();
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!"
            }
        });

        if(!isEmail(data['email'])){
            flage=false;
            error="Invalid Email";
            $("#email").css('border-color','red');
        }

        if((data['password'])){
            if(data['password']!=data['confirm_password']){
                flage=false;
                error="The password and confirmation password do not match.!";
                $("input[name='password']").css('border-color','red');
                $("input[name='confirm_password']").css('border-color','red');
            }else if(!PasswordValidation(data['password'])){
                flage=false;
                error="Password does not follow the standes!";
                $("input[name='password']").css('border-color','red');
                $("input[name='confirm_password']").css('border-color','red');
            }
        }

        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            $.ajax({
                type:'POST',
                url:'/dashboard/users/add',
                data: {
                    _token:token,
                    data:data
                },
                success: function(data) {
                    if(data==1){
                        Alert('Added','User has been added successfully','green','btn-green',true);
                    }else{
                        Alert('Validation Error',data,'red','btn-red',false);
                    }
                },
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
            });
        }
    });


    $(document).on("click",".delete",function() {
        var user_id=$(this).attr('data-id') 
        $.confirm({
            title: 'User delete',
            content:'are you sure that you wnat to delete this user?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Yes: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type:'POST',
                            url:'/dashboard/users/delete',
                            data: {
                                _token:token,
                                id:user_id,
                            },
                            success: function(data) {
                                if(data==1){
                                    Alert('Deleted','User has been deleted successfully','green','btn-green',true);
                                }else{
                                    Alert('Validation Error',data,'red','btn-red',false);
                                }
                                
                            },
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
                        });
                    }
                },
                Cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-green',
                    action: function(){
                        //
                    }
                },
            }
        });
    });
    
} );

//functions
function Alert(title,content,type,btn_color,refresh){
    $.confirm({
        title: title,
        content: content,
        type: type,
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: btn_color,
                action: function(){
                    if(refresh){
                        location.reload();
                    }
                }
            },
        }
    });
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function PasswordValidation(password) {
    return /[a-z]/.test(password) &&/\d/.test(password) &&password.length >= 8;
}