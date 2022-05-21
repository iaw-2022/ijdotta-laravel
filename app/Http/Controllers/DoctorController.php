<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::paginate(10);
        return view('doctors.index')->with('doctors', $doctors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = UserController::mapUserIdToUserName(User::all());
        return view('doctors.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        clock($request);
        $data = $this->validateDoctor($request);
        $newDoctor = Doctor::create($data);
        clock($newDoctor);

        session()->flash('success', 'Doctor succesfully created.');

        return redirect(route('admin.doctors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show')->with('doctor', $doctor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $users = UserController::mapUserIdToUserName(User::all());
        return view('doctors.edit', compact('doctor', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $doctor->update($this->validateDoctor($request));

        session()->flash('success', 'Doctor succesfully updated.');

        return redirect(route('admin.doctors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        if (sizeof($doctor->stories->all()) > 0) {
            return redirect(route('admin.doctors.index'))->withErrors(['cannot delete' => 'There are stories linked to this doctor. You cannot delete the doctor, but you are able to delete the associated user.']);
        }
        $doctor->delete();
        session()->flash('success', 'Doctor succesfully deleted.');
        return redirect(route('admin.doctors.index'));
    }

    public static function mapDoctorIdToDoctorName($doctors)
    {
        $doctorsMap = [];
        foreach ($doctors as $doctor) {
            $doctorsMap[$doctor->id] = $doctor->lastname . ', ' . $doctor->name;
        }
        return $doctorsMap;
    }

    private function validateDoctor(Request $request)
    {
        return $request->validate([
            'user_id' => [
                'required',
                Rule::in(User::all()->pluck('id')->toArray())
            ],
            'name' => ['required', 'max:20'],
            'lastname' => ['required', 'max:20'],
        ]);
    }
}
