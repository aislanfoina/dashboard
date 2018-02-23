<?php if(isset($_SESSION["msgSuccess"])) { ?>
			<div class="alert alert-success">
            	<?php echo $_SESSION["msgSuccess"]; unset($_SESSION["msgSuccess"]);?>
            </div>
<?php } ?>            
<?php if(isset($_SESSION["msgInfo"])) { ?>
			<div class="alert alert-info">
            	<?php echo $_SESSION["msgInfo"]; unset($_SESSION["msgInfo"]);?>
            </div>
<?php } ?>            
<?php if(isset($_SESSION["msgWarning"])) { ?>
			<div class="alert alert-warning">
            	<?php echo $_SESSION["msgWarning"]; unset($_SESSION["msgWarning"]);?>
            </div>
<?php } ?>            
<?php if(isset($_SESSION["msgError"])) { ?>
			<div class="alert alert-danger">
            	<?php echo $_SESSION["msgError"]; unset($_SESSION["msgError"]);?>
            </div>
<?php } ?>            

<?php if(_any("msgSuccess")) { ?>
			<div class="alert alert-success">
            	<?php echo _any("msgSuccess");?>
            </div>
<?php } ?>            
<?php if(_any("msgInfo")) { ?>
			<div class="alert alert-info">
            	<?php echo _any("msgInfo");?>
            </div>
<?php } ?>            
<?php if(_any("msgWarning")) { ?>
			<div class="alert alert-warning">
            	<?php echo _any("msgWarning");?>
            </div>
<?php } ?>            
<?php if(_any("msgError")) { ?>
			<div class="alert alert-danger">
            	<?php echo _any("msgError");?>
            </div>
<?php } ?>            
