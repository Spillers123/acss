<?php
ob_start();
?>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">My Teaching Schedule</h1>
                    <p class="text-gray-700 mt-1">View and manage your current semester schedule</p>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-medium"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Current Semester Card -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Current Academic Period</p>
                            <p class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($semesterName ?? 'Not Set'); ?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-600">Total Weekly Hours</p>
                        <p class="text-2xl font-bold text-yellow-600"><?php echo number_format($totalHours ?? 0, 1); ?> hrs</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Schedule Actions</h3>
                        <p class="text-sm text-gray-600">Export or print your teaching schedule</p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 w-full lg:w-auto">
                        <button
                            onclick="printOfficialSchedule()"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-gray-800 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print Schedule
                        </button>
                        <a
                            href="?action=download&format=pdf"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </a>
                        <button
                            onclick="window.location.reload()"
                            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh
                        </button>
                    </div>
                </div>

                <?php if (isset($showAllSchedules) && $showAllSchedules): ?>
                    <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700 font-medium">
                                    Showing all available schedules (no schedules found for the current semester).
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Schedule Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Class Schedule</h3>
                        <p class="text-gray-300 mt-1">Your current semester teaching assignments</p>
                    </div>
                    <div class="text-sm text-gray-300">
                        <?php if (isset($schedules) && !empty($schedules)): ?>
                            <span class="bg-yellow-400 text-gray-800 px-3 py-1 rounded-full font-medium">
                                <?php echo count($schedules); ?> classes
                            </span>
                        <?php else: ?>
                            <span class="bg-gray-600 text-gray-300 px-3 py-1 rounded-full">
                                No classes
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-yellow-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Course Code
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Course Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Section
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Room
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Days
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Time
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                Students
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php if (isset($schedules) && !empty($schedules)): ?>
                            <?php foreach ($schedules as $index => $schedule): ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900"><?php echo htmlspecialchars($schedule['course_code'] ?? 'N/A'); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 font-medium"><?php echo htmlspecialchars($schedule['course_name'] ?? 'N/A'); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-gray-800">
                                            <?php echo htmlspecialchars($schedule['section_name'] ?? 'N/A'); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-sm text-gray-600"><?php echo htmlspecialchars($schedule['room_name'] ?? 'TBD'); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 font-bold">
                                            <?php echo htmlspecialchars($schedule['day_of_week'] ?? 'TBD'); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars(($schedule['start_time'] ?? '') . ' - ' . ($schedule['end_time'] ?? '')); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $type = strtolower($schedule['schedule_type'] ?? 'lecture');
                                        $typeClass = $type === 'laboratory' ? 'bg-gray-800 text-white' : 'bg-yellow-100 text-gray-800';
                                        ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo $typeClass; ?>">
                                            <?php echo ucfirst($schedule['schedule_type'] ?? 'Lecture'); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($schedule['student_count'] ?? 'N/A'); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Classes Scheduled</h3>
                                        <p class="text-gray-600 mb-4 max-w-sm text-center">You don't have any classes assigned for the current semester.</p>
                                        <button
                                            onclick="window.location.reload()"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-800 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Refresh Page
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript with Complete Faculty Data -->
<script>
    function printOfficialSchedule() {
        // Get faculty data from PHP with proper fallbacks
        const facultyData = <?php echo json_encode($facultyData ?? []); ?>;
        const semesterInfo = <?php echo json_encode($semesterName ?? 'Current Semester'); ?>;
        const departmentName = <?php echo json_encode($departmentName ?? 'Not Assigned'); ?>;
        const collegeName = <?php echo json_encode($collegeName ?? 'Not Assigned'); ?>;
        const showAllSchedules = <?php echo json_encode($showAllSchedules ?? false); ?>;
        let schedules = [];

        try {
            schedules = <?php echo json_encode($schedules ?? []); ?>;
        } catch (e) {
            console.error('Error parsing schedules:', e);
            schedules = [];
        }

        // Faculty information with complete data
        const facultyName = facultyData.faculty_name || 'Faculty Name';
        const academicRank = facultyData.academic_rank || 'Instructor I';
        const employmentType = facultyData.employment_type || 'Regular';
        const bachelorDegree = facultyData.bachelor_degree || 'Not specified';
        const masterDegree = facultyData.master_degree || 'Not specified';
        const doctorateDegree = facultyData.doctorate_degree || 'Not specified';
        const postDocDegree = facultyData.post_doctorate_degree || 'Not applicable';
        const designation = facultyData.designation || 'Not specified';
        const classification = facultyData.classification || 'TL';
        const advisoryClass = facultyData.advisory_class || 'Not assigned';

        // Teaching load calculations
        const totalLectureHours = parseFloat(facultyData.total_lecture_hours || 0);
        const totalLabHours = parseFloat(facultyData.total_laboratory_hours || 0);
        const totalLabHoursX075 = parseFloat(facultyData.total_laboratory_hours_x075 || 0);
        const noOfPreparations = parseInt(facultyData.no_of_preparation || 0);
        const actualTeachingLoad = parseFloat(facultyData.actual_teaching_load || 0);
        const equivTeachingLoad = parseFloat(facultyData.equiv_teaching_load || 0);
        const totalWorkingLoad = parseFloat(facultyData.total_working_load || 0);
        const excessHours = parseFloat(facultyData.excess_hours || 0);

        // Generate schedule rows with proper table structure
        let scheduleRows = '';
        let currentRow = 0;
        const numScheduleRows = Math.max(4, schedules.length + 1);

        if (Array.isArray(schedules) && schedules.length > 0) {
            schedules.forEach((schedule, index) => {
                const timeRange = `${schedule.start_time || ''}-${schedule.end_time || ''}`;
                const courseInfo = `${schedule.course_code || 'N/A'} ${schedule.course_name || 'N/A'}`;
                const studentCount = schedule.student_count || '-';
                const sectionDetail = `${schedule.program_code || 'BSCS'}/${schedule.year_level || '1'}/${schedule.section_name || 'A'}`;
                const units = schedule.units || '3';
                const labHours = schedule.schedule_type === 'Laboratory' ? (schedule.duration_hours || '3') : '-';
                const lecHours = schedule.schedule_type === 'Lecture' ? (schedule.duration_hours || '3') : '-';

                scheduleRows += `
                <tr>
                    ${index === 0 ? `<td rowspan="${numScheduleRows}" style="border: 1px solid #000; padding: 4px; font-size: 10px; vertical-align: top; font-weight: bold; width: 20%;">${facultyName.toUpperCase()}</td>` : ''}
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${timeRange}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${schedule.day_of_week || 'MWF'}</td>
                    <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">${courseInfo}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${schedule.schedule_type === 'Lecture' ? units : '-'}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${lecHours}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${schedule.schedule_type === 'Laboratory' ? units : '-'}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${labHours}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${schedule.room_name || 'TBD'}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${sectionDetail}</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 10px;">${studentCount}</td>
                </tr>`;
                currentRow++;
            });
        } else {
            // Show faculty name with empty schedule
            scheduleRows = `
            <tr>
                <td rowspan="${numScheduleRows}" style="border: 1px solid #000; padding: 4px; font-size: 10px; vertical-align: top; font-weight: bold; width: 20%;">${facultyName.toUpperCase()}</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            </tr>`;
            currentRow = 1;
        }

        // Add remaining empty rows to complete faculty section
        while (currentRow < numScheduleRows - 1) {
            scheduleRows += `
            <tr>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            </tr>`;
            currentRow++;
        }

        // Faculty information section with complete data
        const facultyInfoContent = `
        <div style="font-size: 9px; line-height: 1.3;">
            <strong>Employment Status:</strong> ${employmentType}<br/>
            <strong>VSL:</strong> ${classification === 'VSL' ? '☑' : '☐'}Yes ${classification === 'TL' ? '☑' : '☐'}No<br/>
            <strong>Academic Rank:</strong> ${academicRank}<br/>
            <strong>Bachelor's Degree:</strong> ${bachelorDegree}<br/>
            <strong>Master's Degree:</strong> ${masterDegree}<br/>
            <strong>Doctorate Degree:</strong> ${doctorateDegree}<br/>
            <strong>Post Doctorate Degree:</strong> ${postDocDegree}<br/>
            <strong>Designation:</strong> ${designation}<br/>
            <strong>Schedule Equiv. Teaching Load (ETL):</strong> ${equivTeachingLoad}<br/>
            <strong>Total Lecture Hours:</strong> ${totalLectureHours}<br/>
            <strong>Total Laboratory Hours:</strong> ${totalLabHours}<br/>
            <strong>Total Lab Hours x 0.75:</strong> ${totalLabHoursX075.toFixed(2)}<br/>
            <strong>No. of Preparation:</strong> ${noOfPreparations}<br/>
            <strong>Advisory Class:</strong> ${advisoryClass}<br/>
            <strong>Equiv. Units for Prep:</strong> 0<br/>
            <strong>Actual Teaching Load (ATL):</strong> ${actualTeachingLoad.toFixed(2)}<br/>
            <strong>Total Working Load (ETL+ATL):</strong> ${totalWorkingLoad.toFixed(2)}<br/>
            <strong>Excess (24 Hours):</strong> ${excessHours.toFixed(2)}
        </div>
        `;

        // Add faculty information section (12 rows)
        scheduleRows += `
        <tr>
            <td rowspan="12" style="border: 1px solid #000; padding: 8px; font-size: 9px; vertical-align: top; width: 25%;">
                ${facultyInfoContent}
            </td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
        </tr>`;

        // Add 10 more empty rows for faculty info section
        for (let i = 0; i < 10; i++) {
            scheduleRows += `
            <tr>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
                <td style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
            </tr>`;
        }

        // Final row with colspan
        scheduleRows += `
        <tr>
            <td colspan="10" style="border: 1px solid #000; padding: 2px; font-size: 10px;">&nbsp;</td>
        </tr>`;

        // Header section with logo
        const headerSection = `
        <div style="display: flex; align-items: center; margin-bottom: 10px; font-family: Arial, sans-serif;">
            <div style="width: 60px; height: 60px; margin-right: 10px;">
                <img src="/assets/logo/main_logo/PRMSUlogo.png" style="width: 100%; height: 100%; object-fit: contain;" alt="PRMSU Logo">
            </div>
            <div style="flex: 1; text-align: center;">
                <div style="font-size: 10px; margin-bottom: 2px;">Republic of the Philippines</div>
                <div style="font-size: 12px; font-weight: bold; margin-bottom: 2px;">PRESIDENT RAMON MAGSAYSAY STATE UNIVERSITY</div>
                <div style="font-size: 8px; font-style: italic; margin-bottom: 5px;">(formerly Ramon Magsaysay Technological University)</div>
                <div style="font-size: 10px; font-weight: bold; margin-bottom: 2px;">Iba, Zambales</div>
                <div style="font-size: 14px; font-weight: bold; margin-top: 10px;">FACULTY TEACHING LOAD</div>
                <div style="font-size: 12px; margin-top: 5px;">${semesterInfo}</div>
            </div>
        </div>
        `;

        // Complete table structure
        const completeTable = `
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000; margin-bottom: 10px;">
            <thead>
                <tr>
                    <td rowspan="3" style="border: 1px solid #000; padding: 4px; font-size: 10px; vertical-align: top; width: 20%;">
                        <p><strong>Campus:</strong> Main Campus</p>
                        <p><strong>Address:</strong> Iba</p>
                        <p><strong>College:</strong> ${collegeName}</p>
                    </td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 8%;">Time</td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 6%;">Day/s</td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 25%;">Course Code and Title</td>
                    <td colspan="4" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px;">No. of Units/Hrs.</td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 8%;">Room</td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 12%;">Course/Yr./Sec.</td>
                    <td rowspan="3" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 8%;">No. of students</td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px;">Lec.</td>
                    <td colspan="2" style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px;">Lab./RLE</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 4%;">Units</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 4%;">Hrs.</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 4%;">Units</td>
                    <td style="border: 1px solid #000; padding: 2px; text-align: center; font-weight: bold; font-size: 10px; width: 4%;">Hrs.</td>
                </tr>
            </thead>
            <tbody>
                ${scheduleRows}
            </tbody>
        </table>
        `;

        // Signature section
        const signatureSection = `
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000; margin: 20px 0;">
            <tr>
                <td style="border: 1px solid #000; padding: 4px; font-weight: bold; font-size: 10px; text-align: center; width: 16.67%;">Prepared:</td>
                <td colspan="5" style="border: 1px solid #000; padding: 4px; font-weight: bold; font-size: 10px; text-align: center;">Recommending Approval:</td>
                <td colspan="6" style="border: 1px solid #000; padding: 4px; font-weight: bold; font-size: 10px; text-align: center;">Approved</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 15px; font-size: 10px; text-align: center; vertical-align: bottom;">
                    <div style="border-top: 1px solid #000; margin-top: 30px; padding-top: 5px;">
                        <strong>MENCHIE A. DELA CRUZ, Ph.D.</strong><br/>
                        Dean, CCIT
                    </div>
                </td>
                <td colspan="5" style="border: 1px solid #000; padding: 15px; font-size: 10px; text-align: center; vertical-align: bottom;">
                    <div style="border-top: 1px solid #000; margin-top: 30px; padding-top: 5px;">
                        <strong>NEMIA M. GALANG, Ph.D.</strong><br/>
                        Director for Instruction
                    </div>
                </td>
                <td colspan="6" style="border: 1px solid #000; padding: 15px; font-size: 10px; text-align: center; vertical-align: bottom;">
                    <div style="border-top: 1px solid #000; margin-top: 30px; padding-top: 5px;">
                        <strong>LILIAN F. UY, Ed.D.</strong><br/>
                        Vice President for Academic Affairs
                    </div>
                </td>
            </tr>
        </table>
        `;

        const printContent = `
        <div style="width: 100%; font-family: Arial, sans-serif; font-size: 10px; color: #000; background: white; padding: 20px;">
            ${headerSection}
            ${completeTable}
            ${signatureSection}
            
            <div style="margin-top: 10px; text-align: right; font-size: 8px; color: #666;">
                Reference no. PRMSU-ASA-COMSP18(1o)<br/>
                Effectivity date: May 04, 2021<br/>
                Revision no. 00
            </div>
            
            ${showAllSchedules ? '<p style="text-align: center; color: #e76f51; font-size: 10px; margin-top: 10px;">Showing all schedules (no schedules found for the current semester).</p>' : ''}
        </div>
        `;

        const printWindow = window.open('', '', 'height=800,width=1200');
        if (!printWindow) {
            alert('Popup blocked. Please allow popups for this site to print the schedule.');
            return;
        }

        printWindow.document.write('<html><head><title>Faculty Teaching Load</title>');
        printWindow.document.write(`
        <style>
            @page { size: landscape; margin: 10mm; }
            body { margin: 0; padding: 0; font-family: Arial, sans-serif; background: white; color: black; }
            table { page-break-inside: avoid; }
            .no-break { page-break-inside: avoid; }
            p { margin: 2px 0; font-size: 9px; }
            @media print {
                body { -webkit-print-color-adjust: exact; }
                table, tr, td, th { border-color: #000 !important; }
                p { margin: 1px 0; }
            }
        </style>
        `);
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();

        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 500);
    }

    // Enhanced UI interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading states to buttons
        const buttons = document.querySelectorAll('button, a[href*="download"]');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!this.classList.contains('loading')) {
                    this.classList.add('loading');
                    const originalHTML = this.innerHTML;

                    // Add loading spinner for buttons
                    if (this.tagName === 'BUTTON') {
                        this.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        `;
                    }

                    // Reset after 2 seconds
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('loading');
                    }, 2000);
                }
            });
        });

        // Add smooth animations for table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>

<style>
    /* Custom scrollbar for webkit browsers */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f3f4f6;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #fbbf24;
        border-radius: 3px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #f59e0b;
    }

    /* Loading button animation */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Smooth transitions */
    * {
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }
</style>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>