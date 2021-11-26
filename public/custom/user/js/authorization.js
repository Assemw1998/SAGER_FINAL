$(document).ready( function () {
    var token=$('meta[name="csrf-token"]').attr('content');
    $(document).on("click","#foget-the-password",function(event) {
        event.preventDefault()
        var email=$("#email").val();
        if(email==""){
            Alert('Validation Error',"Email filed should not be empty!",'red','btn-red',false);
        }else if(!isEmail(email)){
            Alert('Validation Error',"Invalid Email",'red','btn-red',false);
        }else{
            $.ajax({
                type:'POST',
                url:'/FogetThePasswordAu',
                data: {
                    _token:token,
                    email:email,
                },
                success: function(data) {  
                    if(data==1){
                        Alert('Changed','Your password has been sent to your email, please check your email and use the sent password!','green','btn-green',"rout");
                    }else{
                        Alert('Validation Error',data,'red','btn-red',false);
                    }                  
                },
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Alert('Technical Error','Somthing went wrong please try again later.','red','btn-red',true);
            });
        } 
        

    });

});
particlesJS('particles-js',
    {
    "particles": {
        "number": {
        "value": 80,
        "density": {
            "enable": true,
            "value_area": 800
        }
        },
        "color": {
        "value": "#ffffff"
        },
        "shape": {
        "type": "circle",
        "stroke": {
            "width": 0,
            "color": "#000000"
        },
        "polygon": {
            "nb_sides": 5
        },
        "image": {
            "width": 100,
            "height": 100
        }
        },
        "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
        }
        },
        "size": {
        "value": 5,
        "random": true,
        "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
        }
        },
        "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
        },
        "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
        }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
        "onhover": {
            "enable": true,
            "mode": "repulse"
        },
        "onclick": {
            "enable": true,
            "mode": "push"
        },
        "resize": true
        },
        "modes": {
        "grab": {
            "distance": 400,
            "line_linked": {
            "opacity": 1
            }
        },
        "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
        },
        "repulse": {
            "distance": 200
        },
        "push": {
            "particles_nb": 4
        },
        "remove": {
            "particles_nb": 2
        }
        }
    },
    "retina_detect": true,
    "config_demo": {
        "hide_card": false,
        "background_color": "#b61924",
        "background_image": "",
        "background_position": "50% 50%",
        "background_repeat": "no-repeat",
        "background_size": "cover"
    }
    }
);

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
                if(refresh=="rout"){
                    window.location = "/login";
                }else if(refresh){
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

