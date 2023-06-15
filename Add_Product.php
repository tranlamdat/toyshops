<?php
include_once("connection.php");
function bind_Category_List($conn)
{
	$sqlstring = "SELECT catid, catname from category";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='CategoryList' class='form-control'>
					<option value='0'>Choose category</option>";
	while ($row = pg_fetch_assoc($result)) {
		echo "<option value='" . $row['catid'] . "'>" . $row['catname'] . "</option>";
	}
	echo "</select>";
}
function bind_Supplier_List($conn)
{
	$sqlstring = "SELECT suppid, suppname from suppliers";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='SupplierList' class='form-control'>
					<option value='0'>Choose supplier</option>";
	while ($row = pg_fetch_assoc($result)) {
		echo "<option value='" . $row['suppid'] . "'>" . $row['suppname'] . "</option>";
	}
	echo "</select>";
}
function bind_Shop_List($conn)
{
	$sqlstring = "SELECT shopid, shopname from shop";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='ShopList' class='form-control'>
					<option value='0'>Choose shop</option>";
	while ($row = pg_fetch_assoc($result)) {
		echo "<option value='" . $row['shopid'] . "'>" . $row['shopname'] . "</option>";
	}
	echo "</select>";
}
if (isset($_POST["btnAdd"])) {
	$proname = $_POST["txtName"];
	$price = $_POST["txtPrice"];
	$proquantity = $_POST["txtQuantity"];
	$des = $_POST["txtDes"];
	$pic = $_FILES["txtImage"];
	$shop = $_POST["ShopList"];
	$sup = $_POST["SupplierList"];
	$category = $_POST["CategoryList"];

	$err = "";
	if (trim($proname) == "") {
		$err .= "<li>Enter product Name, please</li>";
	}
	if ($category == "0") {
		$err .= "<li>Choose product category, please</li>";
	}
	if (!is_numeric($price)) {
		$err .= "<li>Product price must be number</li>";
	}
	if (!is_numeric($proquantity)) {
		$err .= "<li>Product quantity must be number</li>";
	}
	if ($err != "") {
		echo "<ul>$err</ul>";
	} else {
		if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
			if ($pic["size"] < 614400) {
				$sq = "SELECT * FROM product WHERE proname = '$proname'";
				$result = pg_query($conn, $sq);
				if (pg_num_rows($result) == 0) {
					copy($pic['tmp_name'], "products/" . $pic['name']);
					$filePic = $pic['name'];
					$sqlstring = "INSERT INTO product (
							proname, 
							proquantity, 
							proprice, 
							prodes,
							proimage, 
							catid, 
							shopid,
							suppid)
							VALUES ('$proname', '$proquantity', '$price', '$des','$filePic','$category', '$shop', '$sup')";
					pg_query($conn, $sqlstring);
					echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
				} else {
					echo "<li>Duplicate product ID or Name</li>";
				}
			} else {
				echo "Size of image too big";
			}
		} else {
			echo "Image format is not correct";
		}
	}
}
?>
<div class="container my-3">
	<h2>Adding new Product</h2>
	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
		<div class="form-inputs mt-3">
			<label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='' />
			</div>
		</div>
		<div class="form-inputs mt-3">
			<label for="" class="col-sm-2 control-label">Product category(*): </label>
			<div class="col-sm-10">
				<?php
				bind_Category_List($conn);
				?>
			</div>
		</div>
		<div class="form-inputs mt-3">
			<label for="" class="col-sm-2 control-label">Shop(*): </label>
			<div class="col-sm-10">
				<?php
				bind_Shop_List($conn);
				?>
			</div>
		</div>
		<div class="form-inputs mt-3">
			<label for="" class="col-sm-2 control-label">Supplier(*): </label>
			<div class="col-sm-10">
				<?php
				bind_Supplier_List($conn);
				?>
			</div>
		</div>

		<div class="form-inputs mt-3">
			<label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='' />
			</div>
		</div>

		<div class="form-inputs mt-3">
			<label for="lblShort" class="col-sm-2 control-label">Description(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='' />
			</div>
		</div>

		<div class="form-inputs mt-3">
			<label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
			<div class="col-sm-10">
				<input type="number" name="txtQuantity" id="txtQty" class="form-control" placeholder="Quantity" value="" />
			</div>
		</div>

		<div class="form-inputs mt-3">
			<label for="sphinhanh" class="col-sm-2 control-label">Image(*): </label>
			<div class="col-sm-10">
				<input type="file" name="txtImage" id="txtImage" class="form-control" value="" />
			</div>
		</div>

		<div class="form-inputs mt-3">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
				<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Product_Management.php'" />
			</div>
		</div>
	</form>
</div>