<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('eager')) {
            $users = User::with('company')->get();
        } else {
            $users = User::all();
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->only(['name', 'email', 'password']));
        $company = new Company();
        $company->name = $request->get('company_name');
        $company->address = $request->get('company_address');
        $company->phone = $request->get('company_phone');
        $user->company()->save($company);
        return redirect()->route('users.index');
    }

}
