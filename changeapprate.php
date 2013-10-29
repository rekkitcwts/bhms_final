<?php
$page_title = "Enter necessary fees";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
$recordId = $_GET['orid'];
?>
<script type="text/javascript">
			$(document).ready(function() {
			$('#generateRate').click(function(){
				// boolean
				var flatironisChecked = $('#flatiron').is(':checked');
				// value
				if(flatironisChecked)
					var flatironrate = $('#flatiron').val();
				else
					var flatironrate = 0;
					
				// boolean
				var cellphoneisChecked = $('#cellphone').is(':checked');
				// value
				if(cellphoneisChecked)
					var cellphonerate = $('#cellphone').val();
				else
					var cellphonerate = 0;
			
				// boolean
				var laptopisChecked = $('#laptop').is(':checked');
				// value
				if(laptopisChecked)
					var laptoprate = $('#laptop').val();
				else
					var laptoprate = 0;
					
				// boolean
				var desktopisChecked = $('#desktop').is(':checked');
				// value
				if(desktopisChecked)
					var desktoprate = $('#desktop').val();
				else
					var desktoprate = 0;
					
				document.getElementById('appliancerate').value = (+flatironrate + +cellphonerate + +laptoprate + +desktoprate);
			});
		});
		</script>


<form action="updateapprate.php" method="post" accept-charset="utf-8">
	<input type="hidden" name="lodger_ssn" value="<?php echo $_GET['ssn'] ?>" >
	<input type="hidden" name="rb_id" value="<?php echo $_GET['rb_id'] ?>" >
	
	<table border="0" class="mytable" cellpadding="0" cellspacing="0" >
		<tbody>
			<tr><th colspan="3">All fields are required.</th></tr>
			<tr><td></td>
			<td>
			<table border="0" class="mytable" cellpadding="0" cellspacing="0" >
			<tbody>
			<tr><th colspan="3">Appliance Rate Generator</th></tr>
			
			<tr><td><input type="checkbox" id="flatiron" value="50" /></td><td>Flat Iron</td></tr>
			<tr><td><input type="checkbox" id="cellphone" value="30" /></td><td> Cellphone Charger</td></tr>
			<tr><td><input type="checkbox" id="laptop" value="150" /></td><td>Laptop</td></tr>
			<tr><td><input type="checkbox" id="desktop" value="450" /></td><td>Desktop</td></tr>
		</tbody>
	</table>
		<input type="button" id="generateRate" value="Generate Appliance Rate" />
			</td>
			</tr>
			<tr><td>Appliance Rate</td><td><input type="text" id="appliancerate" name="appliancerate" value=""></td></tr>
		</tbody>
	</table>

	<input type="submit" name="" value="Set Appliance Rate">
</form>

<?php
// footer
require_once('template/footer.php');
?>