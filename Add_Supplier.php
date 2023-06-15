<?php

include_once("connection.php");
if (isset($_POST["btnAdd"])) {
	$name = $_POST["txtName"];
	$email = $_POST["txtEmail"];
	$address = $_POST["address"];
	$err = "";

	if ($name == "") {
		$err .= "<li>Enter Supplier Name, please</li>";
	}
	if ($err != "") {
		echo "<ul>$err</ul>";
	} else {
		$sq = "SELECT *
			FROM public.suppliers where suppliers.suppname = '$name';";
		$result = pg_query($conn, $sq);
		if (pg_num_rows($result) == 0) {
			pg_query($conn, "INSERT INTO public.suppliers (suppname, suppemail, suppaddress) VALUES ('$name', ' $email', '$address');");
			echo '<meta http-equiv="refresh" content="0;URL=?page=supplier_management"/>';
		} else {
			echo "<li>Duplicate supplier ID or Name</li>";
		}
	}
}

?>

<div class="container">
	<h2>Adding Suppliers</h2>
	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="txtTen" class="col-sm-2 control-label">Supplier Name(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
			</div>
		</div>
		<div class="form-group">
			<label for="txtMoTa" class="col-sm-2 control-label">Email(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email" value='<?php echo isset($_POST["txtEmail"]) ? ($_POST["txtEmail"]) : ""; ?>'>
			</div>
		</div>

		<div class="form-group">
			<label for="txtMoTa" class="col-sm-2 control-label">Address(*): </label>
			<div class="col-sm-10">
				<input type="text" name="address" id="address" class="form-control" placeholder="Address" value='<?php echo isset($_POST["address"]) ? ($_POST["address"]) : ""; ?>'>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
				<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Supplier_Management.php'" />
			</div>
		</div>
	</form>
</div>