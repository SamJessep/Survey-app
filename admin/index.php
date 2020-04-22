<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
    <h1>Admin dashboard</h1>
    <br>
    <br>
    <main class='container-fluid'>
      <h3>Download Excel file</h3>
      <button onclick="downloadXls()">Download</button>

      <br>
      <br>

      <h3>Email survey results</h3>
      <form class="container-fluid" action="src/mailer.php" method="post">
        <div class='form-group'>
          <label class="sr-only" for="email">Email</label>
          <input class="form-control" id='email' type="text" name="email" value="" placeholder="Email">
        </div>
          <input type="submit" name="" value="Email me the results">
      </form>
    </main>


    <script type="text/javascript">
      function downloadXls(){
        $.ajax({
          url: 'download.php',
          data: '',
          success: function(data){
            console.log(data)
          }
        });
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
