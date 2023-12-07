<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that the necessary parameters are set
    if (isset($_POST["idDonThuoc"]) && isset($_POST["field"]) && isset($_POST["value"]) && isset($_POST["prescriptionDate"])) {
        $idDonThuoc = $_POST["idDonThuoc"];
        $field = $_POST["field"];
        $value = $_POST["value"];
        $prescriptionDate = $_POST["prescriptionDate"];

        // Create a database connection
        $conn = new mysqli("localhost", "root", "", "cnpm", "3306");

        // Check connection
        if ($conn->connect_errno) {
            echo "Kết nối MYSQLi lỗi" . $conn->connect_error;
            exit();
        }

      // Update the specified field and prescription date in the database
      $query = "UPDATE donthuoc SET $field ='$value' WHERE idDonThuoc = $idDonThuoc";

        // Debugging: Echo the query
        echo "Query: " . $query . "<br>";

        // Execute the query
        if ($conn->query($query) === TRUE) {
            // If the update is successful, echo a success message
            echo "Success";
            header("Location: donke.php?idDonThuoc=" . $idDonThuoc);
            exit();
        } else {
            // If the update fails, echo an error message
            echo "Error updating record: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // If parameters are not set, echo an error message
        echo "Missing parameters";
    }
} else {
    // If the request method is not POST, echo an error message
    echo "Invalid request method";
}
?>
