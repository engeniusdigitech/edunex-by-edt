<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\HostelBill;
use Illuminate\Http\Request;

class HostelBillController extends Controller
{
    private function student()
    {
        return auth()->guard('student')->user();
    }

    public function index()
    {
        $student = $this->student();
        $bills = HostelBill::where('student_id', $student->id)->latest('billing_month')->get();
        return view('student.hostel.bills', compact('bills'));
    }
}
