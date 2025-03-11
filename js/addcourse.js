
let currentStep = 1;
let courseData = {
    title: '',
    category: '',
    description: '',
    videoLink: '',
    thumbnail: null,
    pdfFile: null,
    handwrittenFile: null
};

// Multi-step navigation
function nextSection(step) {
    if (!validateSection(step)) return;
    document.getElementById(`section${step}`).classList.remove('active');
    document.getElementById(`section${step + 1}`).classList.add('active');
    updateCourseData();
}

function prevSection(step) {
    document.getElementById(`section${step}`).classList.remove('active');
    document.getElementById(`section${step - 1}`).classList.add('active');
}

// Form validation
function validateSection(step) {
    let isValid = true;
    const inputs = document.querySelectorAll(`#section${step} input, #section${step} select, #section${step} textarea`);
    inputs.forEach(input => {
        if (input.required && !input.value.trim()) {
            isValid = false;
            input.nextElementSibling.style.display = 'block';
        } else {
            input.nextElementSibling.style.display = 'none';
        }
    });
    return isValid;
}

// Update course data
function updateCourseData() {
    courseData.title = document.getElementById('course_title').value;
    courseData.category = document.getElementById('course_category').value;
    courseData.description = document.getElementById('course_description').value;
    courseData.videoLink = document.getElementById('video_link').value;
    courseData.thumbnail = document.getElementById('course_thumbnail').files[0];
    courseData.pdfFile = document.getElementById('pdfFileInput').files[0];
    courseData.handwrittenFile = document.getElementById('handwrittenFileInput').files[0];

    // Update review section
    document.getElementById('reviewTitle').textContent = courseData.title;
    document.getElementById('reviewCategory').textContent = courseData.category;
    document.getElementById('reviewDescription').textContent = courseData.description;
    document.getElementById('reviewVideoLink').textContent = courseData.videoLink;
    document.getElementById('reviewThumbnail').textContent = courseData.thumbnail ? courseData.thumbnail.name : 'No file uploaded';
}

// Submit form
function submitForm() {
    updateCourseData();
    document.getElementById('section3').classList.remove('active');
    document.getElementById('section4').classList.add('active');
}

// Reset form
function resetForm() {
    document.getElementById('section4').classList.remove('active');
    document.getElementById('section1').classList.add('active');
    document.getElementById('courseForm').reset();
    document.getElementById('pdfPreview').innerHTML = '';
    document.getElementById('handwrittenPreview').innerHTML = '';
}

// File upload functionality
function setupFileUpload(uploadBoxId, fileInputId, previewId) {
    const uploadBox = document.getElementById(uploadBoxId);
    const fileInput = document.getElementById(fileInputId);
    const preview = document.getElementById(previewId);

    uploadBox.addEventListener('click', () => fileInput.click());
    uploadBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadBox.classList.add('dragover');
    });
    uploadBox.addEventListener('dragleave', () => uploadBox.classList.remove('dragover'));
    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadBox.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        handleFileUpload(fileInput, preview);
    });

    fileInput.addEventListener('change', () => handleFileUpload(fileInput, preview));
}

function handleFileUpload(fileInput, preview) {
    const file = fileInput.files[0];
    if (file) {
        preview.innerHTML = `
            <div class="file-item">
                <span>${file.name} (${(file.size / 1024).toFixed(2)} KB)</span>
                <button onclick="removeFile('${fileInput.id}', '${preview.id}')">Remove</button>
            </div>
        `;
    } else {
        preview.innerHTML = '';
    }
}

function removeFile(fileInputId, previewId) {
    document.getElementById(fileInputId).value = '';
    document.getElementById(previewId).innerHTML = '';
}

// Initialize file uploads
setupFileUpload('pdfUploadBox', 'pdfFileInput', 'pdfPreview');
setupFileUpload('handwrittenUploadBox', 'handwrittenFileInput', 'handwrittenPreview');