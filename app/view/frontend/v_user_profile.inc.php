<section class="s-profile">
    <div class="profile-page">
        <h1>😄 <?php
        if (GlobalVariables::$isOwnerProfile) {
            echo "Mon Profil";
        }
        else {
            echo "Profil de @".GlobalVariables::$theUser->pseudo." :";
        }
        ?></h1>
        <hr>
        <div class="main-profile">
            <?php 
                if (GlobalVariables::$isOwnerProfile) {
                    ?>
                    <div class="profile-nav">
                        <ul class="nav-list">
                            <p>Paramètres</p>
                            <li><a href=""><i class='bx bxs-user'></i> Détails</a></li>
                            <li><a href=""><i class='bx bxs-lock-open-alt'></i> Mot de passe</a></li>
                            <li><a href="index.php?controller=User&action=delete" class="btn btn-primary"><i class='bx bxs-trash'></i> Supprimer</a></li>
                        </ul>
                    </div>                    
                    <?php
                }
            ?>


            <form class="profile-main" role="form" method="post" action="index.php?controller=User&action=updateProfile">

                <div id="user-banner"></div>

                <div class="profile-header">
                    <img src="<?php echo GlobalVariables::$profilePicture;?>" alt="" id="main-profile-img" onload="setUserBannerColor()">
                    <input type="hidden" id="selected-image-id" name="selected-image-id" value="<?php echo GlobalVariables::$theUser->picture;?>">
                    
                    <div class="profile-header--middle">
                        <?php
                        if (GlobalVariables::$isOwnerProfile) {
                            ?>
                                <input type="text" class="input-hidden" id="pseudo" name="pseudo" value="<?php echo GlobalVariables::$theUser->pseudo;?>">
                            <?php
                        }
                        else {
                            ?>
                                <h2><?php echo GlobalVariables::$theUser->pseudo;?></h2>
                            <?php
                        }
                        ?>
                        <p><?php echo GlobalVariables::$theUser->email?></p>
                    </div>

                    <?php 
                    if (GlobalVariables::$isOwnerProfile) {
                        ?>
                            <button type="submit" id="btn-save-profile" class="btn btn-secondary"><i class='bx bxs-save' ></i> Enregistrer</button>
                        <?php
                    }
                    ?>
                </div>
                
                <?php
                if (count(GlobalVariables::$ProductsUser) != 0) {
                    ?>
                    <hr>
                    <div class="gallery">
                        
                        
                        <?php
                        foreach (GlobalVariables::$ProductsUser as $theProduct) {
                            ?>
                            <div class="gallery-item">
                                <img src="<?php echo Path::IMG_PRODUCT.$theProduct->image;?>" alt="" data-image-id="<?php echo $theProduct->id;?>">
                                <?php 
                                    if (GlobalVariables::$isOwnerProfile) {
                                ?>
                                    <div class="img-action profile-item">
                                        <i class='bx bxs-image-add'></i>
                                    </div>
                                <?php
                                    }
                                ?>
    
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>

                <hr>
                <div class="profile-info">
                    <?php 
                        if (GlobalVariables::$isOwnerProfile) {
                            ?>
                                <textarea id="profile-description" name="profile-description"><?php echo GlobalVariables::$theUser->description;?></textarea>
                            <?php
                        }
                        else {
                            echo GlobalVariables::$theUser->description;
                        }
                    ?>
                </div>
            </form>
    
        </div>

    </div>
</section>