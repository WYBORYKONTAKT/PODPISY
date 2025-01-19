<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz kontaktowy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Formularz kontaktowy</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $phone = htmlspecialchars($_POST['phone']);
            $name = htmlspecialchars($_POST['name']);
            $city = htmlspecialchars($_POST['city']);
            $district = htmlspecialchars($_POST['district']);

            $to = "wybory.kontakt@gmail.com";
            $subject = "Nowy formularz zgłoszeniowy";
            $message = "Otrzymano nową wiadomość:\n\n" .
                       "Adres e-mail: $email\n" .
                       "Numer telefonu: $phone\n" .
                       "Imię i nazwisko: $name\n" .
                       "Miasto: $city\n" .
                       "Gmina oczekiwanej komisji: $district";
            $headers = "From: $email";

            if (mail($to, $subject, $message, $headers)) {
                echo "<p style='color: green;'>Wiadomość została wysłana!</p>";
            } else {
                echo "<p style='color: red;'>Wystąpił błąd podczas wysyłania wiadomości.</p>";
            }
        }
        ?>
        <form id="contactForm" method="POST">
            <label for="email">Adres e-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Numer telefonu:</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{9}">
            
            <label for="name">Imię i nazwisko:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="city">Miasto:</label>
            <input type="text" id="city" name="city" required>
            
            <label for="district">Gmina oczekiwanej komisji:</label>
            <input type="text" id="district" name="district" required>
            
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            const phone = document.getElementById('phone').value;
            if (!/^[0-9]{9}$/.test(phone)) {
                event.preventDefault();
                alert("Numer telefonu musi składać się z 9 cyfr.");
            }
        });
    </script>
</body>
</html>
