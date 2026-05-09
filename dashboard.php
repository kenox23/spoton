<?php
include 'connect.php';
include 'readrecords.php';
?>

<h2>List of Students</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID Number</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Middlename</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($resultset)) { ?>

<tr>

    <td><?php echo $row['userid']; ?></td>

    <td><?php echo $row['firstname']; ?></td>

    <td><?php echo $row['lastname']; ?></td>

    <td><?php echo $row['middleinitial']; ?></td>

    <td>
        <a href="update.php?id=<?php echo $row['userid']; ?>">
            UPDATE
        </a>

        |

        <a href="delete.php?id=<?php echo $row['userid']; ?>">
            DELETE
        </a>
    </td>

</tr>

<?php } ?>

</table>
