<div class="header-section">
    <div class="container">
        <div class="navbar">
            <a href="home.php">
                <img src="../../common/logo.png" alt="HUS Logo" style="width: 150px;">
            </a>
            <div class="d-flex menu-wrap align-items-center">
                <div class="mainmenu">
                    <ul class="nav">
                        <li><a href="home.php">HOME</a></li>
                        <li><a href="menu.php">MENU</a></li>
                        <li><a href="about.php">ABOUT</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                    </ul>
                </div>
                <div class="header-btn" style="margin-left:10px">
                    <a href="table-reservation.php" target="_blank" class="menu-btn">BOOK TABLE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-height" style="height: 120px;"></div>

<style>
    .navbar {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        margin: 0;
        position: relative;
        padding: 0 !important;
    }

    .header-section {
        transition: all .3s ease-in-out;
    }

    .header-section {
        background-color: #f5fcf4;
        width: 100%;
        height: 120px;
        z-index: 999;
        position: fixed;
        left: 0;
        top: 0;
        padding: 0;
        display: flex;
        align-items: center
    }

    .menu-wrap {
        position: relative;
    }

    ul.nav>li {
        position: relative;
    }

    ul.nav>li>a {
        color: black;
        font-family: work sans, sans-serif;
        display: inline-block;
        vertical-align: middle;
        padding: 0 20px;
        letter-spacing: 0;
        font-size: 20px;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 80px;
        z-index: 1;
        transition: 0.5s;

    }

    .header-btn .menu-btn {
        background-color: #0a7e3e;
        font-family: work sans, sans-serif;
        font-size: 20px;
        text-transform: uppercase;
        color: black;
        padding: 0 30px;
        height: 45px;
        line-height: 45px;
        display: block;
        margin: 0;
    }

    .header-btn .menu-btn:hover {
        opacity: .8;
    }

    ul.nav>li>a:hover {
        color: #ffc851;
    }
</style>