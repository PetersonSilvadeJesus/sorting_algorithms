<div class="container">
    <center>
        <h1>Merge Sort</h1>
    </center>
    <div class="jumbotron">

        <?= Vector::message(
                ['<b>Size</b>'=>'In the maximum 15 numbers',
                    'Red'=>'Fix the pivot to change',
                    'Blue'=>'Variable to search for the lowest'
                ]);
        ?>


        <?= Vector::choose_vector(); ?>

        Pilha:
        <nav id="" aria-label="Page navigation example">
            <ul id="stack" class="pagination">

            </ul>
        </nav>

        Vector:
        <center>
            <nav id="array" aria-label="Page navigation example">

            </nav>
        </center>
        <br>
        <?= Vector::buttons() ?>

    </div>
</div>
<div class="container">

    <h3>How Merge Sort Works?</h3>
    <p>Like QuickSort, Merge Sort is a Divide and Conquer algorithm. It divides input array in two halves, calls itself for the two halves and then merges the two sorted halves. The merge() function is used for merging two halves. The merge(arr, l, m, r) is key process that assumes that arr[l..m] and arr[m+1..r] are sorted and merges the two sorted sub-arrays into one.</p><br>
</div>
<script>

    var i = 0, j = 1;
    var flag2 = 1, aux = [];
    var coun = 0, nivel_maximo = 0;
    var waitingForEnter = false;
    var guardar = [];
    var countPrint = 0;
    var arrumado = [], pilha = [];
    var fase = 0;

    function printSubVectors(vet) {
        flag = true;
        var box = $('#uls' + vet[countPrint]['count']).html();
        // if(l1 != null && l2 != null) {

        if ($("#uls" + vet[countPrint]['count']).length == 0) {
            flag = false;
            box = $('#array').html();
            box += "<br><div> <ul id='uls" + vet[countPrint]['count'] + "' class='pagination' style=''>"
        } else {
            box += "&nbsp &nbsp &nbsp";
        }

        for (var l = 0; l < vet[countPrint]['array'].length; l++) {
            box += ('<li class="page-item link-' + vet[countPrint]['array'][l][0] + '-' + vet[countPrint]['array'][l][1] + '"><a class="page-link">' + vet[countPrint]['array'][l][0] + '</a></li>');
        }
        box += "&nbsp &nbsp &nbsp";

        if (!flag) {
            box += "</ul></div>";

            $('#array').html(box);
        } else {
            $("#uls" + vet[countPrint]['count']).html(box);
        }
        countPrint++;

        if (countPrint >= vet.length) {
            countPrint = 0;

            // fase = 1;
            // $('#next').attr('style', 'display: none');
            // $('#proximo').attr('style', 'display: inline');
            return;
        }
    }


    function printStack(pilha) {
        var box = $('#stack').html();
        box = "";
        for (var c = 0; c < pilha.length; c++) {
            box += ('<li class="page-item link-' + pilha[c][0] + '-' + pilha[c][1] + '"><a class="page-link">' + pilha[c][0] + '</a></li>');
        }
        $('#stack').html(box);
    }

    function printVetor(l1, l2) {

        var flag = true;
        var box = $('#uls' + coun).html();
        // if(l1 != null && l2 != null) {

        if ($("#uls" + coun).length == 0) {
            flag = false;
            box = $('#array').html();
            box += "<br> <ul id='uls" + coun + "' class='pagination' style='width: fit-content'>"
        } else {
            box += "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
        }

        if (l2 != null) {
            for (k = 0; k < l1.length; k++) {
                box += ('<li class="page-item link-' + l1[k][0] + '-' + l1[k][1] + '"><a class="page-link">' + l1[k][0] + '</a></li>');
            }
        }
        if (l2 != null) {
            box += "&nbsp &nbsp &nbsp &nbsp &nbsp";
            // box += "<ul class='pagination'>";
            for (k = 0; k < l2.length; k++) {
                box += ('<li class="page-item link-' + l2[k][0] + '-' + l1[k][1] + '"><a class="page-link">' + l2[k][0] + '</a></li>');
            }
        }

        if (!flag) {
            box += "</ul>";

            $('#array').html(box);
        } else {
            $("#uls" + coun).html(box);
        }
        // }
    }


    $(document).on('click', '#start', function () {
        printVetor(arr, null)

        $("#next").attr('style', 'display: inline');
        $("#all").attr('style', 'display: inline');

        // ################################################
        for (var p = 0; p < arr.length; p++) {
            arrumado.push({'array': [arr[p]], 'count': 15})
        }

        arr = mergesort(arr);


        guardar = recalcular_vetor(guardar);
        console.log(guardar);

        // #################################################
        $('#next').click();
    });

    $(document).on('click', '#next', function () {
        if (fase == 0) {

            if (flag2 == 1) {
                printSubVectors(guardar);

                if (countPrint > 1 && guardar[countPrint - 1]['array'].length == guardar[countPrint - 2]['array'].length) {
                    // pinto os dois
                    $("li.page-item.link-" + guardar[countPrint - 1]['array'][0] + "-" + guardar[countPrint - 1]['array'][1] + " a").attr('style', 'background: red');
                    $("li.page-item.link-" + guardar[countPrint - 2]['array'][0] + "-" + guardar[countPrint - 2]['array'][1] + " a").attr('style', 'background: blue');

                    aux = mergeNext(guardar[countPrint - 1]['array'], guardar[countPrint - 2]['array']);

                    flag2 = 2;
                }
            } else if (flag2 == 2) {

                if (aux.length == 0) {
                    // retirar e colocar o novo
                    guardar[countPrint - 1]['array'] = pilha;
                    guardar.splice(countPrint - 2, 1);
                    countPrint--;
                    console.log(guardar, countPrint);

                    pilha = [];
                    flag2 = 1;

                    if (countPrint >= guardar.length) {
                        fase = 2;
                    }

                    // substituir no nivel a pilha

                } else {
                    pilha.push(aux.shift());
                    printStack(pilha);
                }
            }
        } else if (fase == 1) {
            console.log(arrumado);
            for (var q = 0; q < arrumado.length; q++)
                printSubVectors(arrumado)

            fase = 2;
        } else if (fase == 2) {


        }
    });


    $(document).on('click', '#all', function () {
        var box;
        coun = 0;
        box = "<ul class='pagination'>";
        arr = mergesort(arr);
        // console.log(arrumado);
        for (var l = 0; l < arrumado.length; l++) {
            box += ('<li class="page-item link-' + arr[l][0] + '-' + arr[l][1] + '"><a class="page-link">' + arr[l][0] + '</a></li>');
        }
        box += "</ul>";
        $('#array').html(box);
    });


    function rearrumar(array) {
        var flag = false;
        for (var a = 0; a < array.length;) {
            var aux = [];
            aux.push([]);
            for (var b = a / 2; b < a; b++) {
                aux[a].push(b);
            }
            if (a == b) {

            }

            if (!flag) {
                flag = true;
            } else {
                flag = false;
                a *= 2;
            }
        }
    }

    function mergeNext(a, b) {
        // console.log(coun);
        var c = [];
        while (a.length > 0 && b.length > 0) {
            if (a[0][0] > b[0][0]) {
                c.push(b[0]);
                b.shift(); // tira a primeira posição do vetor
            } else {
                c.push(a[0]);
                a.shift(); // tira a primeira posição do vetor
            }
        }

        while (a.length > 0) {
            c.push(a[0]);
            a.shift(); // tira a primeira posição do vetor
        }

        while (b.length > 0) {
            c.push(b[0]);
            b.shift(); // tira a primeira posição do vetor
        }

        return c;
    }


    function merge(a, b) {
        // console.log(coun);
        var c = [];
        while (a.length > 0 && b.length > 0) {
            if (a[0] > b[0]) {
                c.push(b[0]);
                b.shift(); // tira a primeira posição do vetor
            } else {
                c.push(a[0]);
                a.shift(); // tira a primeira posição do vetor
            }
        }

        while (a.length > 0) {
            c.push(a[0]);
            a.shift(); // tira a primeira posição do vetor
        }

        while (b.length > 0) {
            c.push(b[0]);
            b.shift(); // tira a primeira posição do vetor
        }

        return c;
    }


    /**
     * Retorna lado 1
     * @param base
     */
    function dividir_vector_l1(base) {
        aux = [];
        for (i = 0; i < Math.floor(base.length / 2); i++) {
            aux.push(base[i]);
        }
        return aux;
    }

    function dividir_vector_l2(base) {
        aux = [];
        for (i = Math.floor(base.length / 2); i < base.length; i++) {
            aux.push(base[i]);
        }
        return aux;
    }

    function mergesort(a) {

        guardar.push({'array': a, 'count': coun});

        coun++;

        if (a.length == 1) {
            if (coun > nivel_maximo)
                nivel_maximo = coun;
            // printVetor(a, []);
            // guardar.push({'array':a, 'count':coun});
            coun--;
            return a;
        }

        var l1 = dividir_vector_l1(a);
        var l2 = dividir_vector_l2(a);


        // printVetor(l1, l2);
        // escrever novamente os lados abaixo do original


        l1 = mergesort(l1);
        l2 = mergesort(l2);

        coun--;

        // função que retorna um vetor
        return merge(l1, l2)
        // return;
    }

    function recalcular_vetor(vet) {
        vet2 = [];
        for (var i = 0; i < vet.length; i++) {

            // if(i > 0 && (vet[i]['count'] == vet[i-1]['count']) && vet[i]['count'] < nivel_maximo){
            //     console.log(i, [vet[i-1]['array'][0]])
            //     var soma = (vet[i-1]['count']) + 1;
            //     vet2.push({'array': vet[i-1]['array'],'count': soma});
            // }

            if (vet[i]['array'].length == 0) {
                if (vet[i - 1]['array'].length == 1) {
                    vet[i]['array'] = [vet[i - 2]['array'][1]];
                    //continue;
                } else
                    vet[i]['array'] = [vet[i - 1]['array'][0]];

            }
            vet2.push(vet[i]);
        }
        console.log(vet2);
        return vet2;
    }

</script>










