<div style="border: 1px solid red; background-color: white; width: 50%; height: 50%;margin-left: 25%; overflow: scroll;">
								<div id="message">
								
								<?php 
								$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id DESC 0, 15');
								while($msg = $tous_les_msg -> fetch())
								{
								?>
									<div align="left">
									<p><?php if(!empty($info_utilisateur['avatar'])) {?><img src="avatars/<?php  echo $msg['avatar']; ?>" width="50" height="50"> <?php echo $msg['pseudo']; }?> <?php ; ?> : <?php echo $msg['msg']; ?></p>
									</div>
								<?php
								}
								?>
							</div>
</div>