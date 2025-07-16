<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
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
    <h2>Employee Registration</h2>
    <form  id="" action="https://employee-app-backend-production.up.railway.app/employees/auth/register" method="post">
        <input type="text" id="name" placeholder="Full Name" required>
        <input type="email" id="email" placeholder="Email Address" required>
        <input type="text" id="phone" placeholder="Phone Number" required>
        <input type="text" id="role" placeholder="Role" required>
        <input type="text" id="stack" placeholder="Current Tech Stack" required>
        <input type='password' id='password' placeholder="user@somepass" required>
        <input type='password' id='confirm_password' placeholder="user@somepass" required>
        <button type="submit" id="submitBtn">Sign Up</button>
    </form>
</div>
<script>
    
// document.getElementById('registerForm').addEventListener('submit', function (e) {
//     e.preventDefault();

//     const form = this;
//     const id = form.dataset.editId; // If exists, update

//     const data = {
//         name: document.getElementById('name').value,
//         email_id: document.getElementById('email').value,
//         mobile_number: document.getElementById('phone').value,
//         role: document.getElementById('role').value,
//         current_tech_stack: document.getElementById('stack').value,
//         password: document.getElementById('password').value
//     };

//     const url = 'https://employee-app-backend-production.up.railway.app/employees/Signup';

//     fetch(url, {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify(data)
//     })
//     .then(res => res.json())
//     .then(response => {
//         alert('Employee Added!');
//         form.reset();
//     })
//     .catch(err => {
//         console.error('Error:', err);
//         alert('Failed to submit employee');
//     });
// });

</script>
</body>