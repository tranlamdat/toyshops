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
            pg_query($conn, "DELETE FROM suppliers WHERE suppid = '$id'");
        }
    }
    ?>
<form name="frm" method="post" action="">
    <h1>Suppliers Management</h1>
    <p>
        <a href="?page=add_supplier">
            <img src="images/add.png" alt="" width="16" height="16" border="0" /> Add new
        </a>
    </p>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Suppliers Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once("connection.php");
            $No = 1;
            $result = pg_query($conn, "SELECT suppid, suppname, suppemail, suppaddress
                    FROM suppliers");
            while ($row = pg_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $No; ?></td>
                    <td><?php echo $row["suppname"]; ?></td>
                    <td><?php echo $row["suppemail"]; ?></td>
                    <td><?php echo $row["suppaddress"]; ?></td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=update_supplier&&id=<?php echo $row['suppid']; ?>">
                            <img src="images/edit.png" width="16" height="16" border='0' />
                        </a>
                    </td>
                    <td align='center' class='columnfunction'>
                        <a href="?page=supplier_management&&function=del&&id=<?php echo $row["suppid"]; ?>" onclick="return deleteConfirm()">
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