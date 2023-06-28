<nav class="top-nav">
    <div class="top-nav-left">
        <div class="open-main-nav" id="open-main-nav" onclick="showNav(true)"><i class='bx bx-menu-alt-left'></i></div>
        <span class="bg-icon">📁</span>
        
        <a href="index.php" class="nav-path">
            <!-- @Sauzet-Lény / Products -->
            <?php echo GlobalVariables::$navPath?>
        </a>
        
    </div>
    <div class="top-nav-right">
        <div class="btn-icon" id="open-cart" onclick="showCart(true)"><i class='bx bxs-cart-alt'></i></i><span class="notif not-red"><?php echo Cart::count(); ?></span></div>
        <!-- <div class="btn-icon"><i class='bx bx-dots-horizontal-rounded'></i></div> -->
        <!-- <img src="https://media.licdn.com/dms/image/D4E03AQEybp0vEoCFzA/profile-displayphoto-shrink_800_800/0/1675644281594?e=2147483647&v=beta&t=xu48CkiDNB0-q2-orSBwX2QmnZUohP_zWuHdtHK_qEM" alt="" class="profil-pic"> -->
        <?php
                if (isset($_SESSION['id_user'])) {
                    ?>
    <div id="profile-img-sm">
        <img src="<?php echo GlobalVariables::$sessionProfilePic;?>" alt="">
        
        <div class="img-action" id="btn-popup-profile">
            <i class='bx bx-user'></i>
        </div>
    </div>
    <div class="popup-profile" id="popup-profile">
        <ul class="nav-list">
            <li class=""><a href="index.php?controller=User&action=showProfileUser">Mon profil</a></li>
            <li class=""><a href="index.php?controller=Identification&action=logOff" class="btn btn-warning">Se déconnecter</a></li>
        </ul>
    </div>
    <?php
                } 
                else {
                    ?>
                    <a href="index.php?controller=Identification&action=showLogin" id="profile-img-sm">
                        <img src="<?php echo GlobalVariables::$sessionProfilePic;?>" alt="">
                        
                        <div class="img-action">
                            <i class='bx bx-log-in-circle'></i>
                        </div>
                    </a>
                    <?php
                }
                
                ?>

</div>
<div class="vis-scroll" id="vis-scroll"></div>
</nav>