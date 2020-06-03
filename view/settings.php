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
    <form action="?action=settings" method="post" class="section" enctype="multipart/form-data">
    <h2>Avatar</h2>
    <div>Allowed Formats: JPEG PNG GIF Max size 5MB Optimal dimensions: 230x230</div>
    <div class="dropbox" style="">
        <input class="input-file" type="file" name="avatar" accept="image/*" class="btn btn-outline-secondary"/>
    </div>
    <div class="section">
        <h2>First Name</h2>
        <div class="el-input">
            <input name="first" class="el-input" type="text" value="<?=$first?>"/>
        </div>
        <h2>Last Name</h2>
        <div class="el-input">
            <input name="last" class="el-input" type="text" value="<?=$last?>"/>
        </div>
    </div>
    
    <div class="section">
        <h2>Email</h2>
        <div class="el-input">
            <input name="email" class="el-input" type="email" value="<?=$email?>"/>
        </div>
    </div>

    <div class="section">
        <h2>Change Password</h2>
        <div class="el-input">
            <input class="el-input" type="password"/>
        </div>
        <br/>
        <div class="el-input">
            <input class="el-input" type="password"/>
        </div>
    </div>
    
    <div class="section">
        <h2>Confirm Current Password</h2>
        <div class="el-input">
            <input name="confirm" required class="el-input" type="password"/>
        </div>
    </div>

    <button type="submit" name="do" value="deactivate" class="btn btn-outline-danger">Deactivate account</button>
    <button type="submit" name="do" value="cancel" class="btn btn-outline-secondary">Cancel</button>
    <button type="submit" name="do" value="confirm" class="btn btn-success">Save</button>
    
    </form>

</body>
</html>