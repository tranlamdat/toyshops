   <script>
       function deleteConfirm() {
           if (confirm("Are you sure to delete")) {
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
            pg_query($conn, "DELETE FROM category WHERE catid = '$id'");
        }
    }
    ?>
   <form name="frm" method="post" action="">
       <h1>Category Management</h1>
       <p>
           <img src="images/add.png" alt="Add new" width="16" height="16" border="0" /> <a href="?page=add_category"> Add</a>
       </p>
       <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                   <th><strong>No.</strong></th>
                   <th><strong>Category Name</strong></th>
                   <th><strong>Desscriptin</strong></th>
                   <th><strong>Edit</strong></th>
                   <th><strong>Delete</strong></th>
               </tr>
           </thead>

           <tbody>
               <?php
                include_once("connection.php");
                $No = 1;
                $result = pg_query($conn, "SELECT * FROM category");
                while ($row = pg_fetch_assoc($result)) {
                ?>
                   <tr>
                       <td class="cotCheckBox"><?php echo $No; ?></td>
                       <td><?php echo $row["catname"]; ?></td>
                       <td><?php echo $row["catdes"]; ?></td>
                       <td style='text-align:center'>
                           <a href="?page=update_category&&id=<?php echo $row["catid"]; ?>"><img src='images/edit.png' border='0' />
                       </td>
                       <td style='text-align:center'>
                           <a href="?page=category_management&&function=del&&id=<?php echo $row["catid"]; ?>" onclick="return deleteConfirm()">
                               <img src='images/delete.png' border='0' />
                           </a>
                       </td>
                   </tr>
               <?php
                    $No++;
                }
                ?>

           </tbody>
       </table>


       <!--Nut them moi nut xoa tat ca->
        <div class="row" style="background-color:#FFF"><!--Nut chuc nang-->
       <div class="col-md-12">

       </div>
       </div>
       <!--Nut chuc nang-->
   </form>