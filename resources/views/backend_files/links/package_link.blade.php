<!DOCTYPE html>
<html lang="en">
<head>
  <title>Package Link</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Package Link</h2>
  
  <!-- Package Link Table -->
  <table class="table">
    <thead>
      <tr>
        <th>S.no.</th>
        <th>Package Name</th>
        <th>Link</th>
      </tr>
    </thead>
    <tbody>
      <!-- Loop through customer_array and display each package's data -->
      @foreach($customer_array as $row => $col)
        <tr>
          <td>{{ $col['S.no.'] }}</td>
          <td>{{ $col['Package Name'] }}</td>
          <td>{{ $col['Link'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>