<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $jsonfile = file_get_contents("movie.json");
    ?>
    <div>
        Year :<br>
        <select id="year" onchange="showMovie()">
            <option value="">None</option>
        </select>
        <br>
        <select id="movie" onchange="showDetail()">

        </select>
        <br>
    </div>
    <script>
        var jsonEx = <?php echo $jsonfile ?>;
        doc = document.getElementById("movie");
        year = document.getElementById("year");

        for (i = 0; i < jsonEx.length; i++) {
            var option = document.createElement("option");
            option.text = jsonEx[i].year;
            if (i > 0 && option.text == jsonEx[i - 1].year) {
                continue;
            }
            year.add(option);

        }

        function clearInput() {
            document.getElementById("inyear").value = "";
            document.getElementById("intitle").value = "";
            document.getElementById("incategory").value = "";
            document.getElementById("incast").value = "";
        }

        function showDetail() {
            var y = document.getElementById("movie").value;
            inyear = document.getElementById("inyear");
            intitle = document.getElementById("intitle");
            incategory = document.getElementById("incategory");
            incast = document.getElementById("incast");
            for (i = 0; i < jsonEx.length; i++) {
                var x = y.replace(jsonEx[i].year + " : ", "");
                if (jsonEx[i].title == x) {
                    inyear.value = jsonEx[i].year;
                    intitle.value = jsonEx[i].title;
                    incategory.value = jsonEx[i].genres;
                    incast.value = jsonEx[i].cast;
                }
            }
        }

        function showMovie() {
            clearOption();
            var x = document.getElementById("year").value;
            if (x == null || x == "") {
                clearInput();
            }
            for (i = 0; i < jsonEx.length; i++) {
                if (jsonEx[i].year == x) {
                    var option = document.createElement("option");
                    option.text = jsonEx[i].year + " : " + jsonEx[i].title;
                    doc.add(option);
                }
            }
        }

        function clearOption() {
            var select = document.getElementById("movie");
            var length = select.options.length;
            for (i = length - 1; i >= 0; i--) {
                select.options[i] = null;
            }
        }

        /*function compare_data(dat, data) {
            result = 0;
            for (i = 0; i < dat.length; i++) {
                if (dat[i] == data) {
                    result = 1;
                    break;
                }
            }
            if (dat.length == 0 || result == 0) {
                dat.push(data);
            }
            return dat;
        }*/
    </script>
    <div id="output">
        <input type="text" id="inyear" readonly><br>
        <input type="text" id="intitle" readonly><br>
        <textarea id="incast" cols="30" rows="10" readonly></textarea><br>
        <input type="text" id="incategory" readonly>
    </div>
</body>

</html>