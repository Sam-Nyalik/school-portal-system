<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>School Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="lecturer-portal.css">
    <link rel="stylesheet" type="text/css" href="admin-portal.css">
  </head>
  <body>
    <header>
      <h1>School Admin Dashboard</h1>
    </header>
    <nav>
      <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Students</a></li>
        <li><a href="#">Lecturers</a></li>
        <li><a href="registration.html">Registration Form</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </nav>
    <main>
      <section>
        <h2>Students</h2>
        <table>
          <thead>
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Department</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Iterate over the students data from the database and populate the table rows -->
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button>Edit</button>
                <button>Delete</button>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button>Edit</button>
                <button>Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
      <section>
        <h2>Lecturers</h2>
        <table>
          <thead>
            <tr>
              <th>Lecturer ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Department</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Iterate over the lecturers data from the database and populate the table rows -->
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button>Edit</button>
                <button>Delete</button>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button>Edit</button>
                <button>Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </body>
</html>
