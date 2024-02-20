/* OPEN AND CLOSE MODAL CREATE */
function openModal(baseUrl) {
  document.getElementById('modal').classList.remove('hidden');
  const endpointInput = document.getElementById('endpoint-url');
  endpointInput.value = baseUrl.endsWith('/') ? baseUrl : `${baseUrl}/`;
  endpointInput.focus();
  endpointInput.setSelectionRange(endpointInput.value.length, endpointInput.value.length);
}

function closeModal() {
  document.getElementById('modal').classList.add('hidden');
  document.getElementById('error-message').classList.add('hidden');
  document.getElementById('endpoint-url').value = '';
  document.getElementById('endpoint-url').classList.remove('error');
  document.getElementById('endpoint-frequency').value = '';
}

/* OPEN AND CLOSE MODAL EDIT */
function openEditModal(endpointId, endpointUrl, frequency) {
  document.getElementById('modal-edit').classList.remove('hidden');

  const endpointInput = document.getElementById('endpoint-edit-url');
  const frequencyInput = document.getElementById('endpoint-edit-frequency');
  const hiddenIdInput = document.getElementById('endpoint-id');

  if (endpointInput && frequencyInput && hiddenIdInput) {
    hiddenIdInput.value = endpointId;
    endpointInput.value = endpointUrl;
    frequencyInput.value = frequency;

    endpointInput.focus();
    endpointInput.setSelectionRange(endpointInput.value.length, endpointInput.value.length);

    endpointInput.addEventListener('keydown', function (e) {
      const slashIndex = this.value.indexOf('/');
      if (e.key === "Backspace" && this.selectionStart <= slashIndex + 1) {
        e.preventDefault();
      }
    });
  }
}

function closeModalEdit() {
  document.getElementById('modal-edit').classList.add('hidden');

}

/* OPEN AND CLOSE MODAL DELETE */

function openDeleteModal(endpointId, endpointUrl) {
  const modal = document.getElementById('deleteEndpointConfirmationModal');
  const confirmBtn = document.getElementById('deleteEndpointConfirmationModal-confirmBtn');
  const endpointInput = document.getElementById('endpoint-delete-url');
  const hiddenIdInput = document.getElementById('endpoint-delete-id');


  if (modal && confirmBtn) {
    modal.classList.remove('hidden');
    confirmBtn.onclick = function () { confirmDelete(endpointId); };
  } else {
    console.error('Modal or confirm button not found in the DOM.');
    return;
  }

  if (endpointInput && hiddenIdInput) {
    hiddenIdInput.value = endpointId;
    endpointInput.value = endpointUrl;
  } else {
    console.error('Required input elements not found in the DOM.');
  }
}

function closeDeleteModal() {
  const modal = document.getElementById('deleteEndpointConfirmationModal');
  if (modal) {
    modal.classList.add('hidden');
  } else {
    console.error('Modal not found in the DOM.');
  }
}

