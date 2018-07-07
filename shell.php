<div class="container">
    <center>
        <h1>Shell Sort</h1>
    </center>
    <div class="jumbotron">

        <?= Vector::message(
            ['Red'=>'Incremental pivot to the end of the vector',
                'Blue'=>'Next element added with h',
                'Green'=>'Repositioning the pivot'
            ]);
        ?>

        <?= Vector::choose_vector(); ?>

        <div class="row">
            <div class="col-md-3 alert alert-info" style="text-align: center">
                h = <a id="interval_h">0</a>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6 alert alert-warning" id="message-info" style="text-align: center">

            </div>
        </div>
        <br>
        <img src="assets/images/seta.png" id="seta" width="30" style="display: none;">

        <nav aria-label="Page navigation example">
            <ul id="array" class="pagination"></ul>
        </nav>
        <br>
        <?= Vector::buttons() ?>
    </div>
</div>
<div class="container">

    <h3>How Shell Sort Works?</h3>
    <p>
        ShellSort is mainly a variation of Insertion Sort. In insertion sort, we move elements only one position ahead. When an element has to be moved far ahead, many movements are involved. The idea of shellSort is to allow exchange of far items. In shellSort, we make the array h-sorted for a large value of h. We keep reducing the value of h until it becomes 1. An array is said to be h-sorted if all sublists of every h’th element is sorted.<br>
    </p>
</div>
<script>

    var arr, i;
    var gaps, temp, j, gap, x, y;

    function printVetor() {
        var box = $('#array').html('');
        for (var k = 0; k < arr.length; k++) {
            box.append('<li class="page-item link-' + arr[k][0] + '-' + arr[k][1] + '"><a class="page-link">' + arr[k][0] + '</a></li>');
        }
    }

    $(document).on('click', '#start', function () {
        printVetor();

        $("#start").attr('style', 'display: none');
        $("#next").attr('style', 'display: inline');

        gaps = createGaps(arr);

        i = 0;
        j = gaps.length;
        gap = gaps[i];

        x = gap;
        y = arr.length;

    });

    $(document).on('click', '#swap', function () {
        $("#swap").attr('style', 'display: none');
        $("#next").attr('style', 'display: inline');
        $("#next").click()
    });

    $(document).on('click', '#next', function () {
        $('#interval_h').text(gap);
        $("#message-info").text('');

        $("#seta").attr('style', 'display: none');
        $("#next").attr('style', 'display: inline');
        $("#swap").attr('style', 'display: none');
        printVetor();

        if (i >= j) {
            alert("Finalizado!");
            $("#next").attr('style', 'display: none');
            $("#all").attr('style', 'display: none');
            return;
        }
        // dentro do 1 for
        if (x >= y) {
            i++;
            gap = gaps[i];
            $('#interval_h').text(gap);

            x = gap;
            y = arr.length;
        }

        temp = arr[x];

        // correto é essas duas abaixo, porém não mostra o item certo que muda

        $("li.page-item.link-" + arr[x][0] + "-" + arr[x][1] + " a").attr('style', 'background: #00FFFF');
        // $("li.page-item.link-" + arr[x-gap] + " a").attr('style', 'background: red');
        // this performs insertion sort on subarrays
        for (var z = x; z >= gap && arr[z - gap][0] > temp[0]; z -= gap) {
            arr[z] = arr[z - gap];
            $("#next").attr('style', 'display: none');
            $("#swap").attr('style', 'display: inline');
        }
        // console.log("Z", arr[z])

        if (z != x && z != x - gap) {
            seta(x - gap);
            $("li.page-item.link-" + arr[z][0] + "-" + arr[z][1] + " a").attr('style', 'background: green');
        } else {
            $("li.page-item.link-" + arr[x - gap][0] + "-" + arr[x - gap][1] + " a").attr('style', 'background: red');
        }
        arr[z] = temp;
        x++;

        if (i >= j) {
            alert("Finalizado!");
            $("#next").attr('style', 'display: none');
            $("#all").attr('style', 'display: none');
            return;
        }

    });

    function seta(valor) {
        var widt = 15;
        for (var i = 0; i < valor; i++) {
            widt += $("li.page-item.link-" + arr[i][0] + "-" + arr[i][1]).width();
        }
        $('#seta').attr('style', 'margin-left: ' + widt);
        $('#message-info').text("The arrow points to the index that should be inserted, but according to the insertion algorithm that is also used in Shell Sort, the index to be checked will be the one that is green.");
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

    $(document).on('click', '#all', function () {
        var gaps = createGaps(arr), temp;

        var a = arr;
        for (var i = 0, j = gaps.length, gap; i < j; i += 1) {
            gap = gaps[i];


            for (var x = gap, y = a.length; x < y; x += 1) {
                temp = a[x];

                // this performs insertion sort on subarrays
                for (var z = x; z >= gap && a[z - gap][0] > temp[0]; z -= gap) {
                    a[z] = a[z - gap];
                }

                a[z] = temp;
            }
            // console.log(a)
        }
        arr = a;
        printVetor();
        $('#all').attr('style','display: none');
        $('#next').attr('style','display: none');
        $('#swap').attr('style','display: none');
    });

</script>