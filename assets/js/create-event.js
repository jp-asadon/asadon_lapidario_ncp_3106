// <!-- Bootstrap Validation and QR Code Generation -->

// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    const eventForm = document.getElementById('eventForm');
    const createEventModalElement = document.getElementById('createEventModal');
    const createEventModal = new bootstrap.Modal(createEventModalElement, {
      keyboard: false
    });

    // Elements within the modal
    const qrCodeContainer = document.getElementById('qrCode');
    const modalEventName = document.getElementById('modalEventName');
    const modalEventDate = document.getElementById('modalEventDate');
    const modalEventVenue = document.getElementById('modalEventVenue');
    const modalEventSpeaker = document.getElementById('modalEventSpeaker');

    // Buttons
    const saveQrBtn = document.getElementById('saveQrBtn');
    const deleteEventBtn = document.getElementById('deleteEventBtn');

    // Store the unique ID for deletion purposes (if needed)
    let currentEventId = null;

    eventForm.addEventListener('submit', function (e) {
      e.preventDefault(); // Prevent the default form submission

      // Check if the form is valid
      if (!eventForm.checkValidity()) {
        eventForm.classList.add('was-validated');
        return;
      }

      // Get form values
      const eventName = document.getElementById('id_event_name').value.trim();
      const eventDate = document.getElementById('id_event_date').value;
      const eventVenue = document.getElementById('id_event_venue').value.trim();
      const eventSpeaker = document.getElementById('id_event_speaker').value.trim();

      // Populate modal with event details
      modalEventName.textContent = eventName;
      modalEventDate.textContent = eventDate;
      modalEventVenue.textContent = eventVenue;
      modalEventSpeaker.textContent = eventSpeaker;

      // Generate a unique identifier for the QR code (e.g., timestamp)
      currentEventId = 'event-' + Date.now();

      // Define the URL or HTML file path for the QR code
      const qrContent = `https://yourdomain.com/events/${currentEventId}.html`; // Update this URL as needed

      // Clear any existing QR code
      qrCodeContainer.innerHTML = '';

      // Generate QR code
      new QRCode(qrCodeContainer, {
        text: qrContent,
        width: 128,
        height: 128,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      });

      // Show the modal
      createEventModal.show();

      // Reset the form
      eventForm.reset();
      eventForm.classList.remove('was-validated');
    });

    // Function to save QR Code as image
    saveQrBtn.addEventListener('click', function () {
      // Find the QRCode canvas or image
      let qrCanvas = qrCodeContainer.querySelector('canvas');
      let qrImage = qrCodeContainer.querySelector('img');

      if (qrCanvas) {
        // If QRCode.js generated a canvas
        let imgData = qrCanvas.toDataURL("image/png");

        // Create a temporary link to trigger download
        let downloadLink = document.createElement('a');
        downloadLink.href = imgData;
        downloadLink.download = `${currentEventId}_qr.png`;

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      } else if (qrImage) {
        // If QRCode.js generated an image
        let imgSrc = qrImage.src;

        // Create a temporary link to trigger download
        let downloadLink = document.createElement('a');
        downloadLink.href = imgSrc;
        downloadLink.download = `${currentEventId}_qr.png`;

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      } else {
        alert("QR Code not found!");
      }
    });

    // Function to delete the event
    deleteEventBtn.addEventListener('click', function () {
      if (confirm("Are you sure you want to delete this event? This action cannot be undone.")) {
        // Here you would typically make a server request to delete the event from the database.
        // Since this is a client-side implementation, we'll just hide the modal and clear the QR code.

        // Clear modal content
        modalEventName.textContent = '';
        modalEventDate.textContent = '';
        modalEventVenue.textContent = '';
        modalEventSpeaker.textContent = '';
        qrCodeContainer.innerHTML = '';

        // Hide the modal
        createEventModal.hide();

        // Optionally, notify the user
        alert("Event has been deleted.");
      }
    });
  });
