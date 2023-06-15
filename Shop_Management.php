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
            pg_query($conn, "DELETE FROM shop WHERE shopid = '$id'");
        }
    }
    ?>
<form name="frm" method="post" action="">
    <h1>Shop Management</h1>
    <p>
        <a href="?page=add_shop">
            <img src="images/add.png" alt="" width="16" height="16" border="0" /> Add new
        </a>
    </p>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Shop Name</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Phone Number</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once("connection.php");
            $No = 1;
            $result = pg_query($conn, "SELECT shopid, shopname, address, phonenumber FROM shop");
            while ($row = pg_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $No; ?></td>
                    <td><?php echo $row["shopname"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["phonenumber"]; ?></td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=update_shop&&id=<?php echo $row['shopid']; ?>">
                            <img src="images/edit.png" width="16" height="16" border='0' />
                        </a>
                    </td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=shop_management&&function=del&&id=<?php echo $row["shopid"]; ?>" onclick="return deleteConfirm()">
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