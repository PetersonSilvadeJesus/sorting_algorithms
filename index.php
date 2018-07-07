<?php
define('BASE', "http://localhost/projects/sorting_algorithms");
//define('BASE', "http://petersonteste.esy.es/sorting_algorithms");

?>
<html>
<head>
    <title>TP Estrutura de Dados II</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--		<link rel="stylesheet" href="--><? //= BASE ?><!--/assets/bootstrap.min.css">-->
    <!-- ######################################################################################################### -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Sorting Algorithms</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= BASE ?>/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE ?>/index.php?exe=merge">Merge Sort</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE ?>/index.php?exe=shell">Shell Sort</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE ?>/index.php?exe=quick">Quick Sort</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE ?>/index.php?exe=heap">Heap Sort</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Others
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= BASE ?>/index.php?exe=comparation">Comparation</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= BASE ?>/index.php?exe=insertion">Insertion Sort</a>
                    <a class="dropdown-item" href="<?= BASE ?>/index.php?exe=selection">Selection Sort</a>
                    <a class="dropdown-item" href="<?= BASE ?>/index.php?exe=bubble">Bubble Sort</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
    <?php
    require_once "Vector.php";

    //QUERY STRING
    if (!empty($_GET['exe'])):
        $includepatch = strip_tags(trim($_GET['exe']) . '.php');
    else:
        $includepatch = 'home.php';
    endif;
    require_once($includepatch);
    ?>

    <hr>
    <footer>
        <p>&copy; Péterson Silva 2018</p>
    </footer>
</div>
<script>
    $("#file_click").click(function () {
        $("#file_input").click();
    });

    var arr = [];
    var openFile = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var text = reader.result;

            arr = reader.result.substring(0, 300).split(',');
            $('#start_application').click();
        };
        reader.readAsText(input.files[0]);
    };

    $('#choose_type').change(function () {
        if ($(this).val() == 'file') {
            $('#div_file').attr('style', 'display: block');
            $('#div_rand').attr('style', 'display: none');
            $('#div_enter').attr('style', 'display: none');
            $('#start_application').text("Choose File");
            $('#start_application').attr('style', 'display: none');
        } else if ($(this).val() == 'rand') {
            $('#div_file').attr('style', 'display: none');
            $('#div_rand').attr('style', 'display: block');
            $('#div_enter').attr('style', 'display: none');
            $('#start_application').text("Start Application");
            $('#start_application').attr('style', 'display: inline');
        } else if ($(this).val() == 'enter') {
            $('#div_file').attr('style', 'display: none');
            $('#div_rand').attr('style', 'display: none');
            $('#div_enter').attr('style', 'display: block');
            $('#start_application').text("Start Application");
            $('#start_application').attr('style', 'display: inline');
        }
    });

    $("#start_application").click(function () {
        var escolha = $('#choose_type').val();
        var message = "Quantidade máxima 20 números";
        if (escolha == 'file') {
            message = "Choose the file";

        } else if (escolha == 'rand') {
            message = "Enter the vector size";
            var n = parseInt($('#range_count').val());
            for (p = 0; p < n; p++) {
                arr.push(Math.floor(Math.random() * 500));
            }
        } else if (escolha == 'enter') {
            message = "Enter the vector numbers"
            arr = $('#input_enter').val().split(',');
            if(arr != ""){
                for (k = 0; k < arr.length; k++) {
                    arr[k] = parseInt(arr[k]);
                }
            }else{
                arr = [];
            }
        }

        if(arr.length > 0) {
            /*
            Fazer o tratamento para colocar o indice da repetição e ajudar nas cores
             */
            var teste = [];
            for (var a = 0; a < arr.length; a++) {
                var flag = null;
                for (var c = 0; c < teste.length; c++) {
                    if (teste[c][0] == arr[a])
                        flag = teste[c][1];       // pega quantos elementos do mesmo valor já possui no vetor
                }
                if (flag == null)
                    teste.push([arr[a], 0]);
                else
                    teste.push([arr[a], ++flag]);
            }
            arr = teste;

            $('#start_application').attr('style', 'display: none');
            $('#all').attr('style', 'display: inline');
            $('#start').click();
        }else {
            alert(message+'!!!');
        }
    });

    $('#reflash').click(function() {
        location.reload();
    });
</script>
</body>
</html>
