<section class="s-cart" id="s-cart">
        <div class="cart-content">
            <div class="close-cart" onclick="showCart(false)"><i class='bx bx-x'></i></div>
            <p class="cart-recap">Récapitulatif de la commande</p>
            <?php 
            if (Cart::isEmpty()) {
                # code...
                ?>
                <div class="cart-empty">
                <i class='bx bx-cart' ></i>
                <p>Panier Vide</p>
                </div>
                <?php

            }
            else {
                # code...
                ?>
                <div class="cart-products">    
                    <?php
    
                    $initPrice = 0;
                    $reducPrice = 0;
                    foreach (GlobalVariables::$cartProducts as $theProduct) {
                        $initPrice += ($theProduct->price);
                        $reducPrice += ($theProduct->price)*0.5;
                    ?>
                        <div class="cart-product">
                            <a href="index.php?controller=Cart&action=remove&productId=<?php echo $theProduct->id; ?>" class="cart-product--image">
                                <img src="<?php echo Path::IMG_PRODUCT . $theProduct->image; ?>" alt="">
                                <div class="removeFromCart">
                                    <i class='bx bxs-trash'></i>
                                </div>
                            </a>
                        <div class="cart-product--details">
                            <h3><?php echo $theProduct->name?></h3>
                            <span>-50%</span>
                            <p> <span class="strike"><?php echo $theProduct->price?> ETH</span> <?php echo $theProduct->price * 0.5?> ETH</p>
                        </div>
                        </div>
                    <?php
                    }
                    ?>
        
        
                </div>
                <div class="cart-details">
                    <p>Prix</p><span><?php echo $initPrice?> ETH</span>
                </div>
                <div class="cart-details">
                    <p>Remise Soldes</p><span><?php echo $reducPrice?> ETH</span>
                </div>
                <div class="cart-details" id="cartTotal">
                    <p>Total</p><span><?php echo ($initPrice - $reducPrice)?> ETH</span>
                </div>
                <a class="btn btn-primary" href="index.php?controller=Product&action=BuyProducts">Confirmer la commande</a>
                <a href="index.php?controller=Cart&action=empty" class="btn btn-secondary">Vider mon panier</a>
                <?php
            }
            ?>

        </div>
    </section>
