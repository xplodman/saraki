<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("submit", "form", function(e){

            e.preventDefault(e);
                    return  false;

            });

        });

    });
</script>

<p>Box Set 1</p>
<ul>
    <form action="http://google.com" method="GET">
        <li><input id="checkbox" name="checkbox[]" type="checkbox" value="Box 1"><label>Box 1</label></li>
        <li><input id="checkbox" name="checkbox[]" type="checkbox" value="Box 2"><label>Box 2</label></li>
        <li><input id="checkbox" name="checkbox[]" type="checkbox" value="Box 3"><label>Box 3</label></li>
        <li><input id="checkbox" name="checkbox[]" type="checkbox" value="Box 4"><label>Box 4</label></li>
</ul>
<input type="submit" value="Test Required" id="checkBtn">
    </form>


</body>
</html>