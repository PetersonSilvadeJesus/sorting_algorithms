<div class="container">
    <center>
        <h1>Comparation</h1>
    </center>
    <div class="jumbotron">
        <?= Vector::choose_vector(); ?>
        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br>
        <?= Vector::buttons() ?>

    </div>
</div>


<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-3">
            <h2>Merge Sort</h2>
            <p id="analiseMerge"></p>
            <b>Complexidade: </b>
            <p>Melhor Caso: O(n log(n)) típico,
                O(n) variante natural</p>
            <p>Médio Caso: O(n log(n))</p>
            <p>Pior Caso: O(n log(n))</p>
        </div>
        <div class="col-md-3">
            <h2>Shell Sort</h2>
            <p id="analiseShell"></p>
            <b>Complexidade: </b>
            <p>Melhor Caso: O(n log(n))</p>
            <p>Médio Caso: Depende da sequência do gap, O(n log(n))</p>
            <p>Pior Caso: Depende da sequência do gap, O(n log(n))</p>
        </div>
        <div class="col-md-3">
            <h2>Quick Sort</h2>
            <p id="analiseQuick"></p>
            <b>Complexidade: </b>
            <p>Melhor Caso: O(n log(n))</p>
            <p>Médio Caso: O(n log(n))</p>
            <p>Pior Caso: O(n²)</p>
        </div>
        <div class="col-md-3">
            <h2>Heap Sort</h2>
            <p id="analiseHeap"></p>
            <b>Complexidade: </b>
            <p>Melhor Caso: O(n log(n))</p>
            <p>Médio Caso: O(n log(n))</p>
            <p>Pior Caso: O(n log(n))</p>
        </div>
    </div>

</div>

<script>
    var countMerge = 0, countShell = 0, countQuick = 0, countHeap = 0;

    $(document).on('click', '#start', function () {
        printVetor();
        var arrMerge = [], arrShell = [], arrQuick = [], arrHeap = [];
        for (var i = 0; i < arr.length; i++) {
            arrMerge.push(arr[i][0]);
            arrShell.push(arr[i][0]);
            arrQuick.push(arr[i][0]);
            arrHeap.push(arr[i][0]);
        }

        $('#all').attr('style', 'display: none');
        arrMerge = allMerge(arrMerge);
        allShell(arrShell);
        allQuick(arrQuick, 0, arrQuick.length - 1);
        allHeap(arrHeap);

        $('#analiseMerge').html("Quantidade de comparações: " + countMerge + "<br>");

        $('#analiseShell').html("Quantidade de comparações: " + countShell + "<br>");

        $('#analiseQuick').html("Quantidade de comparações: " + countQuick + "<br>");

        $('#analiseHeap').html("Quantidade de comparações: " + countHeap + "<br>");
    });

    function printVetor() {
        var box = $('#array').html('');
        for (var k = 0; k < arr.length; k++) {
            box.append('<li class="page-item link-' + arr[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
    }

    /**
     * ############################ MERGE SORT ############################
     */

    function allMerge(a) {
        countMerge++;
        if (a.length == 1)
            return a;

        var l1 = dividir_vector_l1(a);
        var l2 = dividir_vector_l2(a);

        l1 = allMerge(l1);
        l2 = allMerge(l2);

        return merge(l1, l2);
    }

    function dividir_vector_l1(base) {
        aux = [];
        for (i = 0; i < Math.floor(base.length / 2); i++) {
            countMerge++;
            aux.push(base[i]);
        }
        return aux;
    }

    function dividir_vector_l2(base) {
        aux = [];
        for (i = Math.floor(base.length / 2); i < base.length; i++) {
            countMerge++;
            aux.push(base[i]);
        }
        return aux;
    }

    function merge(a, b) {
        var c = [];
        while (a.length > 0 && b.length > 0) {
            countMerge++;
            if (a[0] > b[0]) {
                countMerge++;
                c.push(b[0]);
                b.shift(); // tira a primeira posição do vetor
            } else {
                countMerge++;
                c.push(a[0]);
                a.shift(); // tira a primeira posição do vetor
            }
        }

        while (a.length > 0) {
            countMerge++;
            c.push(a[0]);
            a.shift(); // tira a primeira posição do vetor
        }

        while (b.length > 0) {
            countMerge++;
            c.push(b[0]);
            b.shift(); // tira a primeira posição do vetor
        }

        return c;
    }


    /**
     * ############################ SHELL SORT ############################
     */

    function allShell(a) {
        var gaps = createGaps(a), temp;

        for (var i = 0, j = gaps.length, gap; i < j; i += 1) {
            gap = gaps[i];

            for (var x = gap, y = a.length; x < y; x += 1) {
                temp = a[x];

                // this performs insertion sort on subarrays
                countShell++;
                for (var z = x; z >= gap && a[z - gap] > temp; z -= gap) {
                    a[z] = a[z - gap];
                }

                a[z] = temp;
            }
        }
    }

    function createGaps(a) {
        // if a is an array of 100, gaps would be [50, 25, 12, 6, 3, 1]
        var gaps = [];

        for (var i = 0, j = a.length, t; 1 <= (t = Math.floor(j / Math.pow(2, i + 1))); i += 1) {
            gaps[i] = t;

            if (t === 1) {
                break;
            }
        }

        if (gaps[i] !== 1) {
            gaps.push(1);
        }

        return gaps;
    }


    /**
     * ############################ QUICK SORT ############################
     */

    function allQuick(vetor, start, end) {

        var pivot, pIndex, pivot_index;

        var stack = [];//Initializing stack size
        var varTop = -1; //To keep track of varTop element in the stack
        //pushing varial start and end
        stack[++varTop] = start;
        stack[++varTop] = end;

        //pop till the stack is empty
        while (varTop >= 0) {
            countQuick++;
            //poping the varTop two elements
            //ie,poping parent subarray indexes to replace child subbary indexes
            end = stack[varTop--];
            start = stack[varTop--];

            pivot = arr[end]; //rightmost element is the pivot
            pIndex = start;  //Is to push elements less than pivot to left and greater than to right of pivot

            for (var i = start; i < end; ++i) {
                countQuick++;
                if (arr[i][0] < pivot[0]) {
                    swap(arr, i, pIndex);
                    pIndex++;
                }
            }
            swap(arr, pIndex, end);
            pivot_index = pIndex;

            countQuick++;
            //Pushing the left subarray indexes that are less than pivot
            if (pivot_index - 1 > start) {
                stack[++varTop] = start;
                stack[++varTop] = pivot_index - 1;
            }
            countQuick++;
            //pushing the right subarray indexes that are greater than pivot
            if (pivot_index + 1 < end) {
                stack[++varTop] = pivot_index + 1;
                stack[++varTop] = end;
            }
        }
    }

    /**
     * ############################ HEAP SORT ############################
     */
    function heapify(arrAux, n, i) {
        var largest = i;  // Initialize largest as root
        var l = 2 * i + 1;  // left = 2*i + 1
        var r = 2 * i + 2;  // right = 2*i + 2

        // If left child is larger than root
        countHeap++;
        if (l < n && arrAux[l] > arrAux[largest])
            largest = l;

        // If right child is larger than largest so far
        countHeap++;
        if (r < n && arrAux[r] > arrAux[largest])
            largest = r;

        // If largest is not root
        countHeap++;
        if (largest != i) {
            swap(arrAux, i, largest);

            // Recursively heapify the affected sub-tree
            heapify(arrAux, n, largest);
        }
    }

    function allHeap(arrAux) {
        // Build heap (rearrange array)
        for (i = Math.floor(arrAux.length / 2 - 1); i >= 0; i--)
            heapify(arrAux, arrAux.length, i);

        // One by one extract an element from heap
        for (i = arrAux.length - 1; i >= 0; i--) {
            // Move current root to end
            swap(arrAux, 0, i);

            // call max heapify on the reduced heap
            heapify(arrAux, i, 0);
        }
    }

    function swap(array, i, j) {
        let tmp = array[i];
        array[i] = array[j];
        array[j] = tmp;
    }

</script>