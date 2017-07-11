<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/index.css" rel="stylesheet"> 
        <script src="js/lib/jquery-3.2.1.js"></script>
        <script src="js/lib/jquery.inputmask.js"></script>
        <script src="js/lib/bootstrap.min.js"></script>        
        <script type="text/javascript">
            
            var check1 = 0, check2 = 0, check3 = 0; 
            
            $(document).ready(function() {
                PopUpHide();
                $('#fio').blur(function() {
                    if($(this).val().length != 0)
                        check1 = 1;
                    else
                        check1 = 0;
                });
                $("#phone").inputmask("+375(99)999-99-99");
                $('#phone').blur(function() {
                    var phone = $('#phone').val();
                    var index = phone.indexOf('_');
                    if(index == -1 && phone.length == 0){
                        $('#phone').css({'border' : '1px solid #ff0000'});
                        check2 = 0;
                    }
                    else if(index != -1){ 
                        $('#phone').css({'border' : '1px solid #ff0000'});
                        check2 = 0;
                    }      
                    else{
                        $('#phone').css({'border' : '1px solid #569b44'});
                        check2 = 1;
                    }
                });
                $('#email').blur(function() {
                    if($(this).val() != '') {
                        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                        if(pattern.test($(this).val())){
                            $(this).css({'border' : '1px solid #569b44'});
                            check3 = 1;
                        } else {
                            $(this).css({'border' : '1px solid #ff0000'});
                            check3 = 0;
                        }
                    } else {
                        $(this).css({'border' : '1px solid #ff0000'});
                        check3 = 0;
                    }
                });
    
            });
            
            function PopUpShow(){
                $("#popup1").show();
            }
            function PopUpHide(){
                $("#popup1").hide();
            }

            function funcBefore(){
                PopUpShow();
            }
            
            function send(){   
                if(check1 == 1 && check2 == 1 && check3 == 1){
                    var phone = $('#phone').val();
                    var fio = $('#fio').val();
                    var email = $('#email').val();                    
                    $.ajax({
                        type: 'POST',
                        data: {fio : fio, email : email, phone : phone},
                        dataType: "html",
                        url: 'send.php',
                        beforeSend: funcBefore,
                        success: function(result){
                            $("#information").text(result);
                            PopUpHide();
                        }
                    }); 
                }
                else{
                    $("#information").text('Заполните корректно поля.');
                    return;
                }
            };
            
        </script>    
    </head>
    <body>
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="fio" placeholder="ФИО">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="email" placeholder="email">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="phone" placeholder="number phone">
                </div>                
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" onclick="send()">Отправить</button>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-3" id="information"></div>
                </div>                
                
                <div class="b-popup" id="popup1">
                    <div class="b-popup-content">
                        <img src="img/material-loader.gif" width="60" height="60" alt="loader">
                    </div>
                </div>                
                
            </div>
        </div>
    </body>
</html>
