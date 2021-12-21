<?php

require "dbBroker.php";
require "models/subject.php";

$subjects = Subject::getAll($conn);
if (!$subjects) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($subjects->num_rows == 0) {
    echo "Nema podataka";
    die();
} else {

?>
     <!DOCTYPE html>
  <html lang="en">

  <head>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <title>eDnevnik</title>
    </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="evaluation.php">E-dnevnik</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col-md-4">
            <a href="evaluation.php" class="btn btn-primary px-3 mr-3">Pregled dnevnika</a>
        </div>
        <div class="col-md-4">
            <a href="pocetna.php" class="btn btn-primary px-3 mr-3">Pregled studenata</a>
        </div>
        <span class="navbar-text"><i class="fas fa-user"></i>

        </span>
        <div class="col-md-4">
        <a href="index.php" class="btn btn-primary px-3 mr-3">Logout</a>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="mt-3 bg-white">
        <div class="text-center h2 pt-4 pb-2 mb-4">
          Pregled predmeta
        </div>
        <div class="mb-4 ml-5">
        <div class="col-md-4" style="text-align: center;">
        <button id="btn-sortiraj" class="btn btn-primary px-3 mr-3" onclick="sortTable()">Sortiraj</button>
        <button id="btn-pretraga" class="btn btn-primary"> Pretrazi predmete</button>
                <input class="" type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazite po id-u" hidden>
        </div>
        </div>

        <div class="table">
          <div style="width:90%">
            <table id="myTable">
              <thead>
                <tr>
                <th scope="col">ID</th>
                  <th scope="col">Naziv predmeta</th>
                  <th scope="col">Profesor</th>
                  <th scope="col">Odsek</th>
                  <th scope="col">ESPB</th>
                </tr>
              </thead>
              <?php while ($subject = $subjects->fetch_array()) :
              ?>
                <tr>
                  <td><?= $subject['id']; ?></td>
                  <td><?= $subject['name']; ?></td>
                  <td><?= $subject['teacher']; ?></td>
                  <td><?= $subject['department']; ?></td>
                  <td><?= $subject['points']; ?></td>
                </tr>
            <?php
              endwhile;
            }
            ?>
            </table>

          </div>
        </div>
      </div>
    </div>



    <style>
      .table-wrapper {
        display: flex;
        justify-content: center;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
            function sortTable() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("myTable");
                switching = true;

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[1];
                        y = rows[i + 1].getElementsByTagName("TD")[1];
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
            function funkcijaZaPretragu() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
  </body>
  </html>