<?php
require_once('db.php');


define("ROW_PER_PAGE", 5);

$search_keyword = '';
if (!empty($_GET['search_keyword'])) {
    $search_keyword = $_GET['search_keyword'];
}

$sql = 'SELECT * FROM company WHERE name LIKE :keyword OR email LIKE :keyword OR address LIKE :keyword ORDER BY id DESC ';

$per_page_html = '';
$page = 1;
$start = 0;
$limit = '';

if (!empty($_GET["page"])) {
    $page = $_GET["page"];
    $start = ($page - 1) * ROW_PER_PAGE;
    $limit = " LIMIT " . $start . "," . ROW_PER_PAGE;
}

$pagination_statement = $conn->prepare($sql);
$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pagination_statement->execute();

// Fetch row count and ensure it's numeric
$row_count = (int)$pagination_statement->rowCount();

$total_pages = ceil($row_count / ROW_PER_PAGE);

$per_page_html .= "<div style='text-align:end;margin:20px 0px;'>";

// $page = min(max(1, $page), $total_pages);

$start_page = max(1, $page - 2);
$end_page = min($total_pages, $start_page + 4);

if ($page > 1) {
    $per_page_html .= '<input type="button" name="page" value="Previous" class="btn-page" onclick="fetchResults('.($page - 1).')" />';
}

for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $page) {
        $per_page_html .= '<input type="button" name="page" value="' . $i . '" class="btn-page current" onclick="fetchResults('.$i.')" />';
    } else {
        $per_page_html .= '<input type="button" name="page" value="' . $i . '" class="btn-page" onclick="fetchResults('.$i.')" />';
    }
}

if ($page < $total_pages) {
    $per_page_html .= '<input type="button" name="page" value="Next" class="btn-page" onclick="fetchResults('.($page + 1).')" />';
}

$per_page_html .= "</div>";

$query = $sql . $limit; // Include the LIMIT clause only if $limit is defined
$pdo_statement = $conn->prepare($query);
$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

$output = '';
if (!empty($result)) {
    foreach ($result as $row) {
        $output .= '<tr class="table-row">';
        $output .= '<td>' . $row['id'] . '</td>';
        $output .= '<td>' . $row['name'] . '</td>';
        $output .= '<td>' . $row['email'] . '</td>';
        $output .= '<td>' . $row['address'] . '</td>';
       
        $output .= '<td><a href="#deleteEmployeeModal" class="delete" data-toggle="modal" 
        data-id="'.$row['id'].'"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></a></td>';
        $output .= '<td> <a href="edit.php?id='.$row['id'].'" class="edit"><i
        class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a></td>';
        $output .= '</tr>';
    }
} else {
    $output .= '<tr><td colspan="4">No results found</td></tr>';
}


$response = array(
    'html' => $output,
    'pagination' => $per_page_html
);

header('Content-Type: application/json');
echo json_encode($response);
?>
