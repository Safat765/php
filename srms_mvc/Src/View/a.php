<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Toggle Button</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-check:checked + .btn {
            background-color: #28a745;  /* Green color when checked */
            border-color: #28a745;
        }
        .btn-check:checked + .btn::after {
            content: 'Active';  /* Text when checked */
        }
        .btn-check:not(:checked) + .btn {
            background-color: #007bff;  /* Blue color when unchecked */
            border-color: #007bff;
        }
        .btn-check:not(:checked) + .btn::after {
            content: 'Inactive';  /* Text when unchecked */
        }
        .btn {
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" checked>
        <label class="btn btn-primary" for="btn-check"></label>
        <div class="mt-3">
            <p id="status">The toggle button is: Active</p>
        </div>
    </div>

    
    <p id="status-<?php echo $user['user_id']; ?>"> The toggle button is: <?php echo ($user['status'] == 1) ? 'Active' : 'Inactive'; ?></p>

    <script>
        // Get the checkbox element
        const checkbox = document.getElementById("btn-check");

        // Get the status paragraph element
        const statusText = document.getElementById("status");

        // Add event listener to the checkbox
        checkbox.addEventListener("change", function() {
            // Update the status text instantly when checkbox is toggled
            if (checkbox.checked) {
                statusText.textContent = "The toggle button is: Active";
            } else {
                statusText.textContent = "The toggle button is: Inactive";
            }
        });

        // Set the initial status text based on the default checked state
        if (checkbox.checked) {
            statusText.textContent = "The toggle button is: Active";
        } else {
            statusText.textContent = "The toggle button is: Inactive";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
