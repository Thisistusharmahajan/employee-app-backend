<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form {
            margin-bottom: 30px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 15px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add an Employee</h2>

    <form id="registerForm">
        <input type="text" id="name" placeholder="Full Name" required>
        <input type="email" id="email" placeholder="Email Address" required>
        <input type="text" id="phone" placeholder="Phone Number" required>
        <input type="text" id="role" placeholder="Role" required>
        <input type="text" id="stack" placeholder="Current Tech Stack" required>
        <input type='password' id='password' placeholder="user@somepass" required>
        <input type='password' id='confirm_password' placeholder="user@somepass" required>
        <button type="submit" id="submitBtn">Sign Up</button>
    </form>

    <h3>Employee List</h3>
<table id="employeeTable">
    <thead>
        <tr>
            <th>Name</th><th>Email</th><th>Mobile</th><th>Role</th><th>Tech Stack</th><th>Actions</th>
        </tr>
    </thead>
    <tbody id="employeeTableBody"></tbody>
</table>

</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = this;
    const id = form.dataset.editId; // If exists, update

    const data = {
        name: document.getElementById('name').value,
        email_id: document.getElementById('email').value,
        mobile_number: document.getElementById('phone').value,
        role: document.getElementById('role').value,
        current_tech_stack: document.getElementById('stack').value
    };

    const url = id
        ? `https://employee-app-backend-production.up.railway.app/employees/update/${id}`
        : 'https://employee-app-backend-production.up.railway.app/employees';

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        alert(id ? 'Employee updated!' : 'Employee added!');
        form.reset();
        delete form.dataset.editId;
        document.getElementById('submitBtn').innerText = 'Add';
        fetchEmployees();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to submit employee');
    });
});


function fetchEmployees() {
    fetch('https://employee-app-backend-production.up.railway.app/employees/getAll')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#employeeTable tbody');
            tbody.innerHTML = '';
            data.forEach(emp => {
                tbody.innerHTML += `
                    <tr>
                        <td>${emp.name}</td>
                        <td>${emp.email_id}</td>
                        <td>${emp.mobile_number}</td>
                        <td>${emp.role}</td>
                        <td>${emp.current_tech_stack}</td>
                        <td>
                            <button onclick="editEmployee(${emp.id})">Edit</button>
                            <button onclick="deleteEmployee(${emp.id})">Delete</button>
                        </td>
                    </tr>`;
            });
        });
}

function editEmployee(id) {
    fetch(`https://employee-app-backend-production.up.railway.app/employees/getById/${id}`)
        .then(response => response.json())
        .then(emp => {
            document.getElementById('name').value = emp.name;
            document.getElementById('email').value = emp.email_id;
            document.getElementById('phone').value = emp.mobile_number;
            document.getElementById('role').value = emp.role;
            document.getElementById('stack').value = emp.current_tech_stack;
            document.getElementById('registerForm').dataset.editId = id;

            // Change button text to Update
            document.getElementById('submitBtn').innerText = 'Update';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
}


function deleteEmployee(id) {
    if (!confirm('Are you sure you want to delete this employee?')) return;

    fetch(`https://employee-app-backend-production.up.railway.app/employees/delete/${id}`, {
        method: 'DELETE'
    })
    .then(res => res.json())
    .then(res => {
        alert('Employee deleted');
        fetchEmployees();
    });
}

// Call this once page loads
document.addEventListener('DOMContentLoaded', fetchEmployees);
</script>
</body>
</html>