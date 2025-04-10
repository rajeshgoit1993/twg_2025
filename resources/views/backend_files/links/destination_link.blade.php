<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ $destination_type }} Destination Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>{{ $destination_type }} Destination Data</h2>

  <!-- Destination Data Table -->
  <table class="table">
    <!-- Conditional Table Headers based on Destination Type -->
    @if($destination_type == 'Country')
      <thead>
        <tr>
          <th>S.no.</th>
          <th>Country</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <!-- Display Country Data -->
        @foreach($customer_array as $row => $col)
          <tr>
            <td>{{ $col['S.no.'] }}</td>
            <td>{{ $col['country'] }}</td>
            <td>{{ $col['Link'] }}</td>
          </tr>
        @endforeach
      </tbody>

    @elseif($destination_type == 'State')
      <thead>
        <tr>
          <th>S.no.</th>
          <th>Country</th>
          <th>State</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <!-- Display State Data -->
        @foreach($customer_array as $row => $col)
          <tr>
            <td>{{ $col['S.no.'] }}</td>
            <td>{{ $col['Country'] }}</td>
            <td>{{ $col['State'] }}</td>
            <td>{{ $col['Link'] }}</td>
          </tr>
        @endforeach
      </tbody>

    @elseif($destination_type == 'City')
      <thead>
        <tr>
          <th>S.no.</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <!-- Display City Data -->
        @foreach($customer_array as $row => $col)
          <tr>
            <td>{{ $col['S.no.'] }}</td>
            <td>{{ $col['Country'] }}</td>
            <td>{{ $col['State'] }}</td>
            <td>{{ $col['City'] }}</td>
            <td>{{ $col['Link'] }}</td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

</body>
</html>