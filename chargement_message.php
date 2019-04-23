				<div align="center">
			<?php
			$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=","","");
			$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 5');
			while($msg = $tous_les_msg -> fetch())
			{
			?>
			<div align="center">
				<div style="width: 25%; background-color: red;">
					<div align="left">
				<p><?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo']; } ?></b> : <?php echo $msg['msg']; ?></p>
					</div>
				</div>
			</div>
		</div>
			<?php
			}
			?>
