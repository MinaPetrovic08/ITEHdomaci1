<?php

require "dbBroker.php";
require "models/evaluation.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$grades = Evaluation::getAll($conn);
if (!$grades) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($grades->num_rows == 0) {
    echo "Nema prijava na kolokvijume";
    die();
} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
          integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
          integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
          crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <title>eDnevnik</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">E-dnevnik</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    

    <span class="navbar-text"><i class="fas fa-user"></i>

    </span>
    <a style="margin-left: 20px" class="btn btn-info" href="/" role="button">Logout</a>
  </div>
</nav>

<div class="container">
     
    <div class="mt-3 bg-white">
      <div class="text-center h2 pt-4 pb-2 mb-4">
        Pregled ocena
      </div>
      <div class="mb-4 ml-5">
        <button id="open_modal" data-toggle="modal" data-target="#roles_add_edit_modal" data-grade-id="0"
                class="btn btn-primary"><i class="fas fa-plus mr-3"></i>Dodaj novu ocenu
        </button>
        <button id="btn-dodaj" type="button" data-toggle="modal" data-target="#myModal" data-grade-id="<?= $grade['id']; ?>"
                          type="button" class="btn btn-primary px-3 mr-3"><i class="fas fa-edit" aria-hidden="true"></i>
                  </button>
                  <button id="btn-obrisi" formmethod="post" class="btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i>
                  </button>
      </div>
        

      <div class="table-wrapper">
        <div style="width:90%">
          <table id="grades-table">
            <thead>
            <tr>
              <td>Ime ucenika</td>
              <td>Predmet</td>
              <td>Ocena</td>
              <td>Napomena</td>
            </tr>
            </thead>
              <?php foreach ($grades

              as $grade): ?>
            <tr>
              <td><?= $grade['student']; ?></td>
              <td><?= $grade['subject']; ?></td>
              <td><?= $grade['points']; ?> / <?= $grade['max_points']; ?> </td>
              <td><?= $grade['note']; ?></td>
              <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $grade["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>
            </tr>
              <?php
                    endforeach;
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal sadrzaj-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="izmeniForm">
                            <h3 style="color: black">Izmeni kolokvijum</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="id" type="text" name="id" class="form-control" placeholder="Id *" value="" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input id="student" type="text" name="student" class="form-control" placeholder="Student*" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="subject" type="text" name="subject" class="form-control" placeholder="Subject *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="points" type="text" name="points" class="form-control" placeholder="Points *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="notes" type="text" name="notes" class="form-control" placeholder="Notes *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; background-color: orange; border: 1px solid white"> Izmeni
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>



        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        

    
    </script>
</body>
</html>