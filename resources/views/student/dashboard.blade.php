<x-main-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-purple-700 to-indigo-600 py-12">
            <h2 class="text-3xl font-bold text-white text-center leading-tight">
                {{ __('Student Dashboard') }}
            </h2>
        </div>
    </x-slot>


  <x-landing-student 
    :enrolledCourses="$enrolledCourses" 
    :recommendedCourses="$recommendedCourses"
    :latestAnnouncement="$latestAnnouncement"
    :completedCoursesCount="$completedCoursesCount"
    :totalLearningTime="$totalLearningTime"
    :certificatesCount="$certificatesCount"
/>

  


<div class="font-sans text-gray-900 antialiased">
    <div class="py-16 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                    <h3 class="font-semibold text-xl mb-4">Enrolled Courses</h3>
                    @forelse ($enrolledCourses as $course)
                        <div class="mb-3 bg-gray-700 p-4 rounded hover:bg-gray-600 transition">
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-600">
                                {{ $course->title }}
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-400">You are not enrolled in any courses yet.</p>
                    @endforelse
                </div>

                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                    <h3 class="font-semibold text-xl mb-4">Completed Courses</h3>
                    @forelse ($completedCourses as $course)
                        <div class="mb-3 bg-gray-700 p-4 rounded hover:bg-gray-600 transition">
                            <span class="text-green-400">✓</span>
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-600">
                                {{ $course->title }}
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-400">You haven't completed any courses yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
  

   
</x-main-layout>