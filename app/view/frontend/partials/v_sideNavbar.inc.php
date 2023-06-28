<nav class="main-nav" id="main-nav">
        <div class="close-main-nav" id="close-main-nav" onclick="showNav(false)"><i class='bx bx-chevrons-left'></i></div>

        <div class="nav-logo">
            <img src="<?php echo Path::IMG."sauzetShop.png"?>" alt="">
        </div>
        <ul class="nav-list nav-main">
        <?php
            if (isset($_SESSION['id_user'])) {
        ?>
        <li id="btn-forum"><a href="#" class="btn btn-primary"><i class='bx bx-conversation' ></i> Forums</a></li>
        <?php
            }
        ?>
            <?php
            if (isset($_SESSION['is_admin'])) {
            ?>
            <p>Base de données</p>
            <?php
                foreach(GlobalVariables::$theTables as $uneTable) //Permet d'afficher toutes les catégories dans le menu
                {
                ?>

                <li><a href="#" class="sub-menu"><i class='bx bx-chevron-right'></i> <?php echo $uneTable->Tables_in_sauzet_shop;?></a>
                    <ul class="nav-list">
                        <li><a href="index.php?controller=Admin&action=showTable&tableName=<?php echo $uneTable->Tables_in_sauzet_shop;?>"><i class='bx bx-table'></i> Table</a></li>
                    </ul>
                </li>
                <?php
                }
            }
            ?>

            <p>Autres</p>
            <li><a href="#"><i class='bx bxl-windows'></i> Windows</a></li>
            <li><a href="index.php?controller=home&action=showApropos"><i class='bx bxs-info-circle'></i> A propos</a></li>

        </ul>
        <ul class="nav-list nav-social">
            <li><a href=""><i class='bx bxl-linkedin-square'></i> LinkedIn</a></li>
            <li><a href=""><i class='bx bxl-github'></i> Github</a></li>
            <li><a href=""><i class='bx bxl-instagram-alt'></i> Instagram</a></li>
            <li><a href="">🍪 Portfolio</a></li>
            <li><a href="https://www.buymeacoffee.com/lenysauzetd" target="_blank">☕ Buy me a coffee</a></li>

        </ul>
    </nav>