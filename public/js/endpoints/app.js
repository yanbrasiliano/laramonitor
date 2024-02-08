function openModal() {
  document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('modal').classList.add('hidden');
  document.getElementById('error-message').classList.add('hidden');
}

document.getElementById('create-endpoint-form').addEventListener('submit', function (event) {
  event.preventDefault();
  const url = document.getElementById('endpoint-url').value;
  const frequency = document.getElementById('endpoint-frequency').value;

  axios.post('/admin/endpoints/create', { url: url, frequency: frequency })
    .then(function (response) {
      closeModal();
      console.log(response.data);
    })
    .catch(function (error) {
      const errorMessageDiv = document.getElementById('error-message');
      errorMessageDiv.innerText = 'Error creating endpoint. Please try again.';
      errorMessageDiv.classList.remove('hidden');
      console.error(error);
    });
});
