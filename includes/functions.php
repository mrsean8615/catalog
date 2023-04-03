<?php

include 'includes/db.php';

function insertData()
{

    // error_reporting(0);



    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

    $salt1 = 'lasnfbvker5jhalkswe5jaslkethjwa45lkjawlk5jsdafg321';
    $salt2 = 'al235lkjhnytjnft6547dr456cfynkl346klilkmnnfg568lkj';
    $saltPass = $salt1 . $password . $salt2;
    $hashPass = hash('sha512', $saltPass);

    $sql = "INSERT into users (username, password) values (?, ?);";

    $statement = $conn->prepare($sql);
    $statement->bind_param("ss", $username, $hashPass);
    $statement->execute();


    $statement->close();
    $conn->close();
}

function validateInfo($username, $password)
{

    // error_reporting(0);

    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

    $salt1 = 'lasnfbvker5jhalkswe5jaslkethjwa45lkjawlk5jsdafg321';
    $salt2 = 'al235lkjhnytjnft6547dr456cfynkl346klilkmnnfg568lkj';
    $saltPass = $salt1 . $password . $salt2;
    $hashPass = hash('sha512', $saltPass);

    $sql = "SELECT * from users WHERE username = ? AND password = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ss", $username, $hashPass);
    $statement->execute();

    $results = $statement->get_result();

    while ($row = $results->fetch_assoc()) {
        if ($row['username'] == $username and $row['password'] == $hashPass) {
            $_SESSION['balance'] = number_format($row['balance']);
            $_SESSION['raw-balance'] = ($row['balance']);

            return false;
        } else {
            return true;
        }
    }

    $statement->close();
    $conn->close();
}
function repeatUsername($username)
{
    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

    $sql = "SELECT * FROM users;";
    $r = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($r)) {
        $dup = false;
        if ($result['username'] == $username) {
            $dup = true;
            break;
        }
    }
    return $dup;
}

function isGranted()
{

    if (isset($_SESSION['granted'])) return true;
    return false;
}
?>
<?php
function showCatalog()
{

    $conn  = connectDB();

    $sql = "SELECT * from product;";

    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($results)) {
?>

        <form action="product.php?id=<?php echo $row['id'] ?>" method="post">
            <div class="product-container">
                <?php echo "<img class='product-img' src='img/" . $row['image'] . "' >"; ?>
                <h2 class="product-name"><?php echo $row['name'] ?></h2>
                <label class="underline"></label>
                <p class="product-desc"><?php echo $row['description'] ?></p>
                <p class="product-price">PRICE: <?php echo number_format($row['price']) ?><img class="bell-price" src="img/bell-bag.png"></p>
                <span hidden class="product-id" name="id"><?php echo $row['id'] ?> </span>
                <input type="submit" name="product-details" class="form-button" value="View Product Details">
            </div>
        </form>



<?php }
} ?>

<?php
function showProduct()
{
    $productID = isset($_GET['id']) ? $_GET['id'] : false;


    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

    $sql = "SELECT * FROM product WHERE id = ?;";

    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $productID);
    $statement->execute();

    $results = $statement->get_result();

    while ($row = $results->fetch_assoc()) { ?>
        <form method="post" class="product-container">
            <div class="product-img-container">
                <?php echo "<img class='product-img' src='img/" . $row['image'] . "' >"; ?>
            </div>
            <div class="content-container">
                <h2 class="product-name"><?php echo $row['name'] ?></h2>
                <p class="product-desc"><?php echo $row['description'] ?> </p>
                <span class="product-price">PRICE: <?php echo number_format($row['price']) ?><img class="bell-price" src="img/bell-bag.png"></span>
                <span class="qty-title">QTY:</span>
                <input type="hidden" name="id" value="<?php echo $productID; ?>">
                <input type="number" class="qty-field" min="1" name="qty" id="qty" value="1" required>
                <div class='formBtns'>
                    <a href="catalog.php"><button type="button" class="form-button">Return to Catalog </button></a>

                    <input type="submit" id="cartBtn" class="form-button" name="add-cart" value="Add to Cart">
                </div>
            </div>
        </form>
        <div class="nook-advice">
            <div class="box">
                <div class="advice">
                    <p><?php echo $row['advice'] ?></p>
                </div>
            </div>
            <div class="right-point"></div>

            <img src="img/tom-nook-creep.png" class="nook">
        </div>
        </div>



<?php
        $statement->close();
        $conn->close();
    }
}
?>

<?php
function addToCart()
{


    if (isset($_POST['add-cart'])) {
        $conn = connectDB();
        if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

        $sql = 'SELECT * FROM product WHERE id = ' . $_POST['id'] . ' LIMIT 1';

        $results = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $price = $row['price'];
            $productName = $row['name'];
            $productImg = $row['image'];
        }
        if (!isset($_SESSION['productID'])) {
            $_SESSION['productID'] = array();
            $_SESSION['image'] = array();
            $_SESSION['qty'] = array();
            $_SESSION['price'] = array();
            $_SESSION['name'] = array();
        }
        array_push($_SESSION['productID'], $_POST['id']);
        array_push($_SESSION['qty'], $_POST['qty']);
        array_push($_SESSION['image'], $productImg);
        array_push($_SESSION['price'], $price);
        array_push($_SESSION['name'], $productName);
    }
    $conn->close();
}


function tooMuchBells()
{
    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);

    $sql = 'SELECT * FROM users;';

    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        if ($row['username'] == $_SESSION['user']) {
            if ($row['balance'] + $_POST['bell-value'] > 999999999) {
                return true;
            } else return false;
        }
    }



    $conn->close();
}

function addBells()
{
    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);
    $bellInput = $_POST['bell-value'];
    $username = $_SESSION['user'];

    $sql = "UPDATE users SET balance = balance + '$bellInput' WHERE username='$username'";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function updateBells()
{
    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);
    $username = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username = '$username'";

    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $_SESSION['raw-balance'] = $row['balance'];
    }
}
function removeFunds()
{
    $conn = connectDB();
    if ($conn->connect_error) die("Connection Falied! Error number: " + $conn->connect_errno);
    $bellInput = $_SESSION['total'];
    $username = $_SESSION['user'];

    $sql = "UPDATE users SET balance = balance - '$bellInput' WHERE username='$username'";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function checkFunds()
{


    if (isset($_POST['order'])) {
        if ($_SESSION['raw-balance'] - $_SESSION['total'] < 0) {
            return true;
        } else {
            return false;
        }
    }
}

function clearCart()
{
    unset($_SESSION['productID']);
    unset($_SESSION['image']);
    unset($_SESSION['qty']);
    unset($_SESSION['price']);
    unset($_SESSION['name']);
}
?>