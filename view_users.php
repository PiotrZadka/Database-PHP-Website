<?php
$page_title = 'View Users';
include ('header.html');

echo '<h3>Registered Users</h3>';

require_once ('mysqli_connect.php');

$query = "SELECT CONCAT(last_name, ', ', first_name) AS Name, DATE_FORMAT(registration_date, '%M %d, %Y') AS Registered, DATE_FORMAT(dob, '%M %d, %Y') AS dob FROM users
ORDER BY registration_date ASC";

$results = @mysqli_query ($conn, $query);
$numrows = mysqli_num_rows($results);

if ($results) {
  if ($numrows >0) {
    echo '<p>There are ' . $numrows . ' registered users;</p>';
    echo '<table>
    <tr>
    <td><strong>Name</stong></td>
    <td><strong>Date Registered</stong></td>
    <td><strong>Date of birth</stong></td>
    </tr>';
    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
      echo '<tr><td>' . $row['Name'] . '</td><td>' . $row['Registered'] .'</td><td>' . $row['dob'] . '</td></tr>';
    }
    echo '</table>';
    mysqli_free_result ($results);
  } else {
      echo '<p class="error">There are no registered users.</p>';
    }
} else {
  echo '<h3 class="error">System Error</h3>
  <p class="error">User data could not be retrieved.</p>';
  //DEBUGGING echo '<p class="error">' . mysqli_error($conn) . '</p>
  //DEBUGGING <p class="error">Query: ' . $query . '</p>';
  }
mysqli_close($conn);
include ('footer.html');
?>
