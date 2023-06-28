<a href="#product-page" class="toTop"><i class='bx bx-chevrons-up' ></i></a>
<section class="s-product" id="s-product">
    
    <div class="loading-container" id="loading-container">
        <svg xmlns="http://www.w3.org/2000/svg" width="240px" viewbox="0 0 24 24">
            <circle
            stroke-linecap="round"
            cx="12"
            cy="12"
            r="10"
            fill="#0000"
            stroke-width="4"
            stroke="#000"
            />
        </svg>
        <div id="loading-text">0%</div>
    </div>
    
    <div class="product-page" id="product-page">
        
        
        <img src="<?php echo Path::IMG_DESIGN."shop.jpg"?>" alt="">
        <h1>Bienvenue dans notre boutique en ligne !👋</h1>
        <p>Découvrez notre sélection de produits de qualité, allant de simples prestations de services dans le développement d'application Web & Windows aux Templates personnalisées et bien plus encore. Profitez de notre service clientèle exceptionnel et de nos prix compétitifs. Parcourez notre catalogue en ligne dès maintenant et trouvez l'article parfait pour vous !</p>
        
        <form class="product-search" role="form" action="index.php"  method="get">
        <input type="hidden" name="controller" id="controller" value="Product" /> 
        <input type="hidden" name="action" id="action" value="searchCategory" /> 
            <div class="product-search-bar">
                <button type="submit" class="btn-search"><i class='bx bx-search'></i></button>
                
                <input type="text" placeholder="Search..." id="search" name="search">
            </div>

            <div class="filter-content">
                <div class="filter-left">
                    <select class="filter-categorie" id="category" name="category">
                        <option value="" selected>All Categorie</option>
                        <?php
                                        foreach (GlobalVariables::$categories as $theCategory) {
                                            # code...
                                            echo '<option value="'.$theCategory->id.'">'.$theCategory->libelle.'</option>';
                                        }
                                        ?>
                                </select>
                                
                                <a href="index.php?controller=Favorite&action=show" class="product-favorite"><i class='bx bx-bookmarks'></i><span class="notif not-yellow"><?php echo Favorite::count()?></span></a>
                                <p>0 of <?php echo count(GlobalVariables::$products) ?> Produits</p>
                                
                                
                            </div>
                            <div class="filter-right">
                                <div class="filter-type selected">All</div>
                                <div class="filter-type">Purchased</div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="product-grid">
                        <?php
            foreach (GlobalVariables::$products as $theProduct) {
                ?>
            <div class="product <?php Favorite::isFavorite($theProduct->id);?>">
                <div class="product-img">
                    <img src="<?php echo Path::IMG_PRODUCT.$theProduct->image?>" alt="" class="product-image">
                    <a href="index.php?controller=Favorite&action=switch&productId=<?php echo $theProduct->id ?>" class="add-favorite"><i class="bx bxs-bookmark"></i></a>
                    <?php 
                $owner = $theProduct->userId;
                if ($owner != null) {
                    ?>
                        <span class="owner"><?php echo modelUser::getPseudoById($owner);?></span>
                        <?php
                }
                ?>
            </div>
            <div class="product-details">
                <h3 class="product-title"><?php echo $theProduct->name ?></h3> 
                <span class="product-price"><?php echo $theProduct->price ?> ETH</span>
            </div>
            <p><?php echo $theProduct->description ?></p>
            
            <?php

            if ($owner != null) {
            ?>
                <a href="index.php?controller=User&action=showProfileUser&userId=<?php echo $theProduct->userId; ?>" class="btn btn-primary"><i class='bx bxs-user-pin' ></i> Voir le profil</a>
            <?php
            }
            else {
                if (Cart::contains($theProduct->id)) {
                    ?>
                        <a href="index.php?controller=Cart&action=remove&productId=<?php echo $theProduct->id; ?>" class="btn btn-primary"><i class='bx bxs-trash'></i> Retirer</a>
                    <?php
                }
                else {
                    ?>
                        <a href="index.php?controller=Cart&action=add&productId=<?php echo $theProduct->id; ?>" class="btn btn-primary"><i class="bx bxs-cart-add"></i> Ajouter</a>
                    <?php
                }
            }
            ?>
            </div>
            
            <?php
            }
            ?>

</div>
</div>


</section>