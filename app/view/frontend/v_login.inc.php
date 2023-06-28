<section class="s-log">
    <img src="<?php echo Path::IMG_DESIGN."login.jpg"?>" alt="">
    <form class="log-form"  role="form" method="post" action="index.php?controller=Identification&action=checkConnection">
        <img src="<?php echo Path::IMG."sauzetShop.png"?>" alt="">
        <h3>Se Connecter :</h3>
            <label for="email"><i class='bx bxs-envelope'></i> Email :</label>
        <input type="text" id="email" name="email" required="" placeholder="Email">
        <label for="password"><i class='bx bxs-lock-open-alt' ></i> Mot de passe :</label>
        <input type="password" id="password" name="password" required="" required="" placeholder="mot de passe">
        
        <label for="autoLog">
            <input type="checkbox" id="autoLog" name="autoLog">
            Rester connecté
        </label>
        
        <button type="submit" class="btn btn-primary">Se Connecter</button>
        <a style="align-self: center;" href="index.php?controller=Identification&action=showRegister">Créer un compte <i class='bx bx-link-external'></i></a>
    </form>
    
</section>