<!DOCTYPE html>
<html>

<head>
    <title>User's Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1><u>User's registration</u></h1>
        <form>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required><br><br>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">--Select--</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br><br>

            <label for="isAdmin">Is Admin:</label>
            <input type="checkbox" id="isAdmin" name="isAdmin"><br><br>

            <button type="submit">Submit</button>
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Is Admin</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </div>
    <script src="script.js"></script>
</body>

</html>