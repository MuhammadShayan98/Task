<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AttendanceService
{
    public function uploadAttendance(Request $request)
    {
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $file = $request->file('excel_file');

        if (!empty($file)) {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'employee_id' => $sheet->getCell('A' . $row)->getValue(),
                    'Name' => $sheet->getCell('B' . $row)->getValue(),
                    'checkin' => $sheet->getCell('C' . $row)->getValue(),
                    'checkout' => $sheet->getCell('D' . $row)->getValue(),

                ];
                $startcount++;
            }
            DB::table('employee')->insert($data);
            return redirect()->back()->with('Excel file has been successfully uploaded.');
        } else {
            return redirect()->back()->with('There was a problem uploading the excel file : Not Found!');
        }
    }

    public function getEmployeeAttendance($employeeId)
    {

        $employee = Employee::findOrFail($employeeId);
        $attendance = Attendance::where('employee_id', $employee->id)->get();

        $totalWorkingHours = 0;
        foreach ($attendance as $record) {
            if ($record->checkin && $record->checkout) {
                $totalWorkingHours += $record->checkout->diffInHours($record->checkin);
            }
        }

        $data  = array_merge($totalWorkingHours, $attendance);

        return view('attendance-list')->with(['data' => $data]);
    }
}
