
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
$( document ).ready(function() {
    $('#register-anchor').click(function(event) {
       event.preventDefault();
       if($(this).text()=='register'){
            var confirm_password='<div class="form-group"><label for="confirm_password" class="inputs-label">Confirm Password</label><input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="user-data form-control" required /></div>';
            var first_last_name='<div class="form-group"><label for="first_name" class="inputs-label">First Name</label><input type="text" id="first_name" name="first_name" placeholder="First Name" class="user-data form-control" required /></div> <div class="form-group"><label for="last_name" class="inputs-label">Last Name</label><input type="text" id="last_name" name="last_name" placeholder="Last Name" class="user-data form-control" required /></div>';
            $(".first-last-name-area").append(first_last_name);
            $(".confirm-password").append(confirm_password);
            $(".switch-caption").html("Register");
            $(".btn-custom").html("Register");
            $(this).html('login');
            $(this).attr('href','Login');
            $(".have-account-switch").html("Have an account");
            $("#login-box").css('top','10%');
            $(".forget-the-password").css('display','none');
            $("#submit_form").attr('action',"/Register");
        }else{
            $(".first-last-name-area").empty();
            $(".confirm-password").empty();
            $(".switch-caption").html("Login");
            $(".btn-custom").html("Login");
            $(this).html('register');
            $(this).attr('href','Register');
            $(".have-account-switch").html("Doesn't have an account");
            $("#login-box").css('top','30%');
            $(".forget-the-password").css('display','block');
            $("#submit_form").attr('action',"/SignIn");
        }
    });

    $('#login-register-btn').click(function(event) {
        event.preventDefault();
        var flage_empty=true;
        
        $( ".user-data" ).each(function() {
            if($(this).val()==""){
                flage_empty=false;
                $(this).css("border","solid 2px red");

            }else{
                $(this).css("border","");
            }
        });
        if(!flage_empty){
            alert("Validation error","All fileds are required","red","btn-red");
        }else{
            $("#submit_form").submit();
        }

    });
});

function alert(title,content,type,btn_color){
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
                }
            },
        }
    });
}
