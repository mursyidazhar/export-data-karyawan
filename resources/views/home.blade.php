@extends('layouts.app')

@section('content')

    <div class="container-fluid">        
        <a href="{{ route('create') }}" class="btn btn-primary mb-2">Create Karyawan</a>
        @if(Session::has('success_message'))
            <div class="card card-success" style='margin-bottom: 20px'>
                <div class="card-header">
                    <div class="header-block">
                        <p class="title" style='color: white'>Success</p>
                    </div>
                </div>
                <div class="card-block">
                    {{ Session::get('success_message') }}
                </div>
            </div>
        @endif
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Nomor HP</th>
                <th scope="col">Email Aktif</th>
                <th scope="col">Current Salary</th>
                <th scope="col">Foto Profil</th>                
                <th scope="col">Option</th>                
              </tr>
            </thead>
            <tbody>
                @if(count($employees) < 1)
                    <tr>
                        <td colspan="8">Tidak ada data karyawan</td>
                    </tr>
                @endif
                @foreach($employees as $index=>$employee)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>{{ $employee->phone_number }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->formatted_salary }}</td>
                        <td>
                            <img src="{{ asset('images/' . $employee->photo) }}" class="card-img-top" style="width: 46px" >
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('edit', $employee->id) }}" class="btn btn-primary mr-2">Edit</a>
                                <form action="{{route('delete', $employee->id)}}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data karyawan?')">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger ms-2">Delete</button>
                                </form>
                                <a href="{{ route('edit', $employee->id) }}" class="btn btn-primary ml-2">Export</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection
