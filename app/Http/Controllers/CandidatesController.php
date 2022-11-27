<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Student::latest()->paginate(5);
        //
        //
        //    }

        $data = Candidates::latest()->paginate(5);
        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //

        return  view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'email'         =>  'required|email|unique:candidates',
                'first_name'    =>  'required',
                'last_name' => 'required',
                'status_id'  =>  'required',
                'commune_id'  =>  'required',
                'nom_commune'  =>  'required',
                'cv_link'   =>  'required|mimes:pdf,doc,docx,min_height=100,max_width=1000,max_height=1000'
            ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        request()->student_image->move(public_path('images'), $file_name);

        $candidate = new Candidates;


        $candidate->email = $request->email;
        $candidate->first_name = $request->first_name;
        $candidate->lasst_name = $request->last_name;
        $candidate->status_id = $request->status_id;
        $candidate->commune_id = $request->commune_id;
        $candidate->nom_commune = $request->nom_commune;
        $candidate->cv_link = $file_name;

        $candidate->save();

        return redirect()->route('candidate.index')->with('success', 'Candidate Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidates  $candidates
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Candidates $candidates)
    {
        //

        return  view('show', compact('candidates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidates  $candidates
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidates $candidates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidates  $candidates
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Candidates $candidates)
    {
        //
        $request->validate(
            [
                'email'         =>  'required|email|unique:candidates',
                'first_name'    =>  'required',
                'last_name' => 'required',
                'status_id'  =>  'required',
                'commune_id'  =>  'required',
                'nom_commune'  =>  'required',
                'cv_link'   =>  'required|mimes:pdf,doc,docx,min_height=100,max_width=1000,max_height=1000'
            ]);

        $candidates_pdf = $request->hidden_candidate_cv;

        if($request->cv_link != '')
        {
            $cv_link = time() . '.' . request()->cv_link->getClientOriginalExtension();

            request()->cv_link->move(public_path('images'), $cv_link);
        }

        $candidates = Candidates::find($request->hidden_id);

        $candidates->email = $request->email;

        $candidates->first_name = $request->first_name;

        $candidates->last_name = $request->last_name;
        $candidates->status_id = $request->status_id;
        $candidates->commune_id = $request->commune_id;

        $candidates->cv_link = $cv_link;

        $candidates->save();

        return redirect()->route('candidate.index')->with('success', 'Candidate Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidates  $candidates
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Candidates $candidates)
    {
        //

        $candidates->delete();
        return redirect()->route('candidate.index')->with('success', 'Candidate Data has been deleted successfully');
    }
}
