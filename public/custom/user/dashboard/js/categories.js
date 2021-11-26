$(document).ready( function () {
    $('#categories_table').DataTable();
    var token=$('meta[name="csrf-token"]').attr('content');
    $(".page-title").html("Categories");

    $(document).on("click",".update",function() {
        var category_id=$(this).attr("data-id");
        $(".category-id-area").html(category_id);
        $.ajax({
            type:'POST',
            url:'/dashboard/category/get',
            data: {
                _token:token,
                id:category_id,
            },
            success: function(data) {
                $.each(data, function( index, value ) {
                    $('#'+index).val(value);
                    if(index=="category_ids"){
                        value=JSON.parse(value);
                        $('#'+index).val(value);
                    }
                });
            },
        }).fail(function(jqXHR, textStatus, errorThrown) {
            Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
        });
    });

    $(document).on("click",".save-updated-data",function(e) {
        e.preventDefault();
        var data={},category_id=$(".category-id-area").html(),flage=true,error="";
        data['id']=category_id;

        $(".category-data").each(function() {
            if($(this).val()!=""){
                data[$(this).attr('name')]=$(this).val();
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!"
            }
        });
        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            $.ajax({
                type:'POST',
                url:'/dashboard/category/update',
                data: {
                    _token:token,
                    id:category_id,
                    data:data
                },
                success: function(data) {
                    if(data==1){
                        Alert('Updated','Category information have been updated successfully','green','btn-green',true);
                    }        
                },
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
            });
        }
    });



    $(document).on("click",".add-new-category-btn",function(e) {
        e.preventDefault();

        var data={},flage=true,error="";

        $(".category-data-add").each(function() {
            if($(this).val()!=""){
                data[$(this).attr('name')]=$(this).val();
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!"
            }
        });

        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            $.ajax({
                type:'POST',
                url:'/dashboard/category/add',
                data: {
                    _token:token,
                    data:data
                },
                success: function(data) {
                    if(data==1){
                        Alert('Added','Category has been added successfully','green','btn-green',true);
                    }
                },
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
            });
        }
    });

    $(document).on("click",".delete",function() {
        var category_id=$(this).attr('data-id') 
        $.confirm({
            title: 'Category delete',
            content:'are you sure that you wnat to delete this category?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Yes: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type:'POST',
                            url:'/dashboard/category/delete',
                            data: {
                                _token:token,
                                id:category_id,
                            },
                            success: function(data) {
                                if(data==1){
                                    Alert('Deleted','Category has been deleted successfully','green','btn-green',true);
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

});



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