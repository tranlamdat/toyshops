<?php
include_once("connection.php");
function bind_Category_List($conn, $selectValue)
{
	$sqlstring = "SELECT catid, catname from category";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='CategoryList' class='form-control'>
					<option value='0'>Choose category</option>";
	while ($row = pg_fetch_array($result)) {
		if ($row['catid'] == $selectValue) {
			echo "<option value='" . $row['catid'] . "' selected>" . $row['catname'] . "</option>";
		} else {
			echo "<option value='" . $row['catid'] . "'>" . $row['catname'] . "</option>";
		}
	}
	echo "</select>";
}
function bind_Shop_List($conn, $selectValue)
{
	$sqlstring = "SELECT shopid, shopname from shop";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='ShopList' class='form-control'>
					<option value='0'>Choose shop</option>";
	while ($row = pg_fetch_array($result)) {
		if ($row['shopid'] == $selectValue) {
			echo "<option value='" . $row['shopid'] . "' selected>" . $row['shopname'] . "</option>";
		} else {
			echo "<option value='" . $row['shopid'] . "'>" . $row['shopname'] . "</option>";
		}
	}
	echo "</select>";
}
function bind_Supplier_List($conn, $selectValue)
{
	$sqlstring = "SELECT suppid, suppname from suppliers";
	$result = pg_query($conn, $sqlstring);
	echo "<select name='SupplierList' class='form-control'>
					<option value='0'>Choose suppliers</option>";
	while ($row = pg_fetch_array($result)) {
		if ($row['suppid'] == $selectValue) {
			echo "<option value='" . $row['suppid'] . "' selected>" . $row['suppname'] . "</option>";
		} else {
			echo "<option value='" . $row['suppid'] . "'>" . $row['suppname'] . "</option>";
		}
	}
	echo "</select>";
}
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sqlstring = "SELECT proname, proquantity, proprice, prodes, proimage, catid, shopid, suppid
		FROM product WHERE proid = '$id'";
	$result = pg_query($conn, $sqlstring);
	$row = pg_fetch_assoc($result);

	$proname = $row["proname"];
	$price = $row["proprice"];
	$proquantity = $row["proquantity"];
	$des = $row["prodes"];
	$pic = $row["proimage"];
	$shop = $row["shopid"];
	$sup = $row["suppid"];
	$category = $row["catid"];
?>
	<div class="container my-3">
		<?php
		if (isset($_POST["btnUpdate"])) {
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
			} else {
				if ($pic['name'] != "") {
					if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
						if ($pic["size"] < 614400) {
							$sq = "SELECT * FROM product WHERE proid = '$id' and proname = '$proname'";
							$result = pg_query($conn, $sq);
							if (pg_num_rows($result) == 0) {
								copy($pic['tmp_name'], "products/" . $pic['name']);
								$filePic = $pic['name'];
								$sqlstring = "UPDATE product SET 
											proname ='$proname', proprice='$price',  
											proquantity='$proquantity', prodes='$des',
											proimage='$filePic', catid='$category', shopid='$shop', suppid='$sup'
											WHERE proid='$id'";
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
				} else {
					$sq = "SELECT * FROM product WHERE proid != '$id' and proname = '$proname'";
					$result = pg_query($conn, $sq);
					if (pg_num_rows($result) == 0) {
						// copy($pic['tmp_name'], "img/" . $pic['name']);
						$filePic = $pic['name'];
						$sqlstring = "UPDATE product SET proname ='$proname', 
										proprice='$price', proquantity='$proquantity', prodes='$des',
										catid='$category', shopid='$shop', suppid='$sup' WHERE proid='$id'";
						pg_query($conn, $sqlstring);
						echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
					} else {
						echo "<li>Duplicate category Name</li>";
					}
				}
			}
		}
		?>
		<h2>Updating Product</h2>
		<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
			<div class="form-inputs mt-3">
				<label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
				<div class="col-sm-10">
					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proname; ?>' />
				</div>
			</div>
			<div class="form-inputs mt-3">
				<label for="" class="col-sm-2 control-label">Product category(*): </label>
				<div class="col-sm-10">
					<?php
					bind_Category_List($conn, $category);
					?>
				</div>
			</div>
			<div class="form-inputs mt-3">
				<label for="" class="col-sm-2 control-label">Shop(*): </label>
				<div class="col-sm-10">
					<?php
					bind_Shop_List($conn, $shop);
					?>
				</div>
			</div>
			<div class="form-inputs mt-3">
				<label for="" class="col-sm-2 control-label">Supplier(*): </label>
				<div class="col-sm-10">
					<?php
					bind_Supplier_List($conn, $sup);
					?>
				</div>
			</div>

			<div class="form-inputs mt-3">
				<label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
				<div class="col-sm-10">
					<input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>' />
				</div>
			</div>

			<div class="form-inputs mt-3">
				<label for="lblShort" class="col-sm-2 control-label">Description(*): </label>
				<div class="col-sm-10">
					<input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo $des ?>' />
				</div>
			</div>

			<div class="form-inputs mt-3">
				<label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
				<div class="col-sm-10">
					<input type="number" name="txtQuantity" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $proquantity ?>" />
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
					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
					<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=product_management'" />

				</div>
			</div>
		</form>
	</div>

<?php
} else {
	echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
}
?>