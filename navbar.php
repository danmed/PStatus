<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="icons/pstatus_logo_small.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#aboutmodal">About</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Refresh<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?refresh=5">5 seconds</a></li>
                        <li><a href="index.php?refresh=10">10 seconds</a></li>
                        <li><a href="index.php?refresh=15">15 seconds</a></li>
                        <li><a href="index.php?refresh=20">20 seconds</a></li>
                        <li><a href="index.php?refresh=25">25 seconds</a></li>
                        <li><a href="index.php?refresh=30">30 seconds</a></li>
                        <li><a href="index.php?refresh=35">35 seconds</a></li>
                        <li><a href="index.php?refresh=40">40 seconds</a></li>
                        <li><a href="index.php?refresh=45">45 seconds</a></li>
                       <li><a href="index.php?refresh=50">50 seconds</a></li>
                       <li><a href="index.php?refresh=55">55 seconds</a></li>
                        <li><a href="index.php?refresh=60">60 seconds</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="serveradd.php">Add Devices</a></li>
                        <li><a href="serveredit.php">Edit Devices</a></li>
                        <li><a href="settings.php">Settings</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
