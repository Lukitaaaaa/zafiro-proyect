// Profile edit page logic: image preview & remove.
// Expects an <img id="preview-image" data-default-image="/images/profile.svg"> element
// and elements: #upload-photo (file input), #remove-image (button), #remove_image_check (hidden input)

function initProfileEdit() {
    const uploadPhoto = document.getElementById('upload-photo');
    const previewImage = document.getElementById('preview-image');
    const removeImageBtn = document.getElementById('remove-image');
    const removeImageCheck = document.getElementById('remove_image_check');
    if (!uploadPhoto || !previewImage || !removeImageBtn || !removeImageCheck) return;

    const defaultImage = previewImage.dataset.defaultImage || '/images/profile.svg';

    // Show remove button only if current image differs from default & not empty.
    if (previewImage.src && !previewImage.src.endsWith('profile.svg')) {
        removeImageBtn.classList.remove('d-none');
    }

    uploadPhoto.addEventListener('change', function (event) {
        const file = event.target.files && event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                removeImageBtn.classList.remove('d-none');
                removeImageCheck.value = '';
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function (event) {
        event.preventDefault();
        previewImage.src = defaultImage;
        removeImageCheck.value = 'true';
        removeImageBtn.classList.add('d-none');
        if (uploadPhoto) {
            uploadPhoto.value = '';
        }
    });
}

document.addEventListener('DOMContentLoaded', initProfileEdit);
