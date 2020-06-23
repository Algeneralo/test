<!DOCTYPE html>
<html>
<head>
    <title>Ajax Request tester</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

<div class="container">
    <h1>Laravel 6 Ajax Request example</h1>

    <form >

        <div class="form-group">
            <label>Requested Table:</label>
            <input type="text" name="tab" class="form-control" placeholder="DB Table" required="">
        </div>

        <div class="form-group">
            <label>show Columns (test,test2) :</label>
            <input type="text" name="showcol" class="form-control" placeholder="" required="">
        </div>

        <div class="form-group">
            <label>Where Column:</label>
            <input type="text" name="where" class="form-control" placeholder="" required="">
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>

    </form>
    Ausgabe: <div name="ausgabe"></div>
</div>
</body>
<script type="text/javascript">


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".btn-submit").click(function(e){

    $("div[name=ausgabe]").text('');
    e.preventDefault();

    var tab = $("input[name=tab]").val();
    var where = $("input[name=where]").val();
    var showcol = $("input[name=showcol]").val();
    
    $.ajax({
       type:'POST',
       url:"{{ route('ajaxRequest.post') }}",
       data:{tab:tab, where:where, showcol:showcol},
       success:function(data){

          var json =  JSON.stringify(data.result);
          $("div[name=ausgabe]").text(json);

       },
       error:function(data){
          $("div[name=ausgabe]").text('ERROR:' + data.responseJSON.message);
       }
    });

});
</script>


</html>