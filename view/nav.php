<?php
echo <<<NAV
<nav class="navbar navbar-expand-md navbar-dark colorB sticky-top">
<a class="navbar-brand" href="?action=home"><img src="assets/img/logo.svg" height="40em" class="colorWhite ml-md-2 ml-sm-1"/></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ml-5">
                <a class="nav-link" href="?action=index"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Home <span class="sr-only">(current)</span></a>
            </li>
NAV;
if (in_array('logout-view', $permissions[$role['Cd_Role']])) {
    echo <<<LOGOUT
    <li class="nav-item ml-5">
        <a class="nav-link" href="./model/logout.php">Logout</a>
    </li>
LOGOUT;
} else {
    echo <<<LOGIN
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=register"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Register</a>
    </li>
    <li class="nav-item ml-5">
        <a class="nav-link" href="?action=login"><img class="colorWhite mr-1" src="assets/img/home.svg" height="20em"/>Login</a>
    </li>
LOGIN;
}
echo <<<END
</ul>
    </div>
</nav>
END;
?>