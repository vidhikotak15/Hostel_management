document.addEventListener('DOMContentLoaded', function () {
    // Fetch and display registered complaints initially
    fetchAndDisplayComplaints();
    console.log('called')

    // Set interval to fetch and display complaints periodically
    setInterval(fetchAndDisplayComplaints, 10000); 
});
// Function to fetch and display complaints for all types
function fetchAndDisplayComplaints() {
    fetchComplaintsPlumber();
    fetchComplaintsCarpenter();
    fetchComplaintsElectrician();
}

function fetchComplaintsPlumber() {
    fetch('http://localhost:3000/get-complaints-plumber', {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            displayComplaints(data, 'plumber');
        })
        .catch(error => {
            console.log('Error:', error);
        });
}

function fetchComplaintsCarpenter() {
    fetch('http://localhost:3000/get-complaints-carpenter', {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            displayComplaints(data, 'carpenter');
        })
        .catch(error => {
            console.log('Error:', error);
        });
}

function fetchComplaintsElectrician() {
    fetch('http://localhost:3000/get-complaints-electrician', {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            displayComplaints(data, 'electrician');
        })
        .catch(error => {
            console.log('Error:', error);
        });
}

function displayComplaints(complaints, tableType) {
    const complaintsList = document.getElementById(`${tableType}-complaints-list`);
    // Clear existing complaints before appending new ones
    complaintsList.innerHTML = '';
    complaints.forEach(complaint => {
        const row = document.createElement('tr');

        const dateCell = document.createElement('td');
        dateCell.textContent = complaint.Date;
        row.appendChild(dateCell);

        const hostelCell = document.createElement('td');
        hostelCell.textContent = complaint.Hostel_block;
        row.appendChild(hostelCell);

        const roomCell = document.createElement('td');
        roomCell.textContent = complaint.Room_number;
        row.appendChild(roomCell);

        const issueCell = document.createElement('td');
        issueCell.textContent = complaint.Issue;
        row.appendChild(issueCell);

        const contactCell = document.createElement('td');
        contactCell.textContent = complaint.Phone_number;
        row.appendChild(contactCell);

        const nameCell = document.createElement('td');
        nameCell.textContent = complaint.Name;
        row.appendChild(nameCell);

        const actionCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.classList.add('delete-btn');
        deleteButton.dataset.Phone_number = complaint.Phone_number;
        deleteButton.dataset.Issue = complaint.Issue;
        actionCell.appendChild(deleteButton);
        row.appendChild(actionCell);

        complaintsList.appendChild(row);
    });

    // Add event listeners to delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Get the phone number and issue from the complaint details
            const phoneNumber = this.dataset.Phone_number;
            const issue = this.dataset.Issue;

            // Call deleteComplaint with phone number and issue
            sendComplaint(phoneNumber, issue);
        });
    });
}
function sendComplaint(phone, issue) {
    // Make a GET request to send the email with the delete button
    fetch(`http://localhost:3000/send-complaint/?phone=${phone}&issue=${issue}`, {
        method: 'GET'
    })
        .then(response => {
            if (response.ok) {
                console.log('GET request successful');
                // No need to execute the DELETE request here
            } else {
                console.error('Error in GET request');
                throw new Error('Error in GET request');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}     

function signOut() {
    // Redirect to the login page
    window.location.href = 'DormCare_login.html';
}

// Dynamic footer year
document.getElementById('footer-year').textContent = new Date().getFullYear();

