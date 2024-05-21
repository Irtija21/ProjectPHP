<?php
use LDAP\Result;

require "../header.php";
require_once "../dbconnection.php";

?>

<section id="addProduct">
    <div class="text-center text-2xl bg-amber-200 font-bold py-2">
        View Product
    </div>
    <div class="w-full lg:w-3/4 mx-auto py-10">
        <table class="w-full ">
            <tr>
                <th class="border py-2">sl.</th>
                <th class="border py-2">Image</th>
                <th class="border py-2">Product Name</th>
                <th class="border py-2">Product Price</th>
                <th class="border py-2">Action</th>
            </tr>

            <?php
            $sqlQuery = "SELECT * FROM `productinfo` WHERE 1";
            $result = mysqli_query($conn, $sqlQuery);
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "" . $row["name"] . $row["Price"] . $row["Image"];
                $counter++;
                ?>

                <tr>
                    <td class="border text-center px-2 py-2"><?php echo $counter; ?></td>
                    <td class="border text-center px-2 py-2 flex justify-center">
                        <img src="../productImage/<?php echo $row["Image"]; ?>" style="width: 100px;" />
                    </td>
                    <td class="border px-2 py-2 text-center"><?php echo $row["name"]; ?></td>
                    <td class="border text-center px-2 py-2"><?php echo $row["Price"]; ?></td>
                    <td class="border text-center px-2 py-2">
                    <a href="./editProduct.php?id=<?php echo $row["id"]; ?>">Edit</a>
                        /
                        <a href="./deleteProduct.php?id=<?php echo $row["id"]; ?>">Delete</a>
                    </td>
                </tr>

                <?php
            }
            ?>


        </table>
    </div>

</section>
<script src="/ProjectPHP/src/assets/js/main.js"></script>
</body>

</html>