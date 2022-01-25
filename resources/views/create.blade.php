@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Create Karyawan</h2>
        <div class="card mt-4">
            <div class="card-block">
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('nama') has-error @enderror">
                            <label>Nama <sup style='color: red'>*</sup></label>
                            <input type="text" class="form-control underlined" placeholder="Masukkan Nama Karyawan" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('jenis_kelamin') has-error @enderror">
                            <label>Jenis Kelamin <sup style='color: red'>*</sup></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender }}">{{ $gender }}</option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('nomor_hp') has-error @enderror">
                            <label>Nomor HP <sup style='color: red'>*</sup></label>
                            <input type="text" class="form-control underlined" placeholder="Masukkan Nomor HP Karyawan" name="nomor_hp" value="{{ old('nomor_hp') }}">
                            @error('nomor_hp')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('email') has-error @enderror">
                            <label>Email Aktif <sup style='color: red'>*</sup></label>
                            <input type="text" class="form-control underlined" placeholder="Masukkan Email Karyawan" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('current_salary') has-error @enderror">
                            <label>Current Salary <sup style='color: red'>*</sup></label>
                            <input type="number" class="form-control underlined" placeholder="Masukkan Gaji Karyawan" name="current_salary" value="{{ old('current_salary') }}">
                            @error('current_salary')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 @error('foto_profil') has-error @enderror">
                            <label>Upload Foto Profil <sup style='color: red'>*</sup></label>
                            <input type="file" class="form-control underlined" placeholder="Upload Image" name="foto_profil" value="{{ old('foto_profil') }}">
                            @error('foto_profil')
                                <span class="has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection