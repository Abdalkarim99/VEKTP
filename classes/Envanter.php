<?php

class Envanter
{

    public $id;
    public $product_name;
    public $product_price;
    public $product_information;

    public static function getAddproduct($conn)
    {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_information = mysqli_real_escape_string($conn, $_POST['product_information']);


        $query = "INSERT INTO products(id,product_name,product_price,product_information)
                VALUES ('$id','$product_name','$product_price','$product_information')";

        $result = mysqli_query($conn, $query);
        if ($result === true) {

            // echo "product inserted successfully";
            redirect('/inventory.php');
        } else {
            echo mysqli_error($conn);
        }
    }

    public static function getTable($conn)
    {
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "
            <tr>
                <th>ID</th> 
                <th>Product_Name</th>
                <th>product_Price</th>
                <th>product_information</th>
            </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["product_name"] . "</td>
                    <td>" . $row["product_price"] . "</td>
                    <td>" . $row["product_information"] . "</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No products found.";
        }
    }

    public static function getSearch($conn, $error)
    {

        $searchTerm = $_POST['search'];

        if (!$searchTerm) {
            $error .= "no result found";
        }
        if ($error) {
            $error = "<b>There were error(s) in your search!</b> <br>" . $error;
        } else {
            if (isset($_POST['submit'])) {
                $sql = "SELECT * FROM products WHERE id LIKE '%$searchTerm%' or product_name LIKE '%$searchTerm%' or product_price LIKE '%$searchTerm%'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "
            <tr>
                <th>ID</th>
                <th>Product_Name</th>
                <th>product_Price</th>
                <th>product_information</th>
            </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["product_name"] . "</td>
                    <td>" . $row["product_price"] . "</td>
                    <td>" . $row["product_information"] . "</td>
                </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "no result found";
                }
            }
        }
    }

    public static function getById($conn)
    {
    }
}
