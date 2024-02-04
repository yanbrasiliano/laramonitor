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



