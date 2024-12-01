<?php
ob_start();
require "config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="imagess/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Add any necessary styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            background: radial-gradient(circle at center, #1e3c72, #2a5298);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            min-height: 100vh;
            margin: 0;
            overflow: auto;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(243, 156, 18, 0.3), rgba(231, 76, 60, 0.3), rgba(52, 152, 219, 0.3));
            animation: gradientAnimation 10s infinite;
            filter: blur(100px);
            z-index: -1;
        }

        @keyframes gradientAnimation {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                transform: translate(-50%, -50%) rotate(180deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .login-container {
            background: rgba(26, 37, 47, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 10;
        }

        .login-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 1);
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #f39c12;
        }

        .form-control {
            background: #2c3e50;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #34495e;
            border: 2px solid #f39c12;
            box-shadow: 0 0 10px rgba(243, 156, 18, 0.8);
        }

        .form-floating label {
            color: #ccc;
        }

        .btn-login {
            background: linear-gradient(to right, #f39c12, #e67e22);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 0 15px rgba(243, 156, 18, 0.6);
            transition: all 0.3s ease, transform 0.2s ease;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #e67e22, #d35400);
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(243, 156, 18, 1);
        }

        .alert {
            font-size: 0.9rem;
            margin-top: 1rem;
            background-color: #e74c3c;
            border: none;
            color: #ffffff;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            cursor: pointer;
        }

        .toggle input {
            display: none;
        }

        /* Slider Style */
        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ccc;
            border-radius: 50px;
            transition: 0.4s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .slider:before {
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            background: radial-gradient(circle, rgba(243, 156, 18, 0.3), transparent);
            top: -50%;
            left: -50%;
            opacity: 0;
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .slider:after {
            content: '';
            position: absolute;
            height: 18px;
            width: 18px;
            background: white;
            border-radius: 50%;
            bottom: 3px;
            left: 4px;
            transition: transform 0.4s ease, background 0.4s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
        }

        /* Checked State */
        input:checked+.slider {
            background: linear-gradient(to right, #f39c12, #e67e22);
        }

        input:checked+.slider:after {
            transform: translateX(26px);
            background: #ffeaa7;
        }

        input:checked+.slider:before {
            opacity: 1;
            transform: scale(1.5);
        }

        /* Hover Effect */
        .toggle:hover .slider {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(243, 156, 18, 0.5);
        }

        .show-password label {
            margin: 0;
            color: #ccc;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .toggle:hover+label {
            color: #f39c12;
        }

        @media screen and (max-width: 500px) {
            body {
                animation: none;
            }

            .login-container {
                box-shadow: none;
                border-radius: 10px;
                width: 95%;
                padding: 1rem;
            }

            .login-container:hover {
                transform: none;
                box-shadow: none;
            }

            .form-control {
                padding: 0.5rem;
                font-size: 0.85rem;
                background: #34495e;
                /* border: 1px solid #2c3e50; */
                color: white;
                /* transition: none; */
            }

            .form-control:focus {
                outline: none;
                box-shadow: none;
            }

            .btn-login {
                padding: 0.6rem;
                font-size: 0.9rem;
                box-shadow: none;
            }

            .alert {
                font-size: 0.8rem;
            }
        }

        body.swal2-shown {
            overflow: hidden;
        }

        .swal2-container {
            z-index: 9999;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">Login sek Boss</h2>
        <form id="loginForm" action="" method="post">
            <div class="form-floating mb-4">
                <input type="text" class="form-control" style="color: whitesmoke;" name="username" id="floatingInput" placeholder="Username" autocomplete="off" required>
                <label for="floatingInput"><i class="fa-solid fa-user"></i> Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" style="color: whitesmoke;" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off" required>
                <label for="floatingPassword"><i class="fa-solid fa-lock"></i> Password</label>
            </div>
            <div class="show-password mb-2 d-flex align-items-center gap-2">
                <label class="toggle">
                    <input type="checkbox" onclick="myFunction()" id="show-password">
                    <span class="slider"></span>
                </label>
                <label for="show-password" class="mb-0">Show Password</label>
            </div>

            <button class="btn-login" type="submit" name="loginbtn">Login</button>
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                if (empty($username) || empty($password)) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please fill out username and password',
                                background: 'rgba(26, 37, 47, 0.9)',
                                color: '#ffffff'
                            });
                        });
                    </script>";
                } else {
                    $stmt = $conn->prepare("SELECT id, username, email, password FROM registration WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $data = $result->fetch_assoc();

                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['login'] = true;
                            $_SESSION['id'] = $data['id'];

                            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    html: `
                                        <div class='d-flex flex-column align-items-center'>
                                            <div class='spinner-border text-warning' style='width: 3rem; height: 3rem;' role='status'>
                                                <span class='visually-hidden'>Loading...</span>
                                            </div>
                                            <p class='mt-3 text-white'>Login Success Rediricting...</p>
                                        </div>
                                    `,
                                    background: 'rgba(26, 37, 47, 0.9)',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timer: 2000,
                                    didOpen: () => {
                                        const progressBar = Swal.getTimerProgressBar();
                                        if (progressBar) {
                                            progressBar.style.backgroundColor = '#f39c12';
                                        }
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.href = 'index.php';
                                    }
                                });
                            });
                        </script>";
                        } else {
                            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Login Failed',
                                        text: 'Incorrect username or password',
                                        background: 'rgba(26, 37, 47, 0.9)',
                                        color: '#ffffff'
                                    });
                                });
                            </script>";
                        }
                    } else {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: 'Incorrect username or password',
                                    background: 'rgba(26, 37, 47, 0.9)',
                                    color: '#ffffff'
                                });
                            });
                        </script>";
                    }

                    $stmt->close();
                }
            }
            ?>
        </form>
    </div>


    <script>
        function myFunction() {
            var x = document.getElementById("floatingPassword");
            x.type = x.type === "password" ? "text" : "password";
        }
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        if (document.body.classList.contains('swal2-shown')) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = 'auto';
                        }
                    }
                });
            });

            observer.observe(document.body, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>