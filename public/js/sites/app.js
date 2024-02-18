/*
  OPEN AND CLOSED MODAL FUNCTIONS ACTION
*/

function openModal() {
  document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('modal').classList.add('hidden');
  document.getElementById('error-message').classList.add('hidden');
}


/*
  OPEN AND CLOSED MODAL DELETE FUNCTIONS ACTION
*/

function openDeleteModal(siteId) {
  const modal = document.getElementById('deleteConfirmationModal');
  const confirmBtn = document.getElementById('deleteConfirmationModal-confirmBtn');

  if (modal && confirmBtn) {
    modal.classList.remove('hidden');
    confirmBtn.onclick = function () { confirmDelete(siteId); };
  } else {
    console.error('Modal or confirm button not found in the DOM.');
  }
}

function closeDeleteModal() {
  const modal = document.getElementById('deleteConfirmationModal');
  if (modal) {
    modal.classList.add('hidden');
  } else {
    console.error('Modal not found in the DOM.');
  }
}


/*
  OPEN AND CLOSED MODAL EDIT FUNCTIONS ACTION
*/

function openEditModal(siteUrl, siteUuid) {
  document.getElementById('edit-site-url').value = siteUrl;
  document.getElementById('modalEdit').classList.remove('hidden');
  document.getElementById('saveEditBtn').onclick = () => updateSite(siteUuid);
}


function closeEditModal() {
  document.getElementById('modalEdit').classList.add('hidden');
}