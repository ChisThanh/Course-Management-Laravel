<?php

namespace App\Http\Controllers;

use tidy;
use App\Models\Course;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Model $model;
    public function __construct()
    {
        $this->model = new Course();
        $routeName   = Route::currentRouteName();
        $arr         = explode('.', $routeName);
        $arr         = array_map('ucfirst', $arr);
        $title       = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index(/*Request $request sửa dụng code chay*/)
    {
        // code chay
        // $search = $request->get('q');
        // $data = $this->model::query()
        //     ->where('name', 'like', '%' . $search . '%') // tìm kiếm
        //     ->paginate(5); // phân trang

        // $data->appends(['q' => $search]); // thêm cái tuyền vào theo thanh địa chỉ

        // return view(
        //     'course.index',
        //     [
        //         'data' => $data,
        //         'search' => $search,
        //     ]
        // );

        // sử dụng data table
        return view('course.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query()->withCount('students'))
            ->editColumn('created_at', function ($object) {
                return $object->year_created_at;
            })
            ->addColumn('edit', function ($object) {
                return route('courses.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('courses.destroy', $object);
            })
            ->make(true);
    }


    public function apiName(Request $request)
    {
        return $this->model
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'name',
            ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest  $request)
    {
        /* Cách 1  */
        // $object = new Course();
        // $object->name = $request->get('name');
        // $object->save();

        /* Cách 2  */
        // $object = new Course();
        // $object->fill($request->except('_token')); // tên của input = db
        // $object->save();

        // Cách 3
        // $this->model::create($request->except('_token'));

        $this->model->query()->create($request->validated()); // lấy những cái đã được vailidate ở models [$fillable]
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {

        return view(
            'course.edit',
            [
                'course' => $course,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, /* [c3]Course $course*/ $courseId)
    {
        // Cách 1
        // $this->model::where('id', $course->id)->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );
        // Cách 2
        // $course->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );

        // [c3] tốn thời gian select
        // $course->fill($request->except('_token'));
        // $course->save();
        // return redirect()->route('courses.index');

        $object = $this->model->query()->find($courseId);
        $object->fill($request->validated());
        $object->save();
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId)
    {
        /**Cách 1 - bỏ Tham só Course  */
        // $this->model::destroy($course); // query builder
        /**Cách 2 - bỏ Tham só Course  */
        // $this->model::where('id', $course)->delete();
        /**Cách 3  */
        // $course->delete();
        // return redirect()->route('courses.index'); code chay

        $this->model->query()->where('id', $courseId)->delete();
        $arr            = [];
        $arr['status']  = true;
        $arr['message'] = '';
        return response($arr, 200);
    }
}
