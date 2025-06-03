<?php
    include "dbconnect.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <!--====search bar====-->
    <form action="" method="POST"><!--html skanya? -->
        <input type="search" name="search" placeholder="Find your wristique" required>
        <input type="submit" name="submit" value="search" class="btn btn-primary">
    </form> 
    
    <?php
    $search = $_POST['search'];

    $sql_search = "SELECT * FROM products 
                    WHERE pdt_name LIKE '%$search%' OR description LIKE '%$search%'";
    $execute_search = mysqli_query($conn,$sql_search);
    $count_result = mysqli_num_rows($execute_search);

    if($count_result>0)
    {
        while($row=mysqli_fetch_assoc($execute_search))
        {
            $pdt_id = $row ['pdt_id'];
            $pdt_img = $row ['pdt_img'];
            $pdt_name = $row ['pdt_name'];
            $pdt_description = $row ['pdt_description'];
            $pdt_price = $row ['pdt_price'];
            ?>


            <a href="category-foods.php?category_id=<?php echo $pdt_id ?>">
                <div class="box-3 float-container">
                    <?php 
                if($image_name=="")
                {
                    echo "<div class='error'>Image not available.</div>";
                }
                else
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                    <?php
                }
                ?>
                
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $pdt_name;?></h4>
                <p class="food-price">$<?php echo $pdt_price; ?> </p>
                <p class="food-detail">
                    <?php echo $pdt_description; ?>
                </p>
                <br>
                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php
                       
        }

    }
    else
    {
        echo "<div class='error'>Product not found.</div>";
    }





?>

<div class="clearfix"></div>
</body>
</html>
