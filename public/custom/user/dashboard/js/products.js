$(document).ready( function () {
    $('select').selectpicker();
    $('#products_table').DataTable({
        "scrollX": true
    });
    var token=$('meta[name="csrf-token"]').attr('content');
    $(".page-title").html("Products");

    $(document).on("click",".update",function() {
        var product_id=$(this).attr("data-id");
        $(".product-id-area").html(product_id);
        $.ajax({
            type:'POST',
            url:'/dashboard/product/get',
            data: {
                _token:token,
                id:product_id,
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

       
    $(document).on("submit","#save-updated-data",function(e) {
        e.preventDefault();
        //to insert into category ids table
        var category_ids = JSON.stringify($('#category_ids').val());
        $("#category_ids_table").val(category_ids);
        var product_id=$(".product-id-area").html(),flage=true,error="";
        $("#product_id").val(product_id);
        $(".product-data").each(function() {
            if($(this).val()!=""){
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!";
            }
        });

        if($("#quantity").val()<1||$("#price").val()<1){
            flage=false;
            error="Quantity or price values should not be less than 1";
        }

        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            let formData = new FormData(this);
            formData.append('_token', token);
            $.ajax({
                type:'POST',
                url: '/dashboard/product/update',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response==1){
                        Alert('Updated','Product information have been updated successfully','green','btn-green',true);
                    }
                },
                error: function(response){
                    Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
                }
            });
        }
    });


    $(document).on("submit","#add-new-product",function(e) {
        e.preventDefault();
        //to insert into category ids table
        var category_ids = JSON.stringify($('#category_ids_add').val());
        $("#category_ids_table_add").val(category_ids);
        var flage=true,error="";
        $("#product_id").val(product_id);
        $(".product-data-add").each(function() {
            if($(this).val()!=""){
                $(this).css('border-color','')
            }else{
                $(this).css('border-color','red');
                flage=false;
                error="All fields are required!";
            }
        });

        if($("#quantity_add").val()<1||$("#price_add").val()<1){
            flage=false;
            error="Quantity or price values should not be less than 1";
        }
        if(!flage){
            Alert('Validation Error',error,'red','btn-red',false);
        }else{
            let formData = new FormData(this);
            formData.append('_token', token);
            $.ajax({
                type:'POST',
                url: '/dashboard/product/add',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response==1){
                        Alert('Saved','Product information have been Added successfully','green','btn-green',true);
                    }
                },
                error: function(response){
                    Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
                }
            });
        }
    });

    $(document).on("click",".delete",function() {
        var product_id=$(this).attr('data-id') 
        $.confirm({
            title: 'Product delete',
            content:'are you sure that you wnat to delete this product?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Yes: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type:'POST',
                            url:'/dashboard/product/delete',
                            data: {
                                _token:token,
                                id:product_id,
                            },
                            success: function(data) {
                                if(data==1){
                                    Alert('Deleted','Proudct has been deleted successfully','green','btn-green',true);
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