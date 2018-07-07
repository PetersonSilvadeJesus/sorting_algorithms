<div class="container">
    <center>
        <h1>Selection Sort</h1>
    </center>
    <div class="jumbotron">

       <?= Vector::message(
               ['Green'=>'Set the smallest element to change with red',
                   'Red'=>'Fix the pivot to change',
                   'Blue'=>'Variable to search for the lowest'
               ]);
       ?>
        <?= Vector::choose_vector(); ?>

        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br>
        <?= Vector::buttons() ?>
    </div>
</div>

<script>

    var i = 0, j = 1, min_idx;

    function printVetor(l, m) {
        var box = $('#array').html('');
        for (k = 0; k < arr.length; k++) {
            box.append('<li class="page-item link-' + arr[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
        if (!(l == null && m == null)) {
            $("li.page-item.link-" + arr[l][0] + "-" + arr[l][1] + " a").attr('style', 'background: red');
            $("li.page-item.link-" + arr[m][0] + "-" + arr[m][1] + " a").attr('style', 'background: blue');
            if(min_idx != l && min_idx != m){
                $("li.page-item.link-" + arr[min_idx][0] + "-" + arr[min_idx][1] + " a").attr('style', 'background: green');
            }
        }
    }


    $(document).on('click', '#start', function () {

        var box = $('#array').html('');
        for (k = 0; k < arr.length; k++) {
            box.append('<li class="page-item link-' + arr[k][0] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
        $("#next").attr('style', 'display: inline');

        i = 0, j = 1;
        min_idx = i;

        $('#next').click();
    });

    $(document).on('click', '#swap', function () {
        $("#next").attr('style', 'display: inline');
        $("#swap").attr('style', 'display: none');
        $('#next').click();
    });

    $(document).on('click', '#next', function () {
        flag = true;
        if (j >= arr.length) {

            if (min_idx != i) {
                $("#next").attr('style', 'display: none');
                $("#swap").attr('style', 'display: inline');
                printVetor(i, min_idx);
                flag = false;

                aux = arr[i];
                arr[i] = arr[min_idx];
                arr[min_idx] = aux;
            }

            i++;
            min_idx = i;
            j = i + 1;

            if (i >= arr.length) {
                $("#next").attr('style', 'display: none');
                printVetor()
                alert('Finalizado!');
                $("#all").attr('style', 'display: none');
                return;
                // $("li.page-item a").attr('style','background: #fff');
            }
            if (flag) {
                printVetor(i, j)
            } else {
                j--;
            }
        }
        if (flag) {
            printVetor(i, j)
        }
        if (arr[j][0] < arr[min_idx][0]) {
            min_idx = j;
        }

        j++;
    });

    $(document).on('click', '#all', function () {
        for (i = 0; i < arr.length - 1; i++) {
            min_idx = i;
            for (j = i + 1; j < arr.length; j++) {
                // verificar se os elementos estão na ordem certa
                if (arr[j][0] < arr[min_idx][0]) {
                    // trocar elementos de lugar
                    min_idx = j;
                }
            }

            if (min_idx != i) {
                aux = arr[i];
                arr[i] = arr[min_idx];
                arr[min_idx] = aux;
            }
        }
        printVetor();

    });

</script>

<div class="container">

    <h3>How Selection Sort Works?</h3>
    <p>The selection sort algorithm sorts an array by repeatedly finding the minimum element (considering ascending order) from unsorted part and putting it at the beginning. The algorithm maintains two subarrays in a given array.<br>
        1) The subarray which is already sorted.<br>
        2) Remaining subarray which is unsorted.<br>

        In every iteration of selection sort, the minimum element (considering ascending order) from the unsorted subarray is picked and moved to the sorted subarray.<br>
    </p>

<!--    <b>Time Complexity:</b> O(n²) as there are two nested loops. <br>-->

</div>