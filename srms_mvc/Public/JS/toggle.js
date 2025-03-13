// Toggle status when button is clicked
function toggleStatus(userId) {
    var statusButton = document.querySelector('.toggle-btn[data-id="' + userId + '"]');
    var statusInput = document.getElementById("status-" + userId);
    
    // Toggle the value of the status (1 for Active, 0 for Inactive)
    var newStatus = statusInput.value == '1' ? '0' : '1';
    statusInput.value = newStatus;
    
    // Change the button color and text
    if (newStatus == '1') {
        statusButton.classList.remove('inactive-btn');
        statusButton.classList.add('active-btn');
        statusButton.innerHTML = 'Active';
    } else {
        statusButton.classList.remove('active-btn');
        statusButton.classList.add('inactive-btn');
        statusButton.innerHTML = 'Inactive';
    }

    // Submit the form to update the status
    statusButton.form.submit();
}
