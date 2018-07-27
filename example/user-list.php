<?php
declare(strict_types = 1);

require('../json/Core/core.php');
?>
<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8" />
        <title>User List</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>User List</h1>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Lp</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Województwo</th>
                        <th>Miasto</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td colspan="6">Brak osób do wyświetlenia!</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function() {
                $.post('/json/lista,1', {"inData":null}, function(response) {
                    if (response.code == 100 && response.success) {
                        value = response.outData['userList'];

                        if (value) {
                            tbody = '';

                            for (i in value) {
                                tbody = tbody
                                    + '                    <tr>'
                                    + '                        <td>' + i + '</td>'
                                    + '                        <td>' + value[i]['user_name'] + '</td>'
                                    + '                        <td>' + value[i]['user_surname'] + '</td>'
                                    + '                        <td>' + ((value[i]['province_name']) ? value[i]['province_name'] : 'Brak') + '</td>'
                                    + '                        <td>' + ((value[i]['city_name']) ? value[i]['city_name'] : 'Brak') + '</td>'
                                    + '                        <td>' + value[i]['user_ranking'] + '</td>'
                                    + '                    </tr>';
                            }
                            $('#tbody').html(tbody);
                        }
                    }
                }, 'json');
            });
        </script>
    </body>
</html>
