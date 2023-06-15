<?php
include_once("connection.php");
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$result = pg_query($conn, "SELECT * FROM shop WHERE shopid='$id'");
	$row = pg_fetch_assoc($result);
    $shopid = $row['shopid'];
	$name = $row['shopname'];
	$address = $row['address'];
	$phone = $row['phonenumber'];

?>
	<div class="container">
		<h2>Updating Shop</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group">
				<label for="txtTen" class="col-sm-2 control-label">Shop ID(*): </label>
				<div class="col-sm-10">
					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Shop ID" readonly value='<?php echo $shopid ?>'>
				</div>
		</div>
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
					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
					<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=shop_management'" />

				</div>
			</div>
		</form>
	</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtID"];
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
			$sq = "Select * from shop where shopid != '$id' and shopname= '$name'";
			$result = pg_query($conn, $sq);
			if (pg_num_rows($result) == 0) {
				pg_query($conn, "UPDATE shop SET shopname = '$name', address='$address', phonenumber='$phone' WHERE shopid='$id'");
				echo '<meta http-equiv="refresh" content="5;URL=?page=shop_management"/>';
			} else {
				echo "<li>Duplicate Shop Namme</li>";
			}
		}
	}
} else {
	echo '<mete http-equiv="refresh" content="0;URL=?page=shop_management"/>';
}
?>