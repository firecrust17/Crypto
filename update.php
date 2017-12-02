<?php 

	if(isset($_GET['BTC'])){
		$min_val['BTC']['INR'] = $_GET['BTC'];
		$min_val['ETH']['INR'] = $_GET['ETH'];
		$min_val['XRP']['INR'] = $_GET['XRP'];
		$min_val['LTC']['INR'] = $_GET['LTC'];
		$per_array['BTC']['INR'] = $_GET['BTCP'];
		$per_array['ETH']['INR'] = $_GET['ETHP'];
		$per_array['XRP']['INR'] = $_GET['XRPP'];
		$per_array['LTC']['INR'] = $_GET['LTCP'];
		file_put_contents("min_val.txt", json_encode($min_val));
		file_put_contents("percent.txt", json_encode($per_array));
	}

	$min_array = json_decode(file_get_contents("min_val.txt"),true);
	$max_array = json_decode(file_get_contents("max_val.txt"),true);
	$per_array = json_decode(file_get_contents("percent.txt"),true);


?>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
<script type="text/javascript">
	function update(){
		var data = [];
		data['BTC']['INR'] = 700000;
		data['BTC']['INR'] = 700000;
		data['BTC']['INR'] = 700000;
		data['BTC']['INR'] = 700000;
		alert(JSON.stringify(data));
	}
</script>
<form>
	BTC: <input type="text" name="BTC" value="<?php echo $min_array['BTC']['INR'];?>"> MAX: <?php echo $max_array['BTC']['INR'];?><br>
	ETH: <input type="text" name="ETH" value="<?php echo $min_array['ETH']['INR'];?>"> MAX: <?php echo $max_array['ETH']['INR'];?><br>
	XRP: <input type="text" name="XRP" value="<?php echo $min_array['XRP']['INR'];?>"> MAX: <?php echo $max_array['XRP']['INR'];?><br>
	LTC: <input type="text" name="LTC" value="<?php echo $min_array['LTC']['INR'];?>"> MAX: <?php echo $max_array['LTC']['INR'];?><br>
	<br>
	BTC: <input type="text" name="BTCP" value="<?php echo $per_array['BTC']['INR'];?>"> PER: <?php echo $max_array['BTC']['INR']*$per_array['BTC']['INR'];?><br>
	ETH: <input type="text" name="ETHP" value="<?php echo $per_array['ETH']['INR'];?>"> PER: <?php echo $max_array['ETH']['INR']*$per_array['ETH']['INR'];?><br>
	XRP: <input type="text" name="XRPP" value="<?php echo $per_array['XRP']['INR'];?>"> PER: <?php echo $max_array['XRP']['INR']*$per_array['XRP']['INR'];?><br>
	LTC: <input type="text" name="LTCP" value="<?php echo $per_array['LTC']['INR'];?>"> PER: <?php echo $max_array['LTC']['INR']*$per_array['LTC']['INR'];?><br>
	<br>
	<input type="submit" value="Update" onclick="update()">
</form>