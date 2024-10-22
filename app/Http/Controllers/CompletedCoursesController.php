<?php

namespace App\Http\Controllers;

use App\Models\Completed_courses;
use Illuminate\Http\Request;

class CompletedCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $completedCourses = Completed_courses::with('user', 'course')->get(); // Traer los cursos completados con los usuarios y cursos

        return view('completed_courses.index', compact('completed_courses.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Completed_courses $completed_courses)
    {
        // $completedCourse = Completed_courses::with('user', 'course')->findOrFail($id); // Traer los detalles del curso completado

        return view('completed_courses.show', compact('completedCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Completed_courses $completed_courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Completed_courses $completed_courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Completed_courses $completed_courses)
    {
        //
    }
}
