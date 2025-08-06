<?php
include 'db_connect.php';


// Insert Data
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];


    $sql = "INSERT INTO students (name, email, department) VALUES ('$name', '$email', '$department')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green; text-align:center;'>New record added successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $conn->error . "</p>";
    }
}


// Search Data
$nameSearch = "";
$deptSearch = "";
if (isset($_POST['search_name'])) {
    $nameSearch = $_POST['search_name_text'];
}
if (isset($_POST['search_department'])) {
    $deptSearch = $_POST['search_department_text'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert, Display & Search Data</title>
    <style>
        form {
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input, select, button {
            width: 90%;
            margin: 5px 0;
            padding: 8px;
        }
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .search-box {
            text-align: center;
            margin: 10px;
        }
    </style>
</head>
<body>


<h2 style="text-align:center;">Add Student</h2>
<form method="POST" action="">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="department" required>
        <option value="">Select Department</option>
        <option value="CSE">CSE</option>
        <option value="EEE">EEE</option>
        <option value="BBA">BBA</option>
    </select>
    <button type="submit" name="submit">Insert</button>
</form>
<!-- Search by Name -->
<h1 style="text-align:center">Search by Name<h1>
<div class="search-box">
    <form method="POST" action="">
        <input type="text" name="search_name_text" placeholder="Search by Name" value="<?php echo $nameSearch; ?>">
        <button type="submit" name="search_name">Search by Name</button>
    </form>
</div>
<!-- Search by Department -->
<h1 style="text-align:center">Search by Department<h1>
<div class="search-box">
    <form method="POST" action="">
        <input type="text" name="search_department_text" placeholder="Search by Department" value="<?php echo $deptSearch; ?>">
        <button type="submit" name="search_department">Search by Department</button>
    </form>
</div>
<h2 style="text-align:center;">Student Records</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
    </tr>
    <?php
    if (!empty($nameSearch)) {
        $sql = "SELECT * FROM students WHERE name LIKE '%$nameSearch%'";
    } elseif (!empty($deptSearch)) {
        $sql = "SELECT * FROM students WHERE department LIKE '%$deptSearch%'";
    } else {
        $sql = "SELECT * FROM students";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['department']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }
    ?>
</table>
</body>
</html>
