
// Debug logging at the beginning of the script
console.log("=== GENERATE SCHEDULES DEBUG ===");
console.log("Raw data received:", window.jsData);
console.log("Sections data:", window.rawSectionsData);
console.log("Faculty data:", window.faculty);
console.log("Classrooms data:", window.classrooms);
console.log("Curricula data:", window.curricula);
console.log("Curriculum courses for current semester:", window.jsData?.curriculumCourses || []);
console.log("Current semester:", window.currentSemester);
console.log("Department ID:", window.departmentId);

// Initialize data
function initializeScheduleData() {
  window.sectionsData = Array.isArray(window.rawSectionsData)
    ? window.rawSectionsData.map((s, index) => ({
        section_id: s.section_id ?? index + 1,
        section_name: s.section_name ?? "",
        year_level: s.year_level ?? "Unknown",
        academic_year: s.academic_year ?? window.currentAcademicYear,
        current_students: s.current_students ?? 0,
        max_students: s.max_students ?? 30,
        semester: s.semester ?? "",
        is_active: s.is_active ?? 1,
        curriculum_id: s.curriculum_id || null,
      }))
    : [];

  console.log("Processed sections data:", window.sectionsData);

  if (window.sectionsData.length === 0) {
    console.warn("No sections found for the current semester.");
    showValidationToast([
      "No sections found for the current semester. Please ensure sections are added in the database.",
    ]);
  }

  window.curriculumCourses = Array.isArray(window.jsData?.curriculumCourses)
    ? window.jsData.curriculumCourses.map((c, index) => ({
        course_id: c.course_id ?? index + 1,
        course_code: c.course_code ?? "",
        course_name: c.course_name ?? "Unknown",
        year_level: c.curriculum_year ?? "Unknown",
        semester: c.curriculum_semester ?? window.currentSemester?.semester_name,
        subject_type: c.subject_type ?? "",
        units: c.units ?? 0,
        lecture_units: c.lecture_units ?? 0,
        lab_units: c.lab_units ?? 0,
        lecture_hours: c.lecture_hours ?? 0,
        lab_hours: c.lab_hours ?? 0,
      }))
    : [];

  console.log("Processed curriculum courses:", window.curriculumCourses);

  // Ensure courses list is empty until curriculum is selected
  if (window.curriculumCourses.length === 0) {
    const coursesList = document.getElementById("courses-list");
    if (coursesList) {
      coursesList.innerHTML = '<p class="text-sm text-gray-600">Please select a curriculum to view available courses.</p>';
    }
  }
}

// Helper function to escape HTML
function escapeHtml(unsafe) {
  if (!unsafe) return "";
  return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

// Helper function to get or create toast container
function getOrCreateToastContainer() {
  let toastContainer = document.getElementById("toast-container");
  if (!toastContainer) {
    toastContainer = document.createElement("div");
    toastContainer.id = "toast-container";
    toastContainer.className = "fixed top-4 right-4 z-50 space-y-2";
    document.body.appendChild(toastContainer);
  }
  return toastContainer;
}

// Show validation error toast
function showValidationToast(errors) {
  const toastContainer = getOrCreateToastContainer();

  const toast = document.createElement("div");
  toast.className =
    "bg-red-50 border border-red-200 rounded-lg p-4 shadow-lg max-w-sm w-full transition-opacity duration-300";
  toast.innerHTML = `
    <div class="flex items-start">
      <div class="flex-shrink-0">
        <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
      </div>
      <div class="ml-3 flex-1">
        <p class="text-sm font-medium text-red-800">Validation Error</p>
        <ul class="list-disc pl-5 text-sm text-red-700 mt-1">
          ${errors.map((error) => `<li>${escapeHtml(error)}</li>`).join("")}
        </ul>
      </div>
      <div class="ml-3 flex-shrink-0">
        <button class="text-red-400 hover:text-red-600" onclick="this.parentElement.parentElement.parentElement.remove()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  `;

  toastContainer.appendChild(toast);
  setTimeout(() => {
    toast.classList.add("opacity-0");
    setTimeout(() => toast.remove(), 300);
  }, 5000);
}

// Show completion toast (success or warning)
function showCompletionToast(type, title, messages) {
  const toastContainer = getOrCreateToastContainer();

  const toast = document.createElement("div");
  toast.className = `bg-${
    type === "success" ? "green" : "yellow"
  }-50 border border-${
    type === "success" ? "green" : "yellow"
  }-200 rounded-lg p-4 shadow-lg max-w-sm w-full transition-opacity duration-300`;
  toast.innerHTML = `
    <div class="flex items-start">
      <div class="flex-shrink-0">
        <i class="fas ${
          type === "success" ? "fa-check-circle text-green-500" : "fa-exclamation-triangle text-yellow-500"
        } text-xl"></i>
      </div>
      <div class="ml-3 flex-1">
        <p class="text-sm font-medium ${
          type === "success" ? "text-green-800" : "text-yellow-800"
        }">${escapeHtml(title)}</p>
        <ul class="list-disc pl-5 text-sm ${
          type === "success" ? "text-green-700" : "text-yellow-700"
        } mt-1">
          ${messages.map((msg) => `<li>${escapeHtml(msg)}</li>`).join("")}
        </ul>
      </div>
      <div class="ml-3 flex-shrink-0">
        <button class="${
          type === "success" ? "text-green-400 hover:text-green-600" : "text-yellow-400 hover:text-yellow-600"
        }" onclick="this.parentElement.parentElement.parentElement.remove()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  `;

  toastContainer.appendChild(toast);
  setTimeout(() => {
    toast.classList.add("opacity-0");
    setTimeout(() => toast.remove(), 300);
  }, 5000);
}

// Highlight invalid form fields
function highlightField(fieldId, hasError) {
  const field = document.getElementById(fieldId);
  if (field) {
    if (hasError) {
      field.classList.add("border-red-500", "ring-2", "ring-red-500");
    } else {
      field.classList.remove("border-red-500", "ring-2", "ring-red-500");
      field.classList.add("border-gray-300");
    }
  }
}

// Clear validation errors
function clearValidationErrors() {
  ["curriculum_id"].forEach((fieldId) => highlightField(fieldId, false));
}

// Update courses list based on selected curriculum
function updateCourses() {
    const curriculumId = document.getElementById("curriculum_id").value;
    const coursesList = document.getElementById("courses-list");
    if (!coursesList) {
        console.error("Courses list element not found");
        return;
    }
    console.log("updateCourses called with curriculum:", curriculumId);
    if (!curriculumId) {
        coursesList.innerHTML = '<p class="text-sm text-gray-600">Please select a curriculum to view available courses.</p>';
        return;
    }
    coursesList.innerHTML = '<p class="text-sm text-gray-600">Loading courses...</p>';
    
    // FIX: Add the missing 'action' parameter
    fetch("/chair/generate-schedules", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            action: "get_curriculum_courses",  // <- This was missing!
            curriculum_id: curriculumId,
            semester_id: window.currentSemester.semester_id,
            department_id: window.departmentId,
            college_id: window.jsData.collegeId
        }),
    })
    .then((response) => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.text();
    })
    .then((text) => {
        console.log("Raw response:", text); // Debug raw response
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error("JSON parse error:", e, "Response:", text);
            throw new Error("Invalid JSON response: " + e.message);
        }
        console.log("Fetched courses:", data.courses);
        window.curriculumCourses = data.courses || [];
        if (window.curriculumCourses.length === 0) {
            coursesList.innerHTML = '<p class="text-sm text-red-600">No courses found for the selected curriculum and semester.</p>';
        } else {
            coursesList.innerHTML = `
                <ul class="list-disc pl-5 text-sm text-gray-700">
                    ${window.curriculumCourses
                        .map(
                            (course) => `
                                <li>
                                    ${escapeHtml(course.course_code)} - ${escapeHtml(course.course_name)}
                                    (Year: ${escapeHtml(course.curriculum_year)}, Semester: ${escapeHtml(course.curriculum_semester)})
                                </li>
                            `
                        )
                        .join("")}
                </ul>
            `;
        }
    })
    .catch((error) => {
        console.error("Error fetching courses:", error);
        coursesList.innerHTML = '<p class="text-sm text-red-600">Error loading courses. Please try again.</p>';
        showValidationToast(["Error loading courses: " + error.message]);
    });
}

// Generate Schedules Functionality
function generateSchedules() {
  const form = document.getElementById("generate-form");
  if (!form) {
    console.error("Generate form not found");
    return;
  }

  const formData = new FormData(form);
  const curriculumId = formData.get("curriculum_id");

  console.log("generateSchedules called with curriculum:", curriculumId);

  // Clear any existing error messages
  clearValidationErrors();

  // Validation checks
  const validationErrors = [];

  if (!curriculumId) {
    validationErrors.push("Please select a curriculum");
    highlightField("curriculum_id", true);
  }

  if (window.sectionsData.length === 0) {
    validationErrors.push("No sections available for the current semester");
  }

  if (window.curriculumCourses.length === 0) {
    validationErrors.push("No courses available for the selected curriculum");
  }

  if (!window.faculty || window.faculty.length === 0) {
    validationErrors.push("No faculty members available for assignment");
  }

  if (!window.classrooms || window.classrooms.length === 0) {
    validationErrors.push("No classrooms available for assignment");
  }

  if (validationErrors.length > 0) {
    showValidationToast(validationErrors);
    return;
  }

  // Clear any previous validation highlighting
  clearValidationErrors();

  // Show loading overlay
  const loadingOverlay = document.getElementById("loading-overlay");
  if (loadingOverlay) {
    loadingOverlay.classList.remove("hidden");
  }

  // FIX: Add the missing 'action' parameter
  const data = {
    action: "generate_schedule",  // <- This was missing!
    curriculum_id: curriculumId,
    semester_id: formData.get("semester_id"),
    tab: "generate",
  };

  console.log("Sending data to backend:", data);

  fetch("/chair/generate-schedules", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(data),
  })
    .then((response) => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.text();
    })
    .then((text) => {
      let data;
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error("Invalid JSON response:", text);
        throw new Error("Invalid response format: " + e.message);
      }

      if (loadingOverlay) {
        loadingOverlay.classList.add("hidden");
      }

      if (data.success) {
        window.scheduleData = data.schedules || [];

        // Show success results
        const generationResults = document.getElementById("generation-results");
        if (generationResults) {
          generationResults.classList.remove("hidden");
          document.getElementById("total-courses").textContent = data.schedules ? data.schedules.length : 0;
          document.getElementById("total-sections").textContent =
            new Set(data.schedules?.map((s) => s.section_name)).size || 0;

          // Update success rate based on unassigned courses
          const successRate = data.unassigned ? "95%" : "100%";
          document.getElementById("success-rate").textContent = successRate;
        }

        // Update schedule display if in manual tab
        const manualTab = document.getElementById("content-manual");
        if (manualTab && !manualTab.classList.contains("hidden")) {
          updateScheduleDisplay(window.scheduleData);
        }

        // Show appropriate message based on completion
        if (data.unassigned) {
          showCompletionToast(
            "warning",
            "Schedules generated with some conflicts!",
            [
              "Some courses could not be automatically assigned",
              "Check for time conflicts or resource limitations",
              "You can manually adjust schedules in the Manual Edit tab",
            ]
          );
        } else {
          showCompletionToast("success", "Schedules generated successfully!", [
            `${data.schedules.length} courses scheduled`,
            `${
              new Set(data.schedules?.map((s) => s.section_name)).size
            } sections assigned`,
            "All courses successfully scheduled without conflicts",
          ]);
        }
      } else {
        showValidationToast([data.message || "Failed to generate schedules"]);
      }
    })
    .catch((error) => {
      if (loadingOverlay) {
        loadingOverlay.classList.add("hidden");
      }
      console.error("Error:", error);
      showValidationToast(["Error generating schedules: " + error.message]);
    });
}

// Initialize event listeners
document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM fully loaded, initializing generate_schedules.js");

  // Initialize data
  initializeScheduleData();

  // Event listener for curriculum dropdown
  const curriculumSelect = document.getElementById("curriculum_id");
  if (curriculumSelect) {
    curriculumSelect.addEventListener("change", updateCourses);
  } else {
    console.error("Curriculum select element not found");
  }

  // Event listener for generate button
  const generateButton = document.getElementById("generate-btn");
  if (generateButton) {
    generateButton.addEventListener("click", generateSchedules);
  } else {
    console.error("Generate button not found");
  }
});
