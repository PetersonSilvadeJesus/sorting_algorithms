<div class="container">
    <center>
        <h1>Heap Sort</h1>
    </center>
    <div class="jumbotron">

        <?= Vector::message(
            ['<b>Size</b>'=>'Maximum 15 numbers',
                'Red'=>'Fix the pivot to change of tree',
                'Blue'=>'Variable to search for the lowest of tree'
            ]);
        ?>

        <?= Vector::choose_vector(); ?>

        <div class="alert alert-warning">
            Heap sort is a comparison based sorting technique based on Binary Heap data structure. It is similar to selection sort where we first find the maximum element and place the maximum element at the end. We repeat the same process for remaining element.<br>

            Heap Sort Algorithm for sorting in increasing order:<br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. Build a max heap from the input data.<br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. At this point, the largest item is stored at the root of the heap. Replace it with the last item of the heap followed by reducing the size of heap by 1. Finally, heapify the root of tree.<br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. Repeat above steps while size of heap is greater than 1.<br>

            How to build the heap?<br>
            Heapify procedure can be applied to a node only if its children nodes are heapified. So the heapification must be performed in the bottom up order.
        </div>

        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br>
        <?= Vector::buttons() ?>
        <div class="container-fluid">
            <canvas id="canvas" width="1000" height="800">
                Your browser does not support HTML 5 Canvas
            </canvas>
        </div>
    </div>
</div>

<div id="controls" style="display: none;">
    <div id="change">
        <p>Chose the number of elements to sort, 8 by default</p>
        <form name="elements" id="numel">
            <input type="radio" name="number" value="8"> 8s
            <input type="submit" name="submit-btn" value="Change">
        </form>
    </div>
</div>
<script src="assets/canvas.js"></script>

<script>
    let length, i, z, flag = false, loop = 1, largest, arrMude = [], arrAux = [];

    function printVetor(l, m) {
        var box = $('#array').html('');
        for (k = 0; k < arr.length; k++) {
            box.append('<li class="page-item link-' + arr[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
        if (!(l == null && m == null)) {
            $("li.page-item.link-" + arr[l][0] + "-" + arr[l][1] + " a").attr('style', 'background: red');
            $("li.page-item.link-" + arr[m][0] + "-" + arr[m][1] + " a").attr('style', 'background: blue');
        }
    }

    $(document).on('click', '#start', function () {
        for (i = 0;i<arr.length;i++)
            arrAux.push(arr[i])

        printVetor();
        heapSort();
        // ArrMude pronto para uso

        canvasApp();

        $("#next").attr('style', 'display: inline');
    });

    $(document).on('click', '#swap', function () {
        $('#swap').attr('style','display: none');
        $('#next').attr('style','display: inline');
        $('#next').click();
    });

    $(document).on('click', '#next', function () {
        $('#canvas').html = "";
        canvasApp();

        if(arrMude.length-1 <= 0){
            printVetor();
            $('#next').attr('style','display: none');
            $('#all').attr('style','display: none');
            alert("Finalizado!");
            return;
        }
        var aux = arrMude.shift();
        printVetor(aux[0],aux[1]);

        let tmp = arr[aux[0]];
        arr[aux[0]] = arr[aux[1]];
        arr[aux[1]] = tmp;

        $('#swap').attr('style','display: inline');
        $('#next').attr('style','display: none');
    });


    function heapify(n, i) {
        var largest = i;  // Initialize largest as root
        var l = 2 * i + 1;  // left = 2*i + 1
        var r = 2 * i + 2;  // right = 2*i + 2

        // If left child is larger than root
        // console.log(arr[l], arr[largest])
        if (l < n && arrAux[l][0] > arrAux[largest][0])
            largest = l;

        // If right child is larger than largest so far
        if (r < n && arrAux[r][0] > arrAux[largest][0])
            largest = r;

        // If largest is not root
        if (largest != i) {
            swap(arrAux, i, largest);

            // Recursively heapify the affected sub-tree
            heapify(arrAux, n, largest);
        }
    }

    function heapSort() {
        // Build heap (rearrange array)
        for (i = Math.floor(arrAux.length / 2 - 1); i >= 0; i--)
            heapify(arrAux.length, i);

        // One by one extract an element from heap
        for (i = arrAux.length - 1; i >= 0; i--) {
            // Move current root to end
            swap(arrAux, 0, i);

            // call max heapify on the reduced heap
            heapify(i, 0);
        }
    }


    $(document).on('click', '#all', function () {
        heapSort();
        printVetor();
        alert("Finalizado!");
        $('#next').attr('style','display: none');
        $('#all').attr('style','display: none');
    });

    /**
     * Swaps the position of two objects in an array.
     * @param {[]} array - the aray containing the object to be swapped
     * @param {number} i - index of first object within array
     * @param {number} j - index of second object within array
     */
    function swap(array, i, j) {
        arrMude.push([i, j]);
        let tmp = array[i];
        array[i] = array[j];
        array[j] = tmp;
    }
</script>