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

