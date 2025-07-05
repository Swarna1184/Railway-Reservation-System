document.addEventListener("DOMContentLoaded", function () {
    // Validate booking form
    document.getElementById("bookingForm")?.addEventListener("submit", function (event) {
        let trainNumber = document.getElementById("train_number").value;
        let passengerName = document.getElementById("passenger_name").value;
        let seatClass = document.getElementById("seat_class").value;

        if (trainNumber.trim() === "" || passengerName.trim() === "" || seatClass.trim() === "") {
            alert("All fields are required!");
            event.preventDefault();
        }
    });

    // Validate login form
    document.getElementById("loginForm")?.addEventListener("submit", function (event) {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        if (email.trim() === "" || password.trim() === "") {
            alert("Email and password cannot be empty!");
            event.preventDefault();
        }
    });
});
