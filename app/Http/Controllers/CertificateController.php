<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Barryvdh\DomPDF\PDF;
use App\Models\Certificate;
use Illuminate\Http\Request;
// use PDF;

class CertificateController extends Controller
{
    // public function generate(Course $course)
    // {
    //     $user = auth()->user();

    //     if (!$user->hasCompleted($course)) {
    //         return redirect()->back()->with('error', 'You have not completed this course yet.');
    //     }

    //     $certificate = Certificate::firstOrCreate([
    //         'user_id' => $user->id,
    //         'course_id' => $course->id,
    //     ], [
    //         'certificate_number' => $this->generateCertificateNumber(),
    //         'issue_date' => now(),
    //     ]);

    //     $pdf = PDF::loadView('certificates.template', compact('certificate', 'course', 'user'));

    //     return $pdf->download('certificate.pdf');
    // }

    public function verify(Request $request)
    {
        $request->validate([
            'certificate_number' => 'required|string',
        ]);

        $certificate = Certificate::where('certificate_number', $request->certificate_number)->first();

        if ($certificate) {
            return view('certificates.verify', [
                'certificate' => $certificate,
                'course' => $certificate->course,
                'user' => $certificate->user,
            ]);
        } else {
            return view('certificates.verify', [
                'error' => 'Certificate not found. Please check the number and try again.',
            ]);
        }
    }

    public function generate(Course $course)
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur a terminé le cours
        if (!$course->isCompletedBy($user)) {
            return back()->with('error', 'You have not completed this course yet.');
        }

        // Vérifier si un certificat existe déjà
        $existingCertificate = Certificate::where('user_id', $user->id)
                                          ->where('course_id', $course->id)
                                          ->first();

        if ($existingCertificate) {
            return view('certificates.show', ['certificate' => $existingCertificate]);
        }

        // Générer un nouveau certificat
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'certificate_number' => $this->generateUniqueNumber(),
        ]);

        return view('certificates.show', ['certificate' => $certificate]);
    }

    private function generateUniqueNumber()
    {
        do {
            $number = strtoupper(substr(uniqid(), -6));
        } while (Certificate::where('certificate_number', $number)->exists());

        return $number;
    }
}
