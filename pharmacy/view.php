<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/view.css">
</head>

<body>
    <?php
    include("database.php");
    $query = "SELECT image_1 FROM userimages";
    $result = mysqli_query($conn, $query);

    ?>


    <div class="container">
        <!-- Image Section -->
        <div class="prescription-section">
            <div class="prescription-image-placeholder">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);  // fetch as object

                    echo "<img src='../client/" . htmlspecialchars($row['image_1']) . "' alt='Image' width='400px'>";
                } else {
                    echo "<p style='text-align:center;'>No image found.</p>";
                }
                ?>
            </div>
            <div class="thumbnail-gallery">
                <!-- thumbnail 1 -->
                <?php
                $query2 = "SELECT image_2 FROM userimages";
                $result2 = mysqli_query($conn, $query2);
                $image_2 = mysqli_fetch_assoc($result2);

                if (empty($image_2)) {
                    echo "<div class='thumbnail'>No image</div>";
                } else {
                    echo "<div class='thumbnail'><img src='../client/" . htmlspecialchars($image_2['image_2']) . "' alt='Image2' width='70px' ></div>";
                }
                ?>
                <!-- thumbnail 2 -->
                <?php
                $query3 = "SELECT image_3 FROM userimages";
                $result3 = mysqli_query($conn, $query3);
                $image_3 = mysqli_fetch_assoc($result3);

                if (empty($image_3)) {
                    echo "<div class='thumbnail'>No image</div>";
                } else {
                    echo "<div class='thumbnail'><img src='../client/" . htmlspecialchars($image_3['image_3']) . "' alt='Image3' width='70px'></div>";
                }
                ?>
                <!-- thumbnail 3 -->
                <?php
                $query4 = "SELECT image_4 FROM userimages";
                $result4 = mysqli_query($conn, $query4);
                $image_4 = mysqli_fetch_assoc($result4);
                if (empty($image_4)) {
                    echo "<div class='thumbnail'>No image</div>";
                } else {
                    echo "<div class='thumbnail'><img src='../client/" . htmlspecialchars($image_4['image_4']) . "' alt='Image4' width='70px'></div>";
                }
                ?>
                <!-- thumbnail 4 -->
                <?php
                $query5 = "SELECT image_5 FROM userimages";
                $result5 = mysqli_query($conn, $query5);
                $image_5 = mysqli_fetch_assoc($result5);
                if (empty($image_5)) {
                    echo "<div class='thumbnail'>No image</div>";
                } else {
                    echo "<div class='thumbnail'><img src='../client/" . htmlspecialchars($image_5['image_5']) . "' alt='Image5' width='70px'></div>";
                }
                ?>



            </div>
        </div>
        <!-- Order Section  -->
        <div class="order-details-section">
            <form method=" post" action="mail.php">
                <div class="order-summary">
                    <table>
                        <thead>
                            <tr>
                                <th>Drug</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="orderItemsBody">
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="2" style="text-align: right;">Total</td>
                                <td id="totalAmount">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="add-item-form">
                    <div class="form-group">
                        <label for="drugName">Drug</label>
                        <input type="text" id="drugName" name="drugName" />
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" id="quantity" name="quantity" placeholder="e.g. 10 " />
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" id="rate" name="rate" placeholder="e.g. 5.00" />
                    </div>
                    <button type="button" class="add-button">Add</button>
                </div>

                <div class="separator"></div>

                <button type="button" class="send-quotation-button">Send Quotation</button>
            </form>
        </div>
        

        <script src="./assets/script.js"></script>

    </div>
</body>

</html>

<?php
$conn->close();
?>