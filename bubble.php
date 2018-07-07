<div class="container">
    <center>
        <h1>Bubble Sort</h1>
    </center>
    <div class="jumbotron">

        <?= Vector::message(
            ['Red'=>'Fix the pivot to change',
                'Blue'=>'Variable to search for the lowest'
            ]);
        ?>

        <?= Vector::choose_vector(); ?>

        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br><br>
        <?= Vector::buttons() ?>
    </div>
</div>
<div class="container">

    <h3>How Bubble Sort Works?</h3>
    <p>
        Bubble Sort is the simplest sorting algorithm that works by repeatedly swapping the adjacent elements if they are in wrong order.<br>

        <b>Example:</b><br>
        1. First Pass:<br>
        ( <b>5 1</b> 4 2 8 ) –> ( <b>1 5</b> 4 2 8 ), Here, algorithm compares the first two elements, and swaps since 5 > 1.<br>
        ( 1 <b>5 4</b> 2 8 ) –>  ( 1 <b>4 5</b> 2 8 ), Swap since 5 > 4<br>
        ( 1 4 <b>5 2</b> 8 ) –>  ( 1 4 <b>2 5</b> 8 ), Swap since 5 > 2<br>
        ( 1 4 2 <b>5 8 </b>) –> ( 1 4 2 <b>5 8</b> ), Now, since these elements are already in order (8 > 5), algorithm does not swap them.<br>

        2. Second Pass:<br>
        ( <b>1 4</b> 2 5 8 ) –> ( <b>1 4</b> 2 5 8 )<br>
        ( 1 <b>4 2</b> 5 8 ) –> ( 1 <b>2 4</b> 5 8 ), Swap since 4 > 2<br>
        ( 1 2 <b>4 5</b> 8 ) –> ( 1 2 <b>4 5</b> 8 )<br>
        ( 1 2 4 <b>5 8</b> ) –>  ( 1 2 4 <b>5 8</b> )<br>
        Now, the array is already sorted, but our algorithm does not know if it is completed. The algorithm needs one whole pass without any swap to know it is sorted.
    </p><br>
</div>
<script>
    // Função iniciar Vetor
    var arr;
    var count = 0, loop = 0;
    var trocado = false;

    function printVetor() {
        var box = $('#array').html('');
        for (i = 0; i < arr.length; i++) {
            box.append('<li class="page-item link-' + arr[i][0] + '-' + arr[i][1] + '"><a class="page-link">' + arr[i][0] + '</a></li>');
        }
        if (count < arr.length - 1) {
            $("li.page-item.link-" + arr[count][0] + "-" + arr[count][1] + " a").attr('style', 'background: red');
            $("li.page-item.link-" + arr[count + 1][0] + "-" + arr[count + 1][1] + " a").attr('style', 'background: #00FFFF');
        }
    }

    $(document).on('click', '#start', function () {

        var box = $('#array').html('');
        for (i = 0; i < arr.length; i++) {
            box.append('<li class="page-item link-' + arr[i][0] + '-' + arr[i][1] + '"><a class="page-link">' + arr[i][0] + '</a></li>');
        }
        $("#next").attr('style', 'display: inline');
    });

    /**
     Bubble Sort
     */
    $(document).on('click', '#sort', function () {
        trocado = false;

        $('#next').click();

        $("#sort").attr('style', 'display: none');
        $("#next").attr('style', 'display: inline');
    });

    $(document).on('click', '#swap', function () {
        $("#next").attr('style', 'display: inline');
        $("#swap").attr('style', 'display: none');
        $('#next').click();
    });

    $(document).on('click', '#next', function () {
        printVetor();

        // if(arr[count][0] > arr[count+1][0]){
        //     $("#swap").attr('style', 'display: inline');
        //     $("#next").attr('style', 'display: none');
        //     return;
        // }

        if (count >= arr.length - 1) {
            count = 0;
            loop++;
            if (!trocado) {
                $("#next").attr('style', 'display: none');
                $("#all").attr('style', 'display: none');
                alert('Finalizado!');
                return;
            }
            trocado = false;
            printVetor();
            // botão 'next' some
        }

        if (arr[count][0] > arr[count + 1][0]) {
            // trocar elementos de lugar
            aux = arr[count];
            arr[count] = arr[count + 1];
            arr[count + 1] = aux;

            trocado = true;
            $("#swap").attr('style', 'display: inline');
            $("#next").attr('style', 'display: none');
        }

        count++;
    });

    $(document).on('click', '#all', function () {
        var i, j;
        for (i = 0; i < arr.length - 1; i++) {
            for (j = 0; j < arr.length - i - 1; j++) {
                // verificar se os elementos estão na ordem certa
                if (arr[j][0] > arr[j + 1][0]) {
                    // trocar elementos de lugar
                    aux = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = aux;
                    printVetor();
                }
            }
        }
        $('#all').attr('style', 'display: none');
        alert("Finalizado!");
    });

</script>