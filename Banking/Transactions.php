<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easy Banking</title>
    <link rel="stylesheet" href="style.css">
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

    <link rel="stylesheet" href="transfer.css">
</head>

<body>
    <div class="content-wrapper-1">
        <img style="background-size: cover;" src="Background2.jpg" alt="Cover Picture">
    </div>
    <div class="content-wrapper-2">
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

    <?php
    include 'Config.php';
    $sql = "SELECT * FROM Transactions";
    $result = mysqli_query($con, $sql);

    ?>

    <div class="content-wrapper-2" style="padding-top: 100px; padding-left: 75px;">
        <div class="text-wrapper">
            <div class="container">
                <div class="headers-1">
                    <h1>Transactions History</h1>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm table-striped table-condensed table-bordered"
                                style="border-color:black;">
                                <thead style="color : black;">
                                    <tr class="headers">
                                        <th style="color : black;" scope="col" class="text-center py-2">Sender</th>
                                        <th style="color : black;" scope="col" class="text-center py-2">Receiver</th>
                                        <th style="color : black;" scope="col" class="text-center py-2">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>

                                    <tr style="color: black;
                                    font-family: 'Signika', sans-serif;
                                    font-size: 22;">
                                        <td class="py-2"><?php echo $rows['From'] ?></td>
                                        <td class="py-2"><?php echo $rows['To'] ?></td>
                                        <td class="py-2"><?php echo $rows['Amount'] ?></td>
                                    </tr>
                                    <?php
                            }
                            ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <footer class="footerr-1">
        Online Banking
        <br>
        Internship of The Sparks Foundation.
        <br>
        Aly Aboelnasr
    </footer>

</body>

</html>