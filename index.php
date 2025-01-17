<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Update online status for the logged-in user
$updateStatusQuery = "UPDATE Users SET online_status = 'online' WHERE user_id = $user_id";
$conn->query($updateStatusQuery);

// SQL query to fetch names of friends of the current user
$selectFriendsQuery = "SELECT Users.name, Friends.friend_id 
                       FROM Users 
                       INNER JOIN Friends ON Users.user_id = Friends.friend_id 
                       WHERE Friends.user_id = $user_id AND Users.user_id != $user_id";

$resultSelectFriends = $conn->query($selectFriendsQuery);

// Check if the user is an admin
$checkAdminQuery = "SELECT is_admin FROM Users WHERE user_id = $user_id";
$resultAdminCheck = $conn->query($checkAdminQuery);
$isAdmin = $resultAdminCheck->fetch_assoc()['is_admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="index.css">
=======
    <link rel="stylesheet" href="index.css"> <!-- Include your CSS file -->
>>>>>>> 5edaea36266ccc33c59404f5a1e7fa4b76beff80
    <script src="https://kit.fontawesome.com/9e81387435.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="friend.php">Friend requests</a>
            <?php 
<<<<<<< HEAD
=======
            // Check if there are pending friend requests
>>>>>>> 5edaea36266ccc33c59404f5a1e7fa4b76beff80
            $checkFriendRequest = "SELECT * FROM FriendRequests WHERE receiver_id = $user_id AND status = 'pending'";
            $resultFriendRequestCheck = $conn->query($checkFriendRequest);
            if ($resultFriendRequestCheck->num_rows > 0) {
                echo "<i class='fa-solid fa-bell'></i>";
            }
            ?>
            <a href="usersettings.html">User settings</a>
            <a href="logout.php">Logout</a>
            <a href="Faq.html">Faq</a>
<<<<<<< HEAD
            <?php
            if ($isAdmin == True) {
                echo "<a href='admin.php'>Admin</a>";
            };
=======
            <?php 
            if ($isAdmin) {
                echo "<a href='admin.php'>Admin</a>";
            }
>>>>>>> 5edaea36266ccc33c59404f5a1e7fa4b76beff80
            ?>
        </div>
    </nav>

    <div class="container">
        <div class="search-container">
            <form action="search.php" method="post">
                <input type="text" placeholder="Search for people" name="search">
                <input type="submit" value="Search">
            </form>
        </div>
        
<<<<<<< HEAD
        <div class="friend-container">
            <?php
            if ($resultSelectFriends->num_rows > 0) {
                echo "<h2>Friends</h2>";

                while ($row = $resultSelectFriends->fetch_assoc()) {
                    echo "<div class='friend'>";
                    echo "<form action='chat.php' method='post' class='friend-form'>";
                    echo "<button type='submit' name='friendId' value='" . $row['friend_id'] . "'>" . $row['name'] . "</button>";
                    echo "<input type='hidden' name='friendName' value='" . $row['name'] . "'>";
                    echo "<input type='hidden' name='friendId' value='" . $row['friend_id'] . "'>";
                    echo "</form>";

                    echo "<form action='remove_friend.php' method='post' class='friend-form'>";
                    echo "<button type='submit' name='friendId' value='" . $row['friend_id'] . "'>Remove</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>You don't have any friends yet.</p>";
            }
            ?>
        </div>
    </div>
=======
        <div class="container">
    <div class="search-container">
        <form action="search.php" method="post">
            <input type="text" placeholder="Search for people" name="search">
            <input type="submit" value="Search">
        </form>
    </div>
    
    <div class="friend-container">
        <?php
        if ($resultSelectFriends->num_rows > 0) {
            echo "<h2>Friends</h2>";

            while ($row = $resultSelectFriends->fetch_assoc()) {
                echo "<form action='chat.php' method='post'>";
                echo "<button type='submit' name='friendId' value='" . $row['friend_id'] . "'>" . $row['name'] . "</button>";
                echo "<input type='hidden' name='friendName' value='" . $row['name'] . "'>";
                echo "<input type='hidden' name='friendId' value='" . $row['friend_id'] . "'>";
                echo "</form>";

                echo "<form action='remove_friend.php' method='post'>";
                echo "<button type='submit' name='friendId' value='" . $row['friend_id'] . "'>Remove</button>";
                echo "</form>";
                echo "<br>";
                
                echo "<button class='report-btn' onclick='toggleReportForm' data-friend-id='" . $row['friend_id'] . "'>Report</button>";
                
                echo "<form class='report-form' action='report.php' method='post'>";
                echo "<input type='hidden' name='friendId' value='" . $row['friend_id'] . "'>";
                echo "<label for='reportType'>Report Type:</label><br>";
                echo "<select id='reportType' name='reportType'>";
                echo "<option value='harassment'>Harassment</option>";
                echo "<option value='spam'>Spam</option>";
                echo "<option value='inappropriate'>Inappropriate Content</option>";
                echo "</select><br>";
                echo "<label for='reportHeader'>Header:</label><br>";
                echo "<input type='text' id='reportHeader' name='reportHeader'><br>";
                echo "<label for='reportDescription'>Description:</label><br>";
                echo "<textarea id='reportDescription' name='reportDescription'></textarea><br><br>";
                echo "<button type='submit'>Report</button>";
                echo "</form>";
            }
        } else {
            echo "<p>You don't have any friends yet.</p>";
        }
        ?>
    </div>
</div>

<script>
    function toggleReportForm(button) {
        var reportForm = button.nextElementSibling;
        reportForm.classList.toggle('display-visible');
    }
</script>


>>>>>>> 5edaea36266ccc33c59404f5a1e7fa4b76beff80
</body>
</html>
