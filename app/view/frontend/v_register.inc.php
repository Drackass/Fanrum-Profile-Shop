<section class="s-log">
    <img src="<?php echo Path::IMG_DESIGN."register.jpg"?>" alt="">
    <form class="log-form"  role="form" method="post" action="index.php?controller=User&action=add">
        <img src="<?php echo Path::IMG."sauzetShop.png"?>" alt="">
        <h3>Inscription :</h3>
        
        <label for="pseudo"><i class='bx bxs-id-card'></i> Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required="" placeholder="Pseudo">
        
        <label for="email"><i class='bx bxs-envelope'></i> Email :</label>
        <input type="text" id="email" name="email" required="" placeholder="Email">
        
        <label for="password"><i class='bx bxs-lock-open-alt' ></i> Mot de passe :</label>
        <input type="password" id="password" name="password" required="" required="" placeholder="mot de passe">
        
        <button type="submit" class="btn btn-primary">Créer le compte</button>
        <a style="align-self: center;" href="index.php?controller=Identification&action=showLogin">J'ai déjà un compte <i class='bx bx-link-external'></i></a>
    </form>
    
</section>