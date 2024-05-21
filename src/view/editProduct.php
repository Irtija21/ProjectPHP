<?php
require "../header.php";
require_once "../dbconnection.php";

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Fetch product details from database
    $sqlQuery = "SELECT * FROM `productinfo` WHERE `id` = $id";
    $result = mysqli_query($conn, $sqlQuery);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update product details in database
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $product['Image']; // Default to existing image

    // Check if a new image was uploaded
    if ($_FILES['image']['name']) {
        $image = date("Y_m_D_h_i_sa") . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $targetDir = "../productImage/";
        $targetFile = $targetDir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    $updateQuery = "UPDATE `productinfo` SET `name` = '$name', `Price` = '$price', `Image` = '$image' WHERE `id` = $id";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
    header("Location: ../view/viewProduct.php");
    exit();
}

?>

<section id="editProduct">
    <div class="text-center text-2xl bg-amber-200 font-bold py-2">
        Edit Product
    </div>
    <div class="w-full lg:w-3/4 mx-auto py-10">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Product Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" name="name" type="text" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Product Price
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="price" name="price" type="text" value="<?php echo $product['Price']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Product Image
                </label>
                <input type="file" id="image" name="image">
                <img src="../productImage/<?php echo $product['Image']; ?>" style="width: 100px;" />
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</section>
<script src="/ProjectPHP/src/assets/js/main.js"></script>
</body>

</html>