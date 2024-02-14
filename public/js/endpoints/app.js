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
function openEditModal(baseUrl, frequency) {
  document.getElementById('modal-edit').classList.remove('hidden');
  const endpointInput = document.getElementById('endpoint-url-edit');
  endpointInput.value = baseUrl.endsWith('/') ? baseUrl : `${baseUrl}/`;
  endpointInput.focus();
  endpointInput.setSelectionRange(endpointInput.value.length, endpointInput.value.length);
  document.getElementById('endpoint-frequency-edit').value = frequency;
}

function closeModalEdit() {
  document.getElementById('modal-edit').classList.add('hidden');
  document.getElementById('error-message-edit').classList.add('hidden');
  document.getElementById('endpoint-url-edit').value = '';
  document.getElementById('endpoint-url-edit').classList.remove('error');
  document.getElementById('endpoint-frequency-edit').value = '';
}

