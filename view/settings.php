<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>
<body>
    <form action="?action=settings" method="post" class="container" enctype="multipart/form-data">
    <?= isset($error) ? $error : '' ?>
    <div class="row"><div class="col">
    <div class="input-group">
        <h5>First/Last Name</h5>
            <input name="first" class="form-control" type="text" value="<?=$first?>"/>
        <h5>Last Name</h5>
            <input name="last" class="form-control" type="text" value="<?=$last?>"/>
    </div>
</div><div class="col">
    <div class="input-group">
        <h4>Email</h4>
        <div class="el-input">
            <input name="email" class="form-control" type="email" value="<?=$email?>"/>
        </div>
    </div>
    <h4>Avatar</h4>
    <div class="custom-file" style="">
        <input id="inputFile" class="custom-file-input" type="file" name="avatar" accept="image/*"/>
        <label style="font-size:10px" class="custom-file-label" for="inputFile">Allowed Formats: images | Max size 5MB</label>
    </div>
</div></div>
<div class="row">
    <div class="col">
    <div class="input-group">
        <h4>Change password</h4>
        <div class="el-input">
            <input class="form-control" type="password"/>
        </div>
    </div>
</div><div class="col">
        <div class="input-group">
            <h4>Repeat password</h4>
            <input class="form-control" type="password"/>
        </div>
    </div>
</div></div>
    <div class="input-group">
        <h4>Confirm current password</h4>
        <div class="el-input">
            <input name="confirm" required class="form-control" type="password"/>
        </div>
    </div>

    <button type="submit" name="do" value="deactivate" class="btn btn-outline-danger">Deactivate account</button>
    <button type="submit" name="do" value="confirm" class="btn btn-success">Save</button>
    
    </form>

</body>
</html>