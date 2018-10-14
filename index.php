<?php
    require_once "Database.php";
    include "header.php";
    $db = new Database();
    $skill_sets = $db->getSkills();
?>
<!--form start-->

    <form id="user-form" method="post">
        <div class="col-md-12">
            <p class="h4">Personal Details</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" name="street">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state">
                </div>
            </div>


        </div>
        <div class="col-md-12 skill-header">
            <p class="h4">Tell us about your skills</p>
        </div>
        <div class="row">
            <?php foreach ($skill_sets as $key=>$skill_set){?>

                <div class="col-md-12 skills-container">
                    <div class="form-check">
                        <input class="form-check-input skill-category" type="checkbox" value="1" name="category['<?php echo $key; ?>']">
                        <label class="form-check-label" for="scripting_languages">
                            <?php echo $key; ?>
                        </label>
                    </div>
                    <div class="skill-container" style="display: none;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group" >
                                   <!-- <label for="exampleFormControlSelect1">Select any one skill</label>-->
                                    <select class="form-control skill-select"  name="skills[<?php echo $skill_set[0]['category_id']?>][skill]">
                                        <option value="">Select one of the <?php echo $key; ?></option>
                                        <?php
                                            foreach ($skill_set as $skill){
                                                echo "<option value='".$skill['id']."'>".$skill['skill']."</option>";
                                            }
                                        ?>
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--<label for="state">Rate yourself (1-5) in the skill </label>-->
                                    <input type="number" class="form-control skill-marks" name="skills[<?php echo $skill_set[0]['category_id']?>][marks]" min="1" max="5" placeholder="Rate yourself (1-5) in the skill">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="mx-auto p-3">
                <button type="submit" class="btn-lg btn-primary pull-center">Submit</button>
            </div>
        </div>
    </form>
<!--form end-->
<?php
    include "footer.php";
?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(".skill-category").change(function() {
            $('.skill-header .validation-error').hide();
            if(this.checked) {
                $(this).parents(".skills-container").find('.skill-container').slideDown();
             }else{
                $(this).parents(".skills-container").find('.skill-container').slideUp();
            }
        });
        $("#user-form").submit(function(){
            hideValidationError();
            var form = $(this);
            var error=0;
            var form = $(this);
            var email_filter = /^[a-zA-Z0-9\+\.\_\%\-\+]{1,256}\@[a-zA-Z0-9][a-zA-Z0-9\-]{0,64}(\.[a-zA-Z0-9][a-zA-Z0-9\-]{0,25})+$/;
            var phone_filter = /[0-9\-\(\)\s]+/
            var first_name= $.trim(form.find("#first_name").val());
            var last_name= $.trim(form.find("#last_name").val());
            var email= $.trim(form.find("#email").val());
            var city= $.trim(form.find("#city").val());
            var zip= $.trim(form.find("#zip").val());
            var state= $.trim(form.find("#state").val());
            var phone= $.trim(form.find("#phone").val());
            var street= $.trim(form.find("#street").val());

            form.find('button').attr('disabled','disabled');

            if(first_name == ""){
                error=1;
                showError("#first_name","First name cannot be empty.");
            }
            if(last_name == ""){
                error=1;
                showError("#last_name","Last name cannot be empty.");
            }
            if(email == ""){
                error=1;
                showError("#email","Email cannot be empty.");
            }else if(!email_filter.test(email)){
                error=1;
                showError("#email","Please enter a valid email.");
            }
            if(phone == ""){
                error=1;
                showError("#phone","Phone cannot be empty.");
            }else if(!phone_filter.test(phone)){
                error=1;
                showError("#phone","Please enter a valid phone number.");
            }
            if(city == ""){
                error=1;
                showError("#city","City cannot be empty.");
            }
            if(state == ""){
                error=1;
                showError("#state","State cannot be empty.");
            }
            if(street == ""){
                error=1;
                showError("#street","Street name cannot be empty.");
            }
            if(zip == ""){
                error=1;
                showError("#zip","Zip name cannot be empty.");
            }
            if($('.skill-category:checkbox:checked').length == 0){
                error=1;
                $('.skill-header').append('<span class="validation-error">You need to select at least one skill category</span>');

            }else{
                $('.skill-category:checkbox:checked').each(function () {
                    var skill_select_box = $(this).parents('.skills-container').find('.skill-select');
                    var skill_marks_input = $(this).parents('.skills-container').find('.skill-marks');
                    if(!skill_select_box.val()){
                        error=1;
                        skill_select_box.parent().append('<span class="validation-error">Skill is mandatory</span>');
                    }
                    if(!skill_marks_input.val()){
                        error=1;
                        skill_marks_input.parent().append('<span class="validation-error">Skill Marks are mandatory</span>');
                    }else{
                        var marks = parseFloat(skill_marks_input.val());
                        if(marks<1 || marks>5){
                            error=1;
                            skill_marks_input.parent().append('<span class="validation-error">Please enter in the range 1 to 5</span>');
                        }
                    }
                });
            }

            if(error==0){
                $.ajax({
                    url: "/user-apply.php",
                    type:"post",
                    data:new FormData(this),
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,
                    success: function(result){
                        if($.trim(result) == "success"){
                            location.href="/thankyou.php"
                        }else{
                            obj=$.parseJSON(result);
                            $.each( obj, function( key, value ) {
                                showError('#'+value.field,value.msg);
                            });
                        }
                    },
                    complete:function(data){
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
