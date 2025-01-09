<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static Footer with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure the wrapper takes the full height of the page */
        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Footer styling */
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
            <h1>Page Content</h1>
            <p>
                This is where your main content goes. The footer will stay at the bottom of the page
                regardless of the amount of content.
            </p>
        </div>

        <!-- Footer -->
        <footer class="footer">
            &copy; 2025 Your Website | All Rights Reserved
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
