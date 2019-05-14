<div id="message">
    <?php 
        $bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");
							    $tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 15');
							    while($msg = $tous_les_msg -> fetch())
							    {
							    ?>
							    <div align="left">
							      <p class="police1 blanc"><a href="profil_principal.php?pseudo=<?php echo $msg['pseudo'] ?>&avatar=<?php echo $msg['avatar'] ?>"><img style="border-radius: 50%;" src="avatars/<?php  echo $msg['avatar']; ?>" width="50" height="50"></a><span style="font-family: arial; text-decoration: underline;"><a href="profil_principal.php?pseudo=<?php echo $msg['pseudo'] ?>&avatar=<?php echo $msg['avatar'] ?>"><?php echo $msg['pseudo']; ?></a></span><span class="noir">:</span><br><span style="margin-left: 5.5%;"><?php echo $msg['msg']; ?></span></p>
							      </div>
							    <?php
							    }
							    ?>
</div>
