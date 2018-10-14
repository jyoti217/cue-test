<?php
    session_start();
    if(empty($_SESSION["username"])){
        header("Location: /admin-login.php");
        exit();
    }
    include "header.php";
    require_once "Database.php";
    $db = new Database();
    $user_id = $_GET['user_id'];
    $user = $db->getUserDetails($user_id);
    $userSkills = $db->getUserSkills($user_id);
?>
<form id="user-form" method="post">
    <div class="col-md-12">
        <p class="h4">Personal Details</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(!empty($user['first_name'])) echo $user['first_name']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php if(!empty($user['last_name'])) echo $user['last_name']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($user['email'])) echo $user['email']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php if(!empty($user['phone'])) echo $user['phone']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" class="form-control" id="street" name="street" value="<?php if(!empty($user['street'])) echo $user['street']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php if(!empty($user['city'])) echo $user['city']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" value="<?php if(!empty($user['zip'])) echo $user['zip']?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php if(!empty($user['state'])) echo $user['state']?>" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-12 skill-header">
        <p class="h4">Tell us about your skills</p>
    </div>
    <div class="row">
        <?php foreach ($userSkills as $key=>$skill_set){?>

            <div class="col-md-12 skills-container">
                <div class="form-check">
                    <input checked disabled class="form-check-input skill-category" type="checkbox" value="1" name="category['<?php echo $key; ?>']" readonly>
                    <label class="form-check-label" for="scripting_languages">
                        <?php echo $key; ?>
                    </label>
                </div>
                <div class="skill-container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="text" class="form-control" value="<?php  if(!empty($skill_set[0]['skill'])) echo $skill_set[0]['skill'];?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="number" class="form-control skill-marks" value="<?php  if(!empty($skill_set[0]['marks'])) echo $skill_set[0]['marks'];?>" readonly>
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

<?php
    include "footer.php";
?>
