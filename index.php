<?php
session_start();

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 3;
}

$correct_answer = "AK";
$input_correct = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = $_POST['user_input'];

    if ($user_input === $correct_answer) {
        $input_correct = true;
        $_SESSION['attempts'] = 3;
    } else {
        $_SESSION['attempts'] -= 1;
        if ($_SESSION['attempts'] <= 0) {
            $_SESSION['attempts'] = 3; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge One</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Arial', sans-serif;
            color: white;
        }
        .content {
            text-align: center;
        }
        h1 {
            font-size: 4rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 3s ease-in-out;
        }
        .input-section {
            display: none;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1rem;
        }
        button {
            padding: 10px 20px;
            font-size: 1rem;
            margin-top: 10px;
            cursor: pointer;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .hidden-php {
            display: none;
        }
    </style>
    <script>
        function showInputSection() {
            document.querySelector('.input-section').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelector('.content').style.display = 'block';
                setTimeout(showInputSection, 3000);
            }, 0);
        });
    </script>
</head>
<body>
    <div class="content">
        <h1>Challenge One</h1>
        <div class="input-section">
            <?php if ($_SESSION['attempts'] > 0): ?>
                <form method="post">
                    <input type="text" name="user_input" required>
                    <button type="submit">Submit</button>
                </form>
            <?php else: ?>
                <p>No more attempts left!</p>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($input_correct): ?>
        <div class="hidden-php">
            &lt;php&gt; <br>
            <!--  -->
            &lt;/php&gt;
        </div>
    <?php endif; ?>
</body>
</html>
