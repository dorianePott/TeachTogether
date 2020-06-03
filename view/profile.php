<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['email'] ?></title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <h2>Profile</h2>
    <h4>Lessons : </h4>
    <nav class="card" style="float:left;border:1px solid black;">
        <?= display_nav($resources, 'Id_Resource')?>
    </nav>
    <nav class="card" style="float:right;">
        <h4 class="card-title" style="text-align:center;"> Your resources </h4>
        <form method="post" action="?action=profile" enctype="multipart/form-data">
            <?= display_nav($own, 'Id_Resource', true, false, true)?>
            <div class="card-body">
            <br/>
            <h5 class="card-title">Add resource</h5>
            <input id="resource-name" type="text" name="name" placeholder="Name" value="<?=$name?>" class="form-control"/><br/>
            <input id="resource-desc" type="text" name="desc" placeholder="Description" value="<?=$desc?>" class="form-control"/><br/>
            <?= display_select(read_module_by_education($education)) ?><br/><br/>
            <div class="custom-file">
                <input type="file" name="upload[]" multiple class="custom-file-input" id="fileAddRsc"/>
                <label class="custom-file-label" for="fileAddRsc">Choose file(s)</label>
            </div>
            <button class="btn btn-outline-info" type="submit" name="do" value="create">Create</button>
            </div>
    </form>
    </nav>
</body>
</html>