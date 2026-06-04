<?php
session_start();
include("../api/connect.php");

if(!isset($_SESSION['userdata'])){
    header("location: ../index.html");
    exit; 
}

// Fetch only Groups (role 2)
$groups = mysqli_query($connect, "SELECT name, photo, votes FROM user WHERE role=2 ORDER BY votes DESC");
$groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

$total_overall_votes = 0;
foreach($groupsdata as $group) {
    $total_overall_votes += $group['votes'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Election Results</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <style>
        body {
            background-color: #56CCF2;
            background: linear-gradient(to right, #2F80ED, #56CCF2);
            font-family: Arial, sans-serif;
        }
        #results-container {
            width: 70%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
        }
        .winner-card {
            background-color: #FFD700;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid #DAA520;
        }
        .group-row {
            text-align: left;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .bar-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 10px;
            height: 20px;
            margin-top: 5px;
        }
        .bar {
            height: 100%;
            background-color: blue;
            border-radius: 10px;
            width: 0%;
            transition: width 1.5s ease-in-out;
        }
        .group-img { float: right; border-radius: 5px; }
        .header-btn {
            padding: 10px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div style="padding: 20px;">
    <a href="dashboard.php" class="header-btn" style="float:left;">Back to Dashboard</a>
    <a href="logout.php" class="header-btn" style="float:right;">Logout</a>
    <h1 style="color: white; clear: both; padding-top: 10px;">Election Results</h1>
</div>

<div id="results-container">
    <?php if(!empty($groupsdata)): ?>
        <div class="winner-card">
            <h2>🏆 Current Leader 🏆</h2>
            <img src="../uploads/<?php echo $groupsdata[0]['photo']; ?>" height="100">
            <h3><?php echo $groupsdata[0]['name']; ?></h3>
            <p>Votes: <?php echo $groupsdata[0]['votes']; ?></p>
        </div>

        <h3>Detailed Breakdown</h3>
        <p>Total Votes: <?php echo $total_overall_votes; ?></p>

        <?php foreach($groupsdata as $index => $group): 
            $perc = ($total_overall_votes > 0) ? round(($group['votes'] / $total_overall_votes) * 100, 1) : 0;
        ?>
            <div class="group-row">
                <img class="group-img" src="../uploads/<?php echo $group['photo']; ?>" height="50">
                <b><?php echo ($index+1).". ".$group['name']; ?></b><br>
                Votes: <?php echo $group['votes']; ?> (<?php echo $perc; ?>%)
                <div class="bar-container">
                    <div class="bar" data-width="<?php echo $perc; ?>%"></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results yet.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const bars = document.querySelectorAll('.bar');
        setTimeout(() => {
            bars.forEach(bar => {
                bar.style.width = bar.getAttribute('data-width');
            });
        }, 500);
    });
</script>

</body>
</html>