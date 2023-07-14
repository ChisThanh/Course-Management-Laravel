<?php

namespace App\Http\Controllers;

use App\Enums\StudentStatusEnum;
use App\Models\Student;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class StudentController extends Controller
{
    private Model $model;
    public function __construct()
    {
        $this->model = new Student();
        $routeName   = Route::currentRouteName();
        $arr         = explode('.', $routeName);
        $arr         = array_map('ucfirst', $arr);
        $title       = implode(' - ', $arr);

        $arrEnum = StudentStatusEnum::getArrayView();

        View::share('title', $title);
        View::share('arrEnum', $arrEnum);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        return view('student.index');
    }


    public function api()
    {
        // Sử dụng cho dữ liệu lớn join tốt cho mysql
        // $query = $this->model->query()->addSelect('students.*')
        //     ->addSelect('courses.name as course_name')
        //     ->join('courses', 'courses.id', 'students.course_id');
        // return DataTables::of($query)
        //     ->editColumn('gender', function ($object) {
        //         return $object->gender_name;
        //     })
        //     ->addColumn('age', function ($object) {
        //         return $object->age;
        //     })
        //     ->editColumn('status', function ($object) {
        //         return StudentStatusEnum::getKeyByValue($object->status);
        //     })
        //     ->addColumn('course_name', function ($object) {
        //         return $object->name;
        //     })
        //     ->addColumn('edit', function ($object) {
        //         return route('students.edit', $object);
        //     })
        //     ->addColumn('destroy', function ($object) {
        //         return route('students.destroy', $object);
        //     })
        //     ->make(true);

        return DataTables::of($this->model::query()->with('course'))
            ->editColumn('gender', function ($object) {
                return $object->gender_name;
            })
            ->addColumn('age', function ($object) {
                return $object->age;
            })
            ->editColumn('status', function ($object) {
                return StudentStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('course_name', function ($object) {
                return $object->course->name;
            })
            ->addColumn('edit', function ($object) {
                return route('students.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('students.destroy', $object);
            })
            ->filterColumn('course_name', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->whereHas('course', function ($q) use ($keyword) {
                        return $q->where('id', $keyword);
                    });
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('status', $keyword);
                }
            })
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $courses = Course::get();
        return view('student.create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $path          = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        $arr           = $request->validated();
        $arr['avatar'] = $path;
        $this->model->query()->create($arr);
        return redirect()->route('students.index')->with('success', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::get();

        return view(
            'student.edit',
            [
                'student' => $student,
                'courses' => $courses,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $studentId)
    {
        $object = $this->model->query()->find($studentId);
        $object->fill($request->validated());
        $object->save();
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($studentId)
    {


        $this->model->query()->where('id', $studentId)->delete();
        $arr            = [];
        $arr['status']  = true;
        $arr['message'] = '';
        return response($arr, 200);
    }
}
