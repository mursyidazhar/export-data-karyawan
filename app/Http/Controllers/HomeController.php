<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->simplePaginate(20);
        
        return view('home', [
            'employees' => $employees
        ]);
    }

    /**
     * Shows the form for creating a new employee.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = ['Laki-Laki', 'Perempuan'];

        return view('create', [
            'genders' => $genders
        ]);
    }

    /**
     * Stores a employee into the database.
     *
     * @param   \Illuminate\Http\Request  $request
     *
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'email' => 'email|required',
            'current_salary' => 'required',
            'foto_profil' => 'required|mimes:jpg,jpeg,png',
        ]);

        // BUAT NAMA FOTO
        $formatNama = str_replace(' ', '_', $request->nama);
        $namaFoto = time() . '-' . $formatNama . '.' . $request->foto_profil->extension();
        // SIMPAN FOTO DI FOLDER PUBLIC LALU IMAGES
        $request->foto_profil->move(public_path('images'), $namaFoto);

        $karyawan = Employee::create([
            'name' => $request->nama,
            'gender' => $request->jenis_kelamin,
            'phone_number' => $request->nomor_hp,
            'email' => $request->email,
            'current_salary' => $request->current_salary,
            'photo' => $namaFoto,
        ]);

        return redirect()->route('home')->with('success_message', 'Data berhasil ditambahkan!');
    }

     /**
     * Shows the form for editing the employee.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();
        $genders = ['Laki-Laki', 'Perempuan'];

        return view('edit', [
            'employee' => $employee,
            'genders' => $genders,
        ]);
    }

    /**
     * Updates a employee.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int      $id
     *
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validations =  [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'email' => 'email|required',
            'current_salary' => 'required',
        ];

        if(! empty($request->foto_profil)) {
            $validations['foto_profil'] = 'mimes:jpg,jpeg,png';
        }
        
        $this->validate($request, $validations);

        $employee = Employee::where('id', $id)->first();
        $employee->name = $request->nama;
        $employee->gender = $request->jenis_kelamin;
        $employee->phone_number = $request->nomor_hp;
        $employee->email = $request->email;
        $employee->current_salary = $request->current_salary;
        if(! empty($request->foto_profil)) {
            // BUAT NAMA FOTO
            $formatNama = str_replace(' ', '_', $request->nama);
            $namaFoto = time() . '-' . $formatNama . '.' . $request->foto_profil->extension();
            // SIMPAN FOTO DI FOLDER PUBLIC LALU IMAGES
            $request->foto_profil->move(public_path('images'), $namaFoto);
            // UPDATE FOTO KE DATABASE
            $employee->photo = $namaFoto;
        }
        $employee->save();

        return back()->with('success_message', 'Data Karyawan Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();

        return back()->with('success_message', 'Data Karyawan berhasil dihapus!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();

        return view('show', [
            'employee' => $employee
        ]);
    }

    /**
     * Export data karyawan .docx format
     *
     * @param   int  $id  
     *
     * @return  \Illuminate\Http\Response
     */
    public function export($id)
    {
        $employee = Employee::where('id', $id)->first();

        $templateProcessor = new TemplateProcessor('word-template/user.docx');
        $templateProcessor->setValue('name', $employee->name);
        $templateProcessor->setValue('gender', $employee->gender);
        $templateProcessor->setValue('phone_number', $employee->phone_number);
        $templateProcessor->setValue('email', $employee->email);
        $templateProcessor->setValue('formatted_salary', $employee->formatted_salary);        
        $templateProcessor->setImageValue('photo',array('src' => './images/' . $employee->photo,'swh'=>'250'));
        

        $fileName = str_replace(' ', '_', $employee->name);
        $templateProcessor->saveAs($fileName.'.docx');
        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }
}
