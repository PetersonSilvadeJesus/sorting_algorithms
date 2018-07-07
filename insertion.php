<div class="container">
    <center>
        <h1>Insertion Sort</h1>
    </center>
    <div class="jumbotron">

        <div class="alert alert-info container-fluid">
            [HELP] <br>
            <!--            <a style="color: red">Vermelha</a>: Fixo para trocar <br>-->
            <!--            <a style="color: blue">Azul</a>: Variavel para procurar o menor <br>-->
            <!--            <a style="color: green">Verde</a>: Fixo no Menor para trocar com o fixo Vermelho <br>-->

            <a style="color: red">Red</a>: Fix the pivot to change <br>
            <a style="color: blue">Blue</a>: Variable to search for the lowest <br>
        </div>

        <?= Vector::choose_vector(); ?>

        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br>
        <?= Vector::buttons() ?>
    </div>
</div>

<script>

    var i, j, key = [];

    function printVetor(l, m) {
        var box = ''; //$('#array').html('');
        for (var k = 0; k < arr.length; k++) {
            box += ('<li class="page-item link-' + arr[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
        $('#array').html(box);
        if (l != null || m != null) {
            // console.log(l, m)
            $("li.page-item.link-" + arr[l][0] + "-" + arr[l][1] + " a").attr('style', 'background: red');
            $("li.page-item.link-" + arr[m][0] + "-" + arr[m][1] + " a").attr('style', 'background: blue');
        }
    }

    $(document).on('click', '#start', function () {
        printVetor(null, null);
        $("#next").attr('style', 'display: inline');

        i = 1;
        key = arr[i];
        j = i - 1;

        $('#next').click();
    });

    $(document).on('click', '#swap', function () {
        $("#next").attr('style', 'display: inline');
        $("#swap").attr('style', 'display: none');
        $('#next').click();
    });

    // $(document).on('click', '#next', function () {
    //     printVetor();
    //     if (i > arr.length) {
    //         $("#next").attr('style', 'display: none');
    //         printVetor()
    //         alert('Finalizado!');
    //         $("#all").attr('style', 'display: none');
    //         return;
    //     }
    //
    //     if (j >= 0 && arr[j][0] > key[0]) {
    //         console.log(i, j);
    //         $("li.page-item.link-" + key[0] + "-" + key[1] + " a").attr('style', 'background: red');
    //         $("li.page-item.link-" + arr[j][0] + "-" + arr[j][1] + " a").attr('style', 'background: blue');
    //         arr[j + 1] = arr[j];
    //         j--;
    //     } else {
    //         arr[j + 1] = key;
    //         i++;
    //
    //         if (i > arr.length) {
    //             $("#next").attr('style', 'display: none');
    //             printVetor()
    //             alert('Finalizado!');
    //             $("#all").attr('style', 'display: none');
    //             return;
    //         }
    //
    //         key = arr[i];
    //         j = i - 1;
    //         $('#next').click();
    //     }
    // });


    $(document).on('click', '#next', function () {
        if (i >= arr.length) {
            $("#next").attr('style', 'display: none');
            printVetor(null, null);
            return;
        }
        if (j >= 0 && arr[j][0] > key[0]) {
            // printar [key, j]
            printVetor(i, j);
            arr[j + 1] = arr[j];
            j--;
        }else{
            arr[j + 1] = key;
            i++;

            if (i >= arr.length) {
                $("#next").attr('style', 'display: none');
                printVetor(null, null);
                return;
            }

            $('#swap').attr('style', 'display: inline');
            $('#next').attr('style', 'display: none');

            key = arr[i];
            j = i - 1;

            // $('#next').click();
        }
    });

    $(document).on('click', '#all', function () {
        for (i = 1; i < arr.length; i++) {
            key = arr[i];
            j = i - 1;
            while (j >= 0 && arr[j][0] > key[0]) {
                arr[j + 1] = arr[j];
                j--;
            }
            arr[j + 1] = key;
        }
        printVetor();
        alert("Finalizado!");
        $("#next").attr('style', 'display: none');
        $("#all").attr('style', 'display: none');
    });

</script>

<div class="container">

    <h3>How Insertion Sort Works?</h3>
    <p>
        Insertion sort is a simple sorting algorithm that works the way we sort playing cards in our hands.<br>

        <b>Algorithm</b><br>
        // Sort an arr[] of size n<br>
        insertionSort(arr, n)<br>
        Loop from i = 1 to n-1.<br>
        &nbsp&nbsp&nbsp&nbsp a) Pick element arr[i] and insert it into sorted sequence arr[0…i-1]
    </p>
    <br>
<!--    <b>Time Complexity:</b> O(n²) as there are two nested loops. <br>-->

</div>