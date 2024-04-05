<?php
require_once 'db.php'; // Include database connection

// Retrieve the search query from the request parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the SQL statement with placeholders
$sql = "SELECT * FROM company";
if (!empty($search)) {
    $sql .= " WHERE name LIKE :search OR email LIKE :search OR address LIKE :search";
}

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the search parameter if it's not empty
if (!empty($search)) {
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
}


// Execute the statement
$stmt->execute();
// Fetch the results
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tototl = count($companies);
// Display the results in table format
?>

<table class="table table-striped">

    <tbody>
        <?php foreach ($companies as $company): ?>
        <tr>
            <td><?php echo $company['id']; ?></td>
            <td><?php echo $company['name']; ?></td>
            <td><?php echo $company['email']; ?></td>
            <td><?php echo $company['address']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $company['id']; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="<?php echo $company['id']; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $current_page =1; 
    $total_records = $tototl;
    $no_recode_in_one_page = 5;

?>
<div class="pagination"> 
<?php if ($current_page > 1): ?>
<a href="?page=<?php echo $current_page - 1; ?>" class="btn btn-primary">
    <
        <?php endif; ?>

        <?php
        // Calculate the total number of pages
        $total_pages = ceil($total_records / $no_recode_in_one_page);

        // Calculate the range for displaying page numbers
        $start = max(1, $current_page - 2);
        $end = min($total_pages, $current_page + 2);

        // Display page numbers within the range
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $current_page) {
                echo "<a href='?page=$i' class='btn btn-primary active'>$i</a>";
            } else {
                echo "<a href='?page=$i' class='btn btn-primary'>$i</a>";
            }
        }
        ?>

        <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?php echo $current_page + 1; ?>" class="btn btn-primary">></a>
        <?php endif; ?>
</div>

