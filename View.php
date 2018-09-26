<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            $("#id_table").load("Select.php?tabella="+'<?php echo $_GET['tabella']; ?>');
        });
    </script>
</head>
<body>
<nav class="navbar navbar-inverse" id="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Giacenze Milano</a>
            </div>
            <div class="container">
            <ul class="nav navbar-form navbar-right">
                <div class="form-group has-feedback">
                    <input type='text' id='research' class='form-control' onkeyup='Ricerca();' placeholder='Cerca...'>

                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
            </ul>
            </div>
        </div>
    </form>
</nav>
<table class="table table-hoover" id="id_table">
</table>
</body>
</html>