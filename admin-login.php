<?php
    include "header.php";
    session_start();
    if(!empty($_SESSION["username"])){
        header("Location: ./admin-dashboard.php");
        exit();
    }
?>
<form id="login-form" method="post">
    <span class="login-error validation-error"></span>
    <div class="form-group">
        <label for="exampleInputEmail1">User Name</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="password" name="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
include "footer.php";
?>
<script type="text/javascript">
    $('document').ready(function(){
        $('#login-form').submit(function(){
            $('.login-error').hide();
            var form = $(this);
            form.find('button').attr('disabled','disabled');
            var username= $.trim(form.find("#username").val());
            var password = $.trim(form.find("#password").val());
            error=0;
            if(username == ""){
                error=1;
                showError('#email', "Username cannot be empty.");
            }
            if(password == ""){
                error=1;
                showError('#password', "Password cannot be empty.");
            }
            if(error==0){
                $.ajax({
                    url: "./admin-check.php",
                    type:"post",
                    data:{"username":username,"password":password,"action":'login'},
                    success: function(result){
                        if($.trim(result) == "success"){
                            location.href="./admin-dashboard.php"
                        }else if($.trim(result) == "false"){
                            $('.login-error').html('Invalid Email or Password').show();
                            form.find('input').addClass('error');
                        }else{
                            $('.login-error').html('Something wrong happened, please reload the page and try once again').show();
                        }
                    },
                    complete:function($data){
                        form.find('button').removeAttr('disabled');
                    }
                });
            }else{
                form.find('button').removeAttr('disabled');
            }
            return false;
        });
    });
</script>
