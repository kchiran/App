<?php
if (!empty($_GET['type']))  {
    $keyword = $_GET['keyword'];
    $search = $_GET['type'];
    if ($search=="name") {

$sql="select * from mycontacts where name LIKE '%$keyword%'";
    }
    else if ($search=="address"){
$sql="select * from mycontacts where Address LIKE '%$keyword%'";
    }
    else if ($search=="phone") {
$sql="select * from mycontacts where phone LIKE '%$keyword%'";

   }
   echo "<br>";
   echo "<a href='list.php'> List View </a>"; 
   echo "<br>";
}
else {
    $sql = "SELECT * FROM mycontacts";
    $search="";
    echo "<a href='index.php'> Add New </a>";
}

?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
<input type="text" name="keyword">
<select name="type">
                    <option value="name" <?php if ($search=="name"){echo "selected=selected";} ?> >Name</option>
                    <option value="address" <?php if ($search=="address"){echo"selected=selected";} ?> >Address</option>
                    <option value="phone"<?php if ($search=="phone"){echo "selected=selected";} ?> >Phone</option>
                    
             </select>
<input type="submit" value="Search">     
</form>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "mycontacts");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
//////////////



//----------------------------------------------------
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            ?>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phonecode</th>
            <th>Phone</th>
            <th>Actions</th>
            </tr>
            <?php
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['Address'] . "</td>";
                echo "<td>" . $row['City'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phonecode'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                /*
                echo "<td>" . "<a href='edit.php?id=". $row['id']."'>Edit</a>";
                echo "Delete";
                echo " </td>";
                //echo "<td>"<a class="button" href="edit.php?id='. $row['id'] .'">'Edit</a>;
               // echo '<a class="button" href="delete.php?id='. $row['id'] .'"'>Delete</a>;
               */
              $id=$row['id'];
               ?>
                <td><a href="edit.php?id=<?php echo $id;?>"> Edit </a> &nbsp;&nbsp;
                <a href="delete.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure?')"> Delete </a> 
                </td>
               <?php 
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Close connection
mysqli_close($link);
?>