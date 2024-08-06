<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Certificate;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
    public function generate(Course $course)
    {
        $user = auth()->user();

        if (!$user->hasCompleted($course)) {
            return redirect()->back()->with('error', 'You have not completed this course yet.');
        }

        $certificate = Certificate::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ], [
            'certificate_number' => $this->generateCertificateNumber(),
            'issue_date' => now(),
        ]);

        $pdf = PDF::loadView('certificates.template', compact('certificate', 'course', 'user'));

        return $pdf->download('certificate.pdf');
    }

    public function verify(Request $request)
    {
        $certificateNumber = $request->input('certificate_number');
        $certificate = Certificate::where('certificate_number', $certificateNumber)->first();

        if (!$certificate) {
            return view('certificates.verify', ['status' => 'invalid']);
        }

        return view('certificates.verify', [
            'status' => 'valid',
            'certificate' => $certificate,
            'course' => $certificate->course,
            'user' => $certificate->user,
        ]);
    }

    private function generateCertificateNumber()
    {
        do {
            $number = strtoupper(substr(uniqid(), -6));
        } while (Certificate::where('certificate_number', $number)->exists());

        return $number;
    }
}
