<?php

function nav(){
    $permissions[$role['Cd_Role']];
}


echo <<<NAV
<nav class="navbar navbar-expand-md navbar-dark colorB sticky-top">
<a class="navbar-brand" href="?action=home"><img src="assets/img/logo.svg" height="40em" class="colorWhite ml-md-2 ml-sm-1"/></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
NAV;
if (in_array('logout-view', $permissions[$role['Cd_Role']])) {
    #region user nav
    echo <<<USER
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=index"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item ml-5">
        <a class="nav-link" href="./model/logout.php">Logout</a>
    </li>
USER;
    #endregion
    #region admin nav
    if (in_array('manage-module-view', $permissions[$role['Cd_Role']])) {
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-module">manage module</a>
    </li>
MODULE;
    }
    if (in_array('manage-user-view', $permissions[$role['Cd_Role']])) {
    
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-user">manage user</a>
    </li>
MODULE;
}
    if (in_array('manage-resource-view', $permissions[$role['Cd_Role']])) {
    
        echo <<<MODULE
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=manage-resource">manage resource</a>
    </li>
MODULE;
}
    if (in_array('manage-education-view', $permissions[$role['Cd_Role']])) {
    
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