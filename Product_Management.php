<script>
    function deleteConfirm() {
        if (confirm("Are you sure to delete!")) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?php
include_once("connection.php");
if (isset($_GET["function"]) == "del") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $result = pg_query($conn, "SELECT proimage from product where proid='$id'");
        $image = pg_fetch_array($result);
        $del = $image["proimage"];
        unlink("products/" . $del);
        pg_query($conn, "delete from product where proid='$id'");
        echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
    }
}
?>
<form name="frm" method="post" action="">
    <h1>Product Management</h1>
    <p>
        <a href="?page=add_product">
            <img src="images/add.png" alt="" width="16" height="16" border="0" /> Add new
        </a>
    </p>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Description</strong></th>
                <th><strong>Image</strong></th>
                <th><strong>Category ID</strong></th>
                <th><strong>Shop ID</strong></th>
                <th><strong>Supplier ID</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once("connection.php");
            $No = 1;
            $result = pg_query($conn, "SELECT proid, proname, proquantity, proprice, prodes, catname, suppname, shopname, proimage
                    FROM product a, category b, suppliers c, shop d
                    WHERE a.catid = b.catid and a.suppid = c.suppid and a.shopid = d.shopid");
            while ($row = pg_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $No; ?></td>
                    <td><?php echo $row["proname"]; ?></td>
                    <td><?php echo $row["proquantity"]; ?></td>
                    <td><?php echo $row["proprice"]; ?></td>
                    <td><?php echo $row["prodes"]; ?></td>
                    <td align='center' class='columnfunction'>
                        <img src='products/<?php echo $row["proimage"]; ?>' border='0' width="50" height="50" />
                    </td>
                    <td><?php echo $row["catname"]; ?></td>
                    <td><?php echo $row["shopname"]; ?></td>
                    <td><?php echo $row["suppname"]; ?></td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=Update_Product&&id=<?php echo $row['proid']; ?>">
                            <img src="images/edit.png" width="16" height="16" border='0' />
                        </a>
                    </td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=product_management&&function=del&&id=<?php echo $row["proid"]; ?>" onclick="return deleteConfirm()">
                            <img src="images/delete.png" width="16" height="16" border='0' />
                        </a>
                    </td>
                </tr>
            <?php
                $No++;
            }
            ?>
        </tbody>

    </table>

</form>