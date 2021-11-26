$(document).ready( function () {
    $('select').selectpicker();
    $('#products_table').DataTable();
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
                    $('#'+index).val(value)
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