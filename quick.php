<div class="container">
    <center>
        <h1>Quick Sort</h1>
    </center>
    <div class="jumbotron">

        <?= Vector::message(
                ['Green'=>'The fixed  pivot',
                    'Red'=>'Number to increase',
                    'Blue'=>'pIndex'
                ]);
        ?>

        <?= Vector::choose_vector(); ?>

        <div class="alert alert-success" id="message">
            <b>[STEP BY STEP]</b><br>
            Pivot is choose. <br>
            Position pIndex. <br>
            Check if increment number is larger that pivot <br>
            If it's, So swap increment number with pivot. Increase pIndex. <br>
            Vector is over, pIndex is the first largest <br>
            Swap it with the pivot <br>
            ...... until the end.
        </div>

        <nav aria-label="Page navigation example" id="array">

        </nav>
        <br><br>
        <?= Vector::buttons() ?>
    </div>
</div>
<div class="container">

    <h3>How Quick Sort Works?</h3>
    <p>
        Like Merge Sort, QuickSort is a Divide and Conquer algorithm. It picks an element as pivot and partitions the given array around the picked pivot. There are many different versions of quickSort that pick pivot in different ways. <br>

        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. Always pick first element as pivot.<br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. Always pick last element as pivot (implemented below)<br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. Pick a random element as pivot.<br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. Pick median as pivot.<br>
        The key process in quickSort is partition(). Target of partitions is, given an array and an element x of array as pivot, put x at its correct position in sorted array and put all smaller elements (smaller than x) before x, and put all greater elements (greater than x) after x. All this should be done in linear time.<br>
    </p>
</div>
<script>
    var auxVector = [], auxIndice = [];
    var flag = 1;
    var pivo, aux, j, meio, inicio, fim;


    var pivot, pIndex, i, pivot_index;

    var start = 0, end;
    var stack = [];//[end - start + 1];//Initializing stack size
    var varTop = -1; //To keep track of varTop element in the stack

    // Função iniciar Vetor
    function printVetor(array, l, m) {
        // var box = $('#array').html('');
        var box = "<ul id=\"ul_array\" class=\"pagination\">";
        for (var k = 0; k < array.length; k++) {
            box += ('<li class="page-item link-' + array[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + array[k][0] + '</a></li>');
        }
        box += "</ul>";
        $('#array').html(box);

        if(l != null && m != null){
            $("li.page-item.link-" + pivot[0] + "-" + pivot[1] + " a").attr('style', 'background: green; font-weight: bold');
        }

        if(l != null){
            $("li.page-item.link-" + arr[l][0] + "-" + arr[l][1] + " a").attr('style', 'background: red');
        }
        if(m != null){
            $("li.page-item.link-" + arr[m][0] + "-" + arr[m][1] + " a").attr('style', 'background: blue');
        }
    }

    $(document).on('click', '#start', function () {
        init();

        $('#next').attr('style', 'display: inline');
        $('#next').click();
    });

    $(document).on('click', '#swap', function () {
        $("#next").attr('style', 'display: inline');
        $("#swap").attr('style', 'display: none');
        $('#next').click();
    });

    $(document).on('click', '#next', function () {
        iterativeQuicksort();
    });

    $(document).on('click', '#all', function () {
        allQuicksort(arr, 0,arr.length-1);
        printVetor(arr);
        alert("Finalizado!");
        $('#next').attr('style', 'display: none');
        $('#all').attr('style', 'display: none');
    });

    function init() {
        end = arr.length - 1;

        stack[++varTop] = start;
        stack[++varTop] = end;

        //poping the varTop two elements
        //ie,poping parent subarray indexes to replace child subbary indexes
        end = stack[varTop--];
        start = stack[varTop--];

        pivot = arr[end]; //rightmost element is the pivot
        pIndex = start;  //Is to push elements less than pivot to left and greater than to right of pivot


        i = start;
        printVetor(arr, i, end)
    }

    function swap(array, i, j) {
        var aux = array[i];
        array[i] = array[j];
        array[j] = aux;
    }

    function iterativeQuicksort() {
        printVetor(arr, i, pIndex);

        if (i < end) {
            // $('#message').html("Check if increment number is larger that pivot <br>" +
            //     "If it's, So swap increment number with pivot. Increase pIndex.");

            if (arr[i][0] < pivot[0]) {
                if(i != pIndex) {
                    $('#swap').attr('style', 'display: inline');
                    $('#next').attr('style', 'display: none');
                }
                swap(arr, i, pIndex);
                pIndex++;
            }

            i++;
        } else {
            // ## Depois do for
            console.log("Troca")
            printVetor(arr, pIndex, end)
            swap(arr, pIndex, end);
            pivot_index = pIndex;

            //Pushing the left subarray indexes that are less than pivot
            if (pivot_index - 1 > start) {
                stack[++varTop] = start;
                stack[++varTop] = pivot_index - 1;
            }
            //pushing the right subarray indexes that are greater than pivot
            if (pivot_index + 1 < end) {
                stack[++varTop] = pivot_index + 1;
                stack[++varTop] = end;
            }

            if (varTop < 0) {
                printVetor(arr);
                alert("Finalizado!");
                return;
            }

            // ## Antes do For
            //poping the varTop two elements
            //ie,poping parent subarray indexes to replace child subbary indexes
            end = stack[varTop--];
            start = stack[varTop--];

            pivot = arr[end]; //rightmost element is the pivot
            pIndex = start;  //Is to push elements less than pivot to left and greater than to right of pivot

            i = start;
        }
    }

    function allQuicksort(arr, start, end) {

        var pivot, pIndex, pivot_index;

        var stack = [];//Initializing stack size
        var varTop = -1; //To keep track of varTop element in the stack
        //pushing varial start and end
        stack[++varTop] = start;
        stack[++varTop] = end;

        //pop till the stack is empty
        while (varTop >= 0) {
            //poping the varTop two elements
            //ie,poping parent subarray indexes to replace child subbary indexes
            end = stack[varTop--];
            start = stack[varTop--];

            pivot = arr[end]; //rightmost element is the pivot
            pIndex = start;  //Is to push elements less than pivot to left and greater than to right of pivot
            for (var i = start; i < end; ++i) {
                if (arr[i][0] < pivot[0]) {
                    swap(arr, i, pIndex);
                    pIndex++;
                }
            }
            swap(arr, pIndex, end);
            pivot_index = pIndex;

            //Pushing the left subarray indexes that are less than pivot
            if (pivot_index - 1 > start) {
                stack[++varTop] = start;
                stack[++varTop] = pivot_index - 1;
            }
            //pushing the right subarray indexes that are greater than pivot
            if (pivot_index + 1 < end) {
                stack[++varTop] = pivot_index + 1;
                stack[++varTop] = end;
            }
        }
    }
</script>