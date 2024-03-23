<?php

namespace App\Http\Controllers\Student;

use App\Helper\ReserveHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetTimeSlotRequest;
use App\Http\Requests\MachineReserveRequest;
use App\Models\Machine;
use App\Models\Reserve;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Helper\DateHelper;

class WashingMachineController extends Controller
{
    public function reserveForm(Request $request): View
    {
        $student = Auth::guard('student')->user();

        $dorm = (!empty($student->dorm))? $student->dorm: null;

        return view('students.dashboard.washing-machine.reserve')
            ->with([
                'student' => $student,
                'washingMachines' => Machine::where('dorm_id',$student['dorm_id'])->get(),
                'days' => DateHelper::getCurrentWeek(),
                'dorm' => $dorm->name
            ]);
    }

    public function reserveAction(MachineReserveRequest $request): View
    {
        $startTime = Carbon::parse($request->get('date') . ' ' . $request->get('time'));
        $start = clone $startTime;
        $endTime = $start->addMinutes(Reserve::RestDuration);
        $student = Auth::guard('student')->user();
        $dorm = (!empty($student->dorm))? $student->dorm: null;
        $machine_id = Machine::where('code',$request->get('machine_id'))->first()->id;
        $receiptID = rand(10000,99999);

        Reserve::create([
            'machine_id'=>$machine_id,
            'start_at' => $startTime->toDateTimeString(),
            'end_at' => $endTime->toDateTimeString(),
            'student_id' => $student->id,
            'receiptID' => $receiptID,
            'status' => Reserve::RSERVE_STATUS
        ]);

        return view('students.dashboard.washing-machine.receipt')
            ->with([
                'receiptID'=> $receiptID,
                'student' => $student,
                'dorm' => $dorm->name
            ]);
    }

    /**
     * @throws Exception
     */
    public function getTimes(GetTimeSlotRequest $request): JsonResponse
    {
        $machine_id = Machine::where('code', $request->get('machine_id'))->first()->id;
        $buckets = ReserveHelper::getTimeSlots($request->get('date'), $machine_id);
        return response()->json($buckets);
    }


}
