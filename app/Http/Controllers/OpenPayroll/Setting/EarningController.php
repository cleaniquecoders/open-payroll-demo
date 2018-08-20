<?php

namespace App\Http\Controllers\OpenPayroll\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\OpenPayroll\EarningType;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('open-payroll.settings.earning.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
        ]);

        EarningType::create([
            'name' => $request->name,
            'code' => kebab_case($request->name, ''),
            'is_locked' => false,
        ]);

        swal()->success('Setting', 'You have successfully create a earning type.');

        return redirect()->route('open-payroll.setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = EarningType::findOrFail($id);
        return view('open-payroll.settings.earning.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'name' => 'required|min:3|max:255',
        ]);

        EarningType::whereId($id)->update([
            'name' => $request->name,
            'code' => kebab_case($request->name, ''),
            'is_locked' => false,
        ]);

        swal()->success('Setting', 'You have successfully update a earning type.');

        return redirect()->route('open-payroll.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EarningType::whereId($id)->delete();

        swal()->success('Setting', 'You have successfully delete a earning type.');

        return redirect()->route('open-payroll.setting.index');
    }
}
