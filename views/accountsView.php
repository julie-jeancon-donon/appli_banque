<?php
include('includes/header.php');
?>

<div class="container">
	
	<header class="row">
		<p>Bonjour, <?php echo $_SESSION['name'] ;?></p>

	</header>
	
		<form class="signout mt-3" action="../controllers/account.php" method="post">
			<!-- <input type="hidden" name="token" value="<?php echo $token; ?>"> -->
			<input type="hidden" name="verif" value="">
			<input class="signout" type="submit" name="logout" value="Déconnexion">
		</form>

	
			<h1 class="title text-center">Mes comptes bancaires</h1>
		
				
				<div class="row mx-auto mt-4">
					<form class="newAccount text-center mx-auto col-10 col-md-5 col-lg-4 col-xl-3" action="account.php" method="post">
						<label>Quel compte souhaitez vous créer?</label>
						
						

						<select class="open-account text-center" name="name" required>
							<option value="">Sélectionner un type de compte</option>
							<?php foreach ($account_type as $value) { ?>

							<option value="<?php echo $value->getId_type();?>"><?php echo $value->getName();?></option>
							<?php } ?>
							<!-- <option value="PEL">PEL</option>
							<option value="Compte courant">Compte courant</option>
							<option value="Compte joint">Compte joint</option>
							<option value="Livret A">Livret A</option>	 -->
						</select>
						<input type="submit" name="new" class="open-account p-1" value="Valider">
					</form>
				</div>
		
		<?php
			if($errorAccount){
		?>
			<div class="error-message col-10 col-md-6 col-lg-5 mt-3 mx-auto text-center"> 
					<div class="cross pr-0 pt-1 text-right">
						<a href="../controllers/account.php">X</a>
					</div>
					<div class="text-center p-1">
						<p>Ce compte existe déjà.</p>
					</div>
				
			
			</div>
		<?php
				}
		?>
					<hr>

			<div class="row mx-auto cont">

				<!-- for each account saved -->
				<?php
				

				foreach($accounts[0] as $account)
				{
				######### start of generated code for each loop round ######### 
				
				?>
					<div class="card-container col-12 col-md-6 col-lg-4">

						<div class="card mx-auto">
							<h3><strong>
							<?php	
							// display account name
							foreach($accounts[1] as $nameAccount){
								if($account->getTypeAccount() == $nameAccount->getId_type()){

									echo $nameAccount->getName();
								break;
								} 

							}
							
							?>
							</strong></h3>
							
							<div class="card-content">
									<p
									<?php 
										if($account->getBalance() <= 0)
											{
												echo 'class="red amount"';
											}
										else{
											echo 'class="green amount"';
										}
										?>
										>Somme disponible : 
									<?php 
									// display account balance

									echo $account->getBalance(); 
									?> €</p>

										<!-- Form for credit/debit -->
										<h4>Dépot / Retrait</h4>
											<form action="account.php" method="post">
												<input type="hidden" name="id" value="<?php echo $account->getId();?>" required>
												<label>Entrer une somme à débiter/créditer</label>
												<input type="number" name="balance" placeholder="Ex: 250" required>
												<input type="submit" name="payment" value="Créditer">
												<input type="submit" name="debit" value="Débiter">
											</form>


										
										<h4>Transfert</h4>
										<!-- Form for transfer -->
											<form action="account.php" method="post">
												<label>Entrer une somme à transférer</label>
												<input type="number" name="balance" placeholder="Ex: 300"  required>
												<input type="hidden" name="idDebit" value="<?php echo $account->getId();?>" required>
												<label for="">Sélectionner un compte pour le virement</label>
												<select name="idPayment" required>
													<option value="">Choisir un compte</option>
													<?php 
													// display accounts   
													foreach($accounts[0] as $accountTransfer)
													{echo 'blop';
														if($account->getId() !== $accountTransfer->getId())
														{
															foreach($accounts[1] as $accountName){ 
																if($accountTransfer->getTypeAccount() == $accountName->getId_type()){?>
																
																<option value="<?php echo $accountTransfer->getId();?>"><?php
																echo $accountName->getName();
																?></option>
																<?php
																}
															}
													
														}
													
													}
													?>
													
												</select>
												<input type="submit" name="transfer" value="Transférer l'argent">
											</form>

											<!-- Form to delete-->
											<form class="delete" action="account.php" method="post">
												<input type="hidden" name="id" value="<?php 
												echo $account->getId();
												// display account ID ?>"  required>
												<input type="submit" name="delete" value="Supprimer le compte">
											</form>

							</div>
					</div>
					
												</div>
													
				<?php }
				// ######### end of generated code for each loop round ######### 
				?>
			</div>


<?php

include('includes/footer.php');

 ?>