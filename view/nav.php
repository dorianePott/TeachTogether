<?php

// nav for all
echo <<<NAV
<nav class="navbar navbar-expand-md navbar-dark colorB sticky-top">
<a class="navbar-brand" href="?action=home"><img src="" height="40em" class="colorWhite ml-md-2 ml-sm-1 img-circle"/></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item ml-5">
            <a class="nav-link" href="?action=index"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Home <span class="sr-only">(current)</span></a>
        </li>
NAV;
#region user nav
if (in_multi_array('logout-view', $permissions)) {
    $avatar = ($_SESSION['avatar'] != '' ) ? $_SESSION['avatar'] : 'assets/img/user.svg';
    echo <<<USER
    <li class="nav-item ml-5">
        <a class="nav-link" href="model/logout.php">Logout</a>
    </li>
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=profile"><img src="$avatar" height="40em" class="img-circle"/></a>
    </li>
USER;
if (in_multi_array('settings-view', $permissions)) {
    echo <<<SETTINGS
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=settings"><img class="colorWhite mr-1" height="20em"/>Settings</a>
    </li>
SETTINGS;
}
#endregion

#region admin nav
    if (in_multi_array('manage-module', $permissions)) {
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-module">manage module</a>
    </li>
MODULE;
    }
    if (in_multi_array('manage-user', $permissions)) {
    
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-user">manage user</a>
    </li>
MODULE;
}
    if (in_multi_array('manage-resource', $permissions)) {
    
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-resource">manage resource</a>
    </li>
MODULE;
}
    if (in_multi_array('manage-education', $permissions)) {
    
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-education">manage education</a>
    </li>
MODULE;
}
    #endregion
} else {
#region anonyme nav
    echo <<<ANONYME
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=register"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Register</a>
    </li>
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=login"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Login</a>
    </li>
ANONYME;
    #endregion
}

echo <<<END
</ul>
    </div>
</nav>
END;

?>