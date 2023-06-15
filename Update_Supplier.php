<?php
include_once("connection.php");
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$result = pg_query($conn, "SELECT * FROM suppliers WHERE suppid='$id'");
	$row = pg_fetch_assoc($result);
    $suppid = $row['suppid'];
	$name = $row['suppname'];
	$email = $row['suppemail'];
	$address = $row['suppaddress'];

?>
	<div class="container">
		<h2>Updating Suppliers</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group">
				<label for="txtTen" class="col-sm-2 control-label">Suppliers ID(*): </label>
				<div class="col-sm-10">
					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Suppliers ID" readonly value='<?php echo $suppid ?>'>
				</div>
		</div>
		<div class="form-group">
			<label for="txtTen" class="col-sm-2 control-label">Suppliers Name(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Suppliers Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
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
					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
					<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=supplier_management'" />

				</div>
			</div>
		</form>
	</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtID"];
		$name = $_POST["txtName"];
	    $email = $_POST["txtEmail"];
	    $address = $_POST["address"];
		$err = "";
		if ($name == "") {
			$err .= "<li>Enter Suppliers Name, please</li>";
		}
		if ($err != "") {
			echo "<ul>$err</ul>";
		} else {
			$sq = "Select * from suppliers where suppid != '$id' and suppname= '$name'";
			$result = pg_query($conn, $sq);
			if (pg_num_rows($result) == 0) {
				pg_query($conn, "UPDATE suppliers SET suppname = '$name', suppemail='$email', suppaddress='$address' WHERE suppid='$id'");
				echo '<meta http-equiv="refresh" content="5;URL=?page=supplier_management"/>';
			} else {
				echo "<li>Duplicate Supplier Namme</li>";
			}
		}
	}
} else {
	echo '<mete http-equiv="refresh" content="0;URL=?page=supplier_management"/>';
}
?>