<?php
require "../header.php";
require_once "../dbconnection.php";

if (isset($_REQUEST["submit"])) {
    $productName = $_REQUEST["prodName"];
    $productPrice = $_REQUEST["prodPrice"];
    // $productImage = $_REQUEST["prodImage"];

    $imageDir = "../productImage/";


    // imageUpload
    $imageName = date("Y_m_D_h_i_sa") . "." . pathinfo($_FILES["prodImage"]["name"], PATHINFO_EXTENSION);
    $imagefullpath = $imageDir . $imageName;
    // echo $imagefullpath;
    move_uploaded_file($_FILES["prodImage"]["tmp_name"], $imagefullpath);

    $query = "INSERT INTO productinfo (name, Image, Price) VALUES ('$productName','$imageName','$productPrice')";
    mysqli_query($conn, $query);
    header("location: ../view/viewProduct.php");
    exit();



}

?>

<section id="addProduct">
    <div class="text-center text-2xl bg-amber-200 font-bold py-2">
        Add Product
    </div>
    <div class="w-full lg:w-3/4 mx-auto py-10">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="flex flex-wrap items-center my-1">
                <label for="prodImage" class="w-1/3 text-right pr-10"> Product Image</label>
                <input type="file" name="prodImage" id="prodImage" placeholder="Image"
                    class="w-2/3 px-3 py-1 text-md border" />
            </div>
            <div class="flex flex-wrap items-center my-1">
                <label for="prodName" class="w-1/3 text-right pr-10"> Product Name</label>
                <input type="text" name="prodName" id="prodName" placeholder="Enter Product Name"
                    class="w-2/3 px-3 py-1 text-md border" />
            </div>
            <div class="flex flex-wrap items-center my-1">
                <label for="prodPrice" class="w-1/3 text-right pr-10"> Product Price</label>
                <input type="text" name="prodPrice" id="prodPrice" placeholder="Product Price"
                    class="w-2/3 px-3 py-1 text-md border" />
            </div>
            <div class="text-center my-4">
                <button type="submit" name="submit"
                    class="border-2 bg-green-400 hover:bg-green-700 text-gray-800 hover:text-red-100 duration-300 font-semibold rounded-2xl px-3 py-2">Add
                    Product</button>
            </div>
        </form>
    </div>

</section>
<script src="/ProjectPHP/src/assets/js/main.js"></script>
</body>

</html>