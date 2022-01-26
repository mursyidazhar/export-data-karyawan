<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Informasi Karyawan</title>
  </head>
  <body>
    <div class="container">
        <table class="table table-striped table-bordered mt-5">
            <thead>
              <tr>
                <th scope="col">Field</th>
                <th scope="col">Value</th>             
              </tr>
            </thead>
            <tbody>            
                <tr>
                    <td>Nama</td>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{ $employee->gender }}</td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td>{{ $employee->phone_number }}</td>
                </tr>
                <tr>
                    <td>Email Aktif</td>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <td>Current Salary</td>
                    <td>{{ $employee->formatted_salary }}</td>
                </tr>
                <tr>
                    <td>Foto Profil</td>
                    <td>
                        <img src="{{ asset('images/' . $employee->photo) }}" class="card-img-top" style="width: 46px" >
                    </td>
                </tr>                
            </tbody>
          </table>
          <a href="{{ route('export', $employee->id) }}" class="btn btn-primary mt-2">Export Word</a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>