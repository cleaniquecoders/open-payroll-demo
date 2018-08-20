<?php

namespace App\Http\Controllers\OpenPayroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = \App\Models\OpenPayroll\Payroll::latest()->paginate();

        return view('open-payroll.payroll.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('open-payroll.payroll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'month' => 'required|min:1|max:12',
            'year'  => 'required',
            'date'  => 'required',
        ]);

        $payroll = \App\Models\OpenPayroll\Payroll::create($request->only('user_id', 'month', 'year', 'date'));

        swal()->success('Payroll', 'You have successfully created a payroll.');

        return redirect()->route('open-payroll.payroll.show', $payroll->hashslug);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payroll = \App\Models\OpenPayroll\Payroll::with('payslips', 'payslips.user')->findByHashSlugOrId($id);

        return view('open-payroll.payroll.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payroll = \App\Models\OpenPayroll\Payroll::whereHashslug($id)->firstOrFail();

        if ($payroll->is_locked) {
            swal()->error('Payroll', 'You cannot delete locked payroll.');

            return redirect()->route('open-payroll.payroll.index');
        }

        $payroll->delete();
        swal()->success('Payroll', 'You have successfully delete a payroll');

        return redirect()->route('open-payroll.payroll.index');
    }
}
