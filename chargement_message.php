<div style="border: 1px solid red; background-color: white;">
								<div id="message">
								
								<?php 
								$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id LIMIT 0, 7');
								while($msg = $tous_les_msg -> fetch())
								{
								?>
									<div align="center">
									<p><?php if(!empty($info_utilisateur['avatar'])) {?><img src="avatars/<?php  echo $info_utilisateur['avatar']; ?>" width="50" height="50"> <?php }?> <?php echo $info_utilisateur['pseudo'] ; ?> : <?php echo $msg['msg']; ?></p>
									</div>
								<?php
								}
								?>
							</div>
</div>