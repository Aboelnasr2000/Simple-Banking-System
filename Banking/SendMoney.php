<?php
include 'Config.php';
if (isset($_POST['submit'])) {
    $from = $_GET['Id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * FROM users WHERE ID = $from";
    $query = mysqli_query($con, $sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * FROM users WHERE ID = $to";
    $query = mysqli_query($con, $sql);
    $sql2 = mysqli_fetch_array($query);


    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Please Enter A Positive Amount")';
        echo '</script>';
    } else if ($amount > $sql1['Balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Amount Is Greater Than Your Available Balance")';
        echo '</script>';
    } else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Cant Transfer Zero Amount')";
        echo "</script>";
    } else {

        $newbalance = $sql1['Balance'] - $amount;
        $sql = "UPDATE Users SET Balance = $newbalance WHERE ID = $from";
        mysqli_query($con, $sql);



        $newbalance = $sql2['Balance'] + $amount;
        $sql = "UPDATE Users SET Balance = $newbalance WHERE ID = $to";
        mysqli_query($con, $sql);

        $sender = $sql1['Email'];
        $receiver = $sql2['Email'];
        $sql = "INSERT INTO Transactions(`From`, `To`, `Amount`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "<script> alert('Transaction Successful');
                                     window.location='Transactions.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}

?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easy Banking</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@427&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="transfer.css">
</head>


<body>
    <div class="content-wrapper">
        <img src="Background2.jpg" alt="Cover Picture">
    </div>
    <div class="content-wrapper">
        <div class="text-wrapper">
            <h3>Easy Banking Foundation</h3>

            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="TransferMoney.php">Transfer Money</a></li>
                <li><a href="Transactions.php">Transactions</a></li>
                <li><a href="About.php">About</a></li>

            </ul>
        </div>
    </div>

    <div class="content-wrapper-2" style="padding-top: 100px; padding-left: 75px;">
        <div class="text-wrapper">
            <div class="container">
                <div class="headers-1">
                    <h1>Transactions</h1>
                </div>
                <?php
        
        $sid = $_GET['Id'];
        $sql = "SELECT * FROM  Users WHERE Id = $sid";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Error : " . $sql . "<br>" . mysqli_error($con);
        }
        $rows = mysqli_fetch_assoc($result);
        ?>
                <form method="post" name="tcredit" class="tabletext"><br>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive-sm">
                                <table class="table table-hover table-sm table-striped table-condensed table-bordered"
                                    style="border-color:black;">
                                    <thead style="color : black;">
                                        <tr class="headers">
                                            <th style="color : black;" scope="col" class="text-center py-2">Id</th>
                                            <th style="color : black;" scope="col" class="text-center py-2">Name</th>
                                            <th style="color : black;" scope="col" class="text-center py-2">Email</th>
                                            <th style="color : black;" scope="col" class="text-center py-2">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="color: black;
                                    font-family: 'Signika', sans-serif;
                                    font-size: 22;">
                                            <td class="py-2"><?php echo $rows['ID'] ?></td>
                                            <td class="py-2"><?php echo $rows['Name'] ?></td>
                                            <td class="py-2"><?php echo $rows['Email'] ?></td>
                                            <td class="py-2"><?php echo $rows['Balance'] ?></td>

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="headers">
                        <label><b>Transfer To:</b></label>
                    </div>
                    <select name="to" class="cust-select" required>
                        <option value="" style="color: black;">Select Receiver</option>
                        <?php
                include 'Config.php';
                $sid = $_GET['Id'];
                $sql = "SELECT * FROM Users WHERE ID != $sid";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    echo "Error " . $sql . "<br>" . mysqli_error($con);
                }
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                        <option style="color: black;" class="table" value="<?php echo $rows['ID']; ?>">

                            <?php echo $rows['Email']; ?>
                            (Balance:
                            <?php echo $rows['Balance']; ?> )

                        </option>
                        <?php
                }
                ?>
                        <div>
                    </select>
                    <br>
                    <br>
                    <div class="headers">
                        <label"><b>Amount:</b></label>
                    </div>
                    <input type="number" class="cust-select" name="amount" required>
                    <br><br>
                    <div class="text-center">
                        <button name="submit" type="submit" id="myBtn">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <footer class="footerr-2">
        Online Banking
        <br>
        Internship of The Sparks Foundation.
        <br>
        Aly Aboelnasr
    </footer>

</body>

</html>