const form = document.getElementById('uploadForm');
const nameInput = document.getElementById('nameInput');
const whatsappInput = document.getElementById('whatsappInput');
const emailInput = document.getElementById('emailInput');
const photoInput = document.getElementById('photoInput');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const name = nameInput.value;
    const whatsapp = whatsappInput.value;
    const email = emailInput.value;
    const file = photoInput.files[0];

    if (name && whatsapp && email && file) {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('whatsapp', whatsapp);
        formData.append('email', email);
        formData.append('photo', file);

        fetch('/upload', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            alert('Photo uploaded successfully!');
        })
        .catch(error => {
            console.error(error);
            alert('An error occurred while uploading the photo.');
        });
    } else {
        alert('Please fill in all the fields and select a photo to upload.');
    }
});
