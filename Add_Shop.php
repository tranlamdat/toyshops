<?php

include_once("connection.php");
if (isset($_POST["btnAdd"])) {
	$name = $_POST["txtName"];
	$address = $_POST["address"];
	$phone = $_POST["phone"];
	$err = "";

	if ($name == "") {
		$err .= "<li>Enter Shop Name, please</li>";
	}
	if ($err != "") {
		echo "<ul>$err</ul>";
	} else {
		$sq = "SELECT *
			FROM public.shop where shop.shopname = '$name';";
		$result = pg_query($conn, $sq);
		if (pg_num_rows($result) == 0) {
			pg_query($conn, "INSERT INTO public.shop (shopname, address, phonenumber) VALUES ('$name', ' $address', '$phone');");
			echo '<meta http-equiv="refresh" content="0;URL=?page=shop_management"/>';
		} else {
			echo "<li>Duplicate shop ID or Name</li>";
		}
	}
}

?>

<div class="container">
	<h2>Adding Shop</h2>
	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="txtTen" class="col-sm-2 control-label">Shop Name(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Shop Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
			</div>
		</div>

		<div class="form-group">
			<label for="txtMoTa" class="col-sm-2 control-label">Address(*): </label>
			<div class="col-sm-10">
				<input type="text" name="address" id="address" class="form-control" placeholder="Address" value='<?php echo isset($_POST["address"]) ? ($_POST["address"]) : ""; ?>'>
			</div>
		</div>
		<div class="form-group">
			<label for="txtMoTa" class="col-sm-2 control-label">Phone(*): </label>
			<div class="col-sm-10">
				<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value='<?php echo isset($_POST["phone"]) ? ($_POST["phone"]) : ""; ?>'>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
				<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Shop_Management.php'" />

			</div>
		</div>
	</form>
</div>