<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" class="stylesheet">
    <title>Cue Test</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="logo">Fictive Personal Agency <?php if(!empty($_SESSION["username"])) echo "(".$_SESSION["username"].")";?></a>
            <?php if(!empty($_SESSION["username"])){?>
            <div class="header-right">
                <!--<a class="active" href="/admin-check.php?action=logout">Logout</a>-->
                <form action="./admin-check.php" method="post">
                    <button type="submit" class="btn btn-primary" name="action" value="logout">Logout</button>
                </form>
            </div>
            <?php }?>
        </div>
