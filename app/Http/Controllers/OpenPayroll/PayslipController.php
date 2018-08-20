<?php

namespace App\Http\Controllers\OpenPayroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayslipController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = \App\Models\OpenPayroll\Employee::has('salary')->has('position')->with('salary', 'position')->get();
        $payrolls  = \App\Models\OpenPayroll\Payroll::whereIsLocked(false)->latest()->get();

        return view('open-payroll.payslip.create', compact('employees', 'payrolls'));
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
            'payroll'   => 'required',
            'user_id'   => 'required',
            'employees' => 'required',
        ]);

        $payroll = \App\Models\OpenPayroll\Payroll::findByHashSlugOrId($request->payroll);

        $employees = $request->employees;
        foreach ($employees as $hashslug) {
            $employee = \App\Models\OpenPayroll\Employee::hashslug($hashslug)->has('salary')->with('salary')->firstOrFail();
            $employee->payslips()->updateOrCreate([
                'payroll_id'   => $payroll->id,
                'basic_salary' => $employee->salary->amount,
                'gross_salary' => $employee->salary->amount,
                'net_salary'   => $employee->salary->amount,
                'is_verified'  => false,
                'is_approved'  => false,
                'is_locked'    => false,
            ]);
        }

        swal()->success('Payslip', 'You have successfully created payslip(s).');

        return redirect()->route('open-payroll.payroll.show', $request->payroll);
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
        $payslip = \App\Models\OpenPayroll\Payslip::whereHashslug($id)->with('payroll', 'earnings', 'earnings.type', 'deductions', 'deductions.type')->firstOrFail();

        return view('open-payroll.payslip.show', compact('payslip'));
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
    }
}
