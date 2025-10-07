// Manual Schedule Management
let draggedElement = null;
let currentEditingId = null;

function handleDragStart(e) {
    draggedElement = e.target;
    e.target.style.opacity = '0.5';
    e.dataTransfer.effectAllowed = 'move';
}

function handleDragEnd(e) {
    e.target.style.opacity = '1';
    draggedElement = null;
}

function handleDragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
}

function handleDragEnter(e) {
    if (e.target.classList.contains('drop-zone')) {
        e.target.classList.add('bg-yellow-100', 'border-2', 'border-dashed', 'border-yellow-400');
    }
}

function handleDragLeave(e) {
    if (e.target.classList.contains('drop-zone')) {
        e.target.classList.remove('bg-yellow-100', 'border-2', 'border-dashed', 'border-yellow-400');
    }
}

function handleDrop(e) {
    e.preventDefault();
    const dropZone = e.target.closest('.drop-zone');
    if (dropZone && draggedElement && dropZone !== draggedElement.parentElement) {
        dropZone.classList.remove('bg-yellow-100', 'border-2', 'border-dashed', 'border-yellow-400');

        const scheduleId = draggedElement.dataset.scheduleId;
        const newDay = dropZone.dataset.day;
        const newStartTime = dropZone.dataset.startTime;
        const newEndTime = dropZone.dataset.endTime;

        const scheduleIndex = window.scheduleData.findIndex(s => s.schedule_id == scheduleId);
        if (scheduleIndex !== -1) {
            window.scheduleData[scheduleIndex].day_of_week = newDay;
            window.scheduleData[scheduleIndex].start_time = newStartTime + ':00';
            window.scheduleData[scheduleIndex].end_time = newEndTime + ':00';
        }

        const oldButton = draggedElement.parentElement.querySelector('button');
        if (oldButton) oldButton.style.display = 'block';

        const existingCard = dropZone.querySelector('.schedule-card');
        if (existingCard && existingCard !== draggedElement) {
            draggedElement.parentElement.appendChild(existingCard);
        }

        const newButton = dropZone.querySelector('button');
        if (newButton) newButton.style.display = 'none';

        dropZone.appendChild(draggedElement);
        showNotification('Schedule moved successfully! Don\'t forget to save changes.', 'success');
    }
}

function initializeDragAndDrop() {
    const dropZones = document.querySelectorAll('.drop-zone');
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', handleDragOver);
        zone.addEventListener('dragenter', handleDragEnter);
        zone.addEventListener('dragleave', handleDragLeave);
        zone.addEventListener('drop', handleDrop);
    });
}

function openAddModal() {
    document.getElementById('modal-title').textContent = 'Add Schedule';
    const form = document.getElementById('schedule-form');
    form.reset();
    document.getElementById('schedule-id').value = '';
    document.getElementById('modal-day').value = '';
    document.getElementById('modal-start-time').value = '';
    document.getElementById('modal-end-time').value = '';
    document.getElementById('course-code').value = '';
    document.getElementById('course-name').value = '';
    document.getElementById('faculty-name').value = '';
    document.getElementById('room-name').value = '';
    document.getElementById('section-name').value = '';
    document.getElementById('start-time').value = '07:30';
    document.getElementById('end-time').value = '08:30';
    document.getElementById('day-select').value = 'Monday';
    currentEditingId = null;
    showModal();
}

function openAddModalForSlot(day, startTime, endTime) {
    openAddModal();
    document.getElementById('modal-title').textContent = 'Add Schedule';
    document.getElementById('modal-day').value = day;
    document.getElementById('modal-start-time').value = startTime;
    document.getElementById('modal-end-time').value = endTime;
    document.getElementById('day-select').value = day;
    document.getElementById('start-time').value = startTime;
    document.getElementById('end-time').value = endTime;
}

function editSchedule(scheduleId) {
    const schedule = window.scheduleData.find(s => s.schedule_id == scheduleId);
    if (schedule) {
        document.getElementById('modal-title').textContent = 'Edit Schedule';
        document.getElementById('schedule-id').value = schedule.schedule_id;
        document.getElementById('course-code').value = schedule.course_code;
        document.getElementById('course-name').value = schedule.course_name;
        document.getElementById('faculty-name').value = schedule.faculty_name;
        document.getElementById('room-name').value = schedule.room_name || '';
        document.getElementById('section-name').value = schedule.section_name;
        document.getElementById('modal-day').value = schedule.day_of_week;
        document.getElementById('day-select').value = schedule.day_of_week;
        document.getElementById('modal-start-time').value = schedule.start_time.substring(0, 5);
        document.getElementById('start-time').value = schedule.start_time.substring(0, 5);
        document.getElementById('modal-end-time').value = schedule.end_time.substring(0, 5);
        document.getElementById('end-time').value = schedule.end_time.substring(0, 5);
        currentEditingId = scheduleId;
        showModal();
    }
}

function showModal() {
    document.getElementById('schedule-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('schedule-modal').classList.add('hidden');
    document.getElementById('schedule-form').reset();
    currentEditingId = null;
}

function syncCourseName() {
    const courseCode = document.getElementById('course-code').value;
    const courseNameInput = document.getElementById('course-name');
    const courseNames = Array.from(document.querySelectorAll('#course-names option')).map(opt => ({
        code: opt.getAttribute('data-code'),
        name: opt.value
    }));
    const matchingCourse = courseNames.find(c => c.code === courseCode);
    if (matchingCourse) {
        courseNameInput.value = matchingCourse.name;
    }
}

function syncCourseCode() {
    const courseName = document.getElementById('course-name').value;
    const courseCodeInput = document.getElementById('course-code');
    const courseNames = Array.from(document.querySelectorAll('#course-names option')).map(opt => ({
        code: opt.getAttribute('data-code'),
        name: opt.value
    }));
    const matchingCourse = courseNames.find(c => c.name === courseName);
    if (matchingCourse) {
        courseCodeInput.value = matchingCourse.code;
    }
}

function handleScheduleSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('schedule-form');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    // Ensure times include seconds
    data.start_time = data.start_time + ':00';
    data.end_time = data.end_time + ':00';
    
    // Validate form data
    if (!data.course_code || !data.course_name || !data.faculty_name || !data.section_name || !data.day_of_week || !data.start_time || !data.end_time) {
        showNotification('Please fill out all required fields.', 'error');
        return;
    }

    const url = currentEditingId ? '/chair/updateSchedule' : '/chair/addSchedule';
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                showNotification(currentEditingId ? 'Schedule updated successfully!' : 'Schedule added successfully!', 'success');
                
                // Update scheduleData
                if (currentEditingId) {
                    const index = window.scheduleData.findIndex(s => s.schedule_id == currentEditingId);
                    if (index !== -1) {
                        window.scheduleData[index] = { ...window.scheduleData[index], ...data.schedule };
                    }
                } else {
                    window.scheduleData.push(data.schedule);
                }
                
                updateScheduleDisplay(window.scheduleData);
                initializeDragAndDrop();
            } else {
                showNotification(data.message || 'Failed to save schedule.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error saving schedule: ' + error.message, 'error');
        });
}

function saveAllChanges() {
    const updatedSchedules = window.scheduleData.map(schedule => ({
        schedule_id: schedule.schedule_id,
        day_of_week: schedule.day_of_week,
        start_time: schedule.start_time,
        end_time: schedule.end_time,
        course_code: schedule.course_code,
        course_name: schedule.course_name,
        faculty_name: schedule.faculty_name,
        room_name: schedule.room_name || '',
        section_name: schedule.section_name
    }));

    fetch('/chair/schedule_management', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ schedules: updatedSchedules })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('All changes saved successfully!', 'success');
                window.scheduleData = data.schedules || [];
                updateScheduleDisplay(window.scheduleData);
                initializeDragAndDrop();
            } else {
                showNotification(data.message || 'Failed to save changes.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error saving changes: ' + error.message, 'error');
        });
}

// Replace the existing openDeleteModal function
function openDeleteModal() {
    console.log('Opening delete modal...');
    const modal = document.getElementById('delete-confirmation-modal');
    
    if (!modal) {
        console.error('Delete confirmation modal element not found!');
        // Fallback to simple confirm dialog
        if (confirm('Are you sure you want to delete all schedules? This action cannot be undone.')) {
            confirmDeleteSchedules();
        }
        return;
    }
    
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    console.log('Modal should now be visible');
}

// Replace the existing closeDeleteModal function
function closeDeleteModal() {
    console.log('Closing delete modal...');
    const modal = document.getElementById('delete-confirmation-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

// Replace the existing deleteAllSchedules function
function deleteAllSchedules() {
    console.log('Delete all schedules function called');
    openDeleteModal();
}

// Replace the existing confirmDeleteSchedules function
function confirmDeleteSchedules() {
    console.log('Confirming delete schedules...');
    
    const deleteButton = document.querySelector('#delete-confirmation-modal button[onclick="confirmDeleteSchedules()"]');
    let originalText = '';
    
    if (deleteButton) {
        originalText = deleteButton.innerHTML;
        deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';
        deleteButton.disabled = true;
    }

    fetch('/chair/generate-schedules', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'delete_schedules',
            confirm: 'true'
        }),
    })
    .then(response => {
        console.log('Delete response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Delete response data:', data);
        if (data.success) {
            showNotification('All schedules have been deleted successfully.', 'success');
            window.scheduleData = [];
            updateScheduleDisplay([]);
            
            const generationResults = document.getElementById('generation-results');
            if (generationResults) {
                generationResults.classList.add('hidden');
            }
        } else {
            showNotification('Error deleting schedules: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        showNotification('Error deleting schedules: ' + error.message, 'error');
    })
    .finally(() => {
        if (deleteButton) {
            deleteButton.innerHTML = originalText;
            deleteButton.disabled = false;
        }
        closeDeleteModal();
    });
}

function deleteSchedule(scheduleId) {
  if (!confirm("Are you sure you want to delete this schedule?")) return;

  fetch("/chair/generate-schedules", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "delete_schedule",
      schedule_id: scheduleId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        window.scheduleData = window.scheduleData.filter(
          (s) => s.schedule_id != scheduleId
        );
        updateScheduleDisplay(window.scheduleData);
        showNotification("Schedule deleted successfully!", "success");
        initializeDragAndDrop();
      } else {
        showNotification(data.message || "Failed to delete schedule.", "error");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      showNotification("Error deleting schedule: " + error.message, "error");
    });
}

function deleteAllSchedules() {
  if (
    !confirm(
      "Are you sure you want to delete all schedules? This action cannot be undone."
    )
  )
    return;

  fetch("/chair/generate-schedules", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "delete_schedules",
      confirm: "true",
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        window.scheduleData = [];
        updateScheduleDisplay(window.scheduleData);
        showNotification("All schedules deleted successfully!", "success");
        initializeDragAndDrop();
      } else {
        showNotification(
          data.message || "Failed to delete all schedules.",
          "error"
        );
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      showNotification(
        "Error deleting all schedules: " + error.message,
        "error"
      );
    });
}

function filterSchedulesManual() {
    const yearLevel = document.getElementById('filter-year-manual').value;
    const section = document.getElementById('filter-section-manual').value;
    const room = document.getElementById('filter-room-manual').value;
    const scheduleCells = document.querySelectorAll('#schedule-grid .drop-zone');

    scheduleCells.forEach(cell => {
        const card = cell.querySelector('.schedule-card');
        if (card) {
            const itemYearLevel = card.dataset.yearLevel;
            const itemSectionName = card.dataset.sectionName;
            const itemRoomName = card.dataset.roomName;
            const matchesYear = !yearLevel || itemYearLevel === yearLevel;
            const matchesSection = !section || itemSectionName === section;
            const matchesRoom = !room || itemRoomName === room;

            card.style.display = matchesYear && matchesSection && matchesRoom ? 'block' : 'none';
        }

        const addButton = cell.querySelector('button');
        if (addButton) {
            addButton.style.display = !card || card.style.display === 'none' ? 'block' : 'none';
        }
    });
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initialize drag-and-drop
    initializeDragAndDrop();

    // Add event listener for add schedule button
    const addScheduleBtn = document.getElementById('add-schedule-btn');
    if (addScheduleBtn) addScheduleBtn.addEventListener('click', openAddModal);

    // Add event listener for save changes button
    const saveChangesBtn = document.getElementById('save-changes-btn');
    if (saveChangesBtn) saveChangesBtn.addEventListener('click', saveAllChanges);

    // Add event listener for delete all button
    const deleteAllBtn = document.getElementById('delete-all-btn');
    if (deleteAllBtn) deleteAllBtn.addEventListener('click', deleteAllSchedules);

    // Add event listeners for filter dropdowns
    const filterYear = document.getElementById('filter-year-manual');
    if (filterYear) filterYear.addEventListener('change', filterSchedulesManual);

    const filterSection = document.getElementById('filter-section-manual');
    if (filterSection) filterSection.addEventListener('change', filterSchedulesManual);

    const filterRoom = document.getElementById('filter-room-manual');
    if (filterRoom) filterRoom.addEventListener('change', filterSchedulesManual);

    // Add event listeners for course code and name sync
    const courseCodeInput = document.getElementById('course-code');
    if (courseCodeInput) courseCodeInput.addEventListener('input', syncCourseName);

    const courseNameInput = document.getElementById('course-name');
    if (courseNameInput) courseNameInput.addEventListener('input', syncCourseCode);
});