<?php
// Read the file
$file = "response.txt";
$responses = [];

if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $entry = [];

    foreach ($lines as $line) {
        if (strpos($line, "----------------------------------") !== false) {
            if (!empty($entry)) {
                $responses[] = $entry;
            }
            $entry = [];
        } else {
            list($key, $value) = explode(":", $line, 2);
            $entry[trim($key)] = trim($value);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responses Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .table-container {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }
    th {
      background: #0077cc;
      color: white;
    }
    tr:hover {
      background: #f1f9ff;
    }
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead tr {
        display: none;
      }
      tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: white;
      }
      td {
        border: none;
        display: flex;
        justify-content: space-between;
        padding: 8px 10px;
        font-size: 13px;
      }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #0077cc;
      }
    }
  </style>
</head>
<body>
  <h1>Franchise Responses</h1>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>City</th>
          <th>Budget</th>
          <th>Mobile</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($responses)): ?>
          <?php foreach ($responses as $index => $response): ?>
            <tr>
              <td data-label="S.No"><?php echo $index + 1; ?></td>
              <td data-label="Name"><?php echo htmlspecialchars($response['Name'] ?? ''); ?></td>
              <td data-label="City"><?php echo htmlspecialchars($response['City'] ?? ''); ?></td>
              <td data-label="Budget"><?php echo htmlspecialchars($response['Budget'] ?? ''); ?></td>
              <td data-label="Mobile"><?php echo htmlspecialchars($response['Mobile'] ?? ''); ?></td>
              <td data-label="Email"><?php echo htmlspecialchars($response['Email'] ?? ''); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align:center;">No responses found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
