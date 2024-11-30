<?php
if (isset($_POST['City'])) {
    $selectedLocation = $_POST['City'];

    // Function to retrieve the address based on the selected location
    function getAddress($location) {
        // Replace this with your actual logic to fetch the address
        // You can store the addresses in a database or any other data source
        $addresses = [
            'Bharuch' => '123 Main St, City 1',
            'address2' => '456 Oak St, City 2',
            'address3' => '789 Elm St, City 3',
        ];

        return isset($addresses[$location]) ? $addresses[$location] : 'Address not found';
    }

    // Get the address based on the selected location
    $address = getAddress($selectedLocation);

    // Return the address as JSON response
    $response = [
        'status' => 'success',
        'address' => $address,
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
