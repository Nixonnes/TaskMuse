// получаем элементы формы
const recoveryForm = document.querySelector(".recovery-form");
const forgotLoginButton = document.getElementById("forgotLoginButton");
const forgotPasswordButton = document.getElementById("forgotPasswordButton");
const EmailInput = document.getElementById("EmailInput");
let userEmail;
// Добавляем обработчики событий

recoveryForm.addEventListener("submit", function(event) {
	event.preventDefault(); // Предотвращаем стандартное поведение отправки формы
	// Получаем данные формы
const formData = new FormData(recoveryForm);
userEmail = formData.get("email");
console.log(JSON.stringify({ action: action, email: userEmail }));
	// Отправляем запрос на сервер
	fetch ("process_recovery.php", {
		method:"POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ action: action, email: userEmail}),
	})
	.then(response => response.json())
    .then(data => {
        // Обрабатываем полученные данные
        console.log(data);
        // Дополнительная логика обработки ответа
    })
    .catch(error => {
        console.error('Error:', error);
        // Обрабатываем ошибку
    });
	});

forgotLoginButton.addEventListener("click", function() {
	// Показать поле для вывода e-mail
	EmailInput.style.display = "block";
	action = "forgotLogin";
});


	



forgotPasswordButton.addEventListener("click", function() {
	// Показать поле для вывода e-mail
	action = "forgotPassword";
	EmailInput.style.display = "block";
});







