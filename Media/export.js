document.getElementById('exportButton').addEventListener('click', function() {
    // Fetch JSON data from your PHP script (assuming it's accessible at 'your-script-url.php')
    fetch('read_media.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Convert JSON data to CSV format
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += Object.keys(data.data[0]).join(',') + '\n'; // Header row
            data.data.forEach(function(row) {
                var values = Object.values(row);
                var csvRow = values.map(value => '"' + value + '"').join(',');
                csvContent += csvRow + '\n';
            });

            // Create a hidden anchor element to trigger the download
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "media_listing.csv");
            document.body.appendChild(link);

            // Trigger the download
            link.click();

            // Cleanup
            document.body.removeChild(link);
        } else {
            // Handle error if JSON response status is not 'success'
            console.error('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
});
