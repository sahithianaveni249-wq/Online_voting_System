<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../index.html");
    exit; 
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = ($userdata['status'] == 0) ? 
    '<b style="color:red">Not Voted</b>' : 
    '<b style="color:green">Voted</b>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>

<div id="mainsection">
    <div id="headersection">
        <a href="../index.html"><button style="float:left">Back</button></a>
        <a href="logout.php"><button style="float:right;">Logout</button></a>
        <a href="results.php"><button style="float:right; margin-right:10px; background-color: orange; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">Results</button></a>

        <h1>Online Voting System</h1>
    </div>
    <hr>

    <div id="mainpanel">
        <div id="Profile">
            <center>
                <img src="../uploads/<?php echo $userdata['photo']; ?>" height="200" width="200">
            </center>
            <br><br>
            <b>Name:</b> <?php echo $userdata['name']; ?><br><br>
            <b>Address:</b> <?php echo $userdata['adress']; ?><br><br>
            <b>Mobile:</b> <?php echo $userdata['mobile']; ?><br><br>
            <b>Status:</b> <?php echo $status; ?><br><br>
        </div>

        <div id="group">
        <?php 
        if(!empty($groupsdata)) {
            for($i = 0; $i < count($groupsdata); $i++) {
        ?>
            <div class="group-card">
                <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100" width="100">
                <b>Group Name:</b> <?php echo $groupsdata[$i]['name']; ?><br><br>
                <b>Votes:</b> <?php echo $groupsdata[$i]['votes']; ?><br><br>

                <form action="../api/voter.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">

                    <?php if($_SESSION['userdata']['status'] == 0){ ?>
                        <input type="submit" name="votebtn" value="Vote" id="votebtn">
                    <?php } else { ?>
                        <button disabled id="voted" style="background-color: green; color: white;">Voted</button>
                    <?php } ?>
                </form>
            </div>
        <?php
            }
        } else {
            echo "<b>No groups available</b>";
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>