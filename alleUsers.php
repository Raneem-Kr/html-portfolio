<!DOCTYPE html>
<html>
<head>
    <title>Registrierte Nutzer</title>
    <link rel="stylesheet" type="text/css" href="../alleUsers.css">
</head>
<body>
    <h1> All Users </h1>
    <table class="user-table" id="user-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        
    </table>

    <script>
        
        function getUsers() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var users = JSON.parse(this.responseText);
                    var table = document.getElementById("user-table");
                    var tbody = table.getElementsByTagName("tbody")[0];

                    
                    while (tbody.firstChild) {
                        tbody.removeChild(tbody.firstChild);
                    }

                   
                    users.forEach(function(user) {
                        var row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${user.userid}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            };
            xhttp.open("GET", "get_user_data.php", true);
            xhttp.send();
        }

       
        getUsers();
    </script>
</body>
</html>
