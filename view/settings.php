<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
</head>
<body>
    <form action="?action=settings" method="post" class="container" enctype="multipart/form-data">
    <?= isset($error) ? $error : '' ?>
    <div class="row">
    <div class="col">
        <div class="input-group">
            <div>
                <label style="font-size:10px" for="inputFile">
                <img id="preview" src="<?=(isset($user['Nm_File_Profile_Picture']) && $user['Nm_File_Profile_Picture'] != '') ? $user['Nm_File_Profile_Picture'] : 'assets/img/user.svg';?>" alt=""  height="100px" class="img-circle" style="float:left;"/>
                </label>
                <input id="inputFile" class="custom-file-input" type="file" name="avatar" accept="image/*" onchange="readURL(this)"/>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">First and last name</span>
            </div>
            <input name="first" class="form-control" type="text" value="<?=$first?>"/>
            <input name="last" class="form-control" type="text" value="<?=$last?>"/>

        </div>
        <div class="form-group">
        
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Change password</span>
            </div>
            <input name="pwd" class="form-control" type="password"/>
        </div>

        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Email</span>
        </div>
        <div class="el-input">
            <input name="email" class="form-control" type="email" value="<?=$email?>"/>
        </div>
        </div>

        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Actual password</span>
        </div>
        <div class="el-input">
            <input name="confirm" required class="form-control" type="password"/>
        </div>
        </div>


    </div>
    </div>

    <button type="submit" name="do" value="deactivate" class="btn btn-outline-danger">Deactivate account</button>
    <button type="submit" name="do" value="confirm" class="btn btn-success">Save</button>
    
    </form>
<script>
//this code is from https://jsbin.com/uboqu3/1/edit?html,js,output
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>
