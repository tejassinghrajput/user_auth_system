<?php
$userData = session()->get('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .card {
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header, .card-footer {
            background: rgba(0, 123, 255, 0.2);
            border-radius: 10px;
            color: #fff;
        }

        .list-group-item {
            background: #fff;
            border: none;
            color: #343a40;
        }

        .list-group-item:hover {
            background: rgba(0, 123, 255, 0.2);
            cursor: pointer;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        h1, h4 {
            color: #007bff;
        }

        .btn, .card {
            transition: transform 0.2s ease-in-out;
        }

        .btn:hover, .card:hover {
            transform: scale(1.05);
        }

        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        #popup input {
            margin-bottom: 10px;
        }

        .popup-btns {
            text-align: right;
        }

        #close-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1050;
            transition: opacity 0.3s ease, bottom 0.3s ease;
        }

        .toast.show {
            display: block;
            opacity: 1;
            bottom: 30px;
        }

        .toast.error {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow-lg" id="user-card">
                    <div class="card-header text-center">
                        <h4>User Information</h4>
                    </div>
                    <div class="card-body" id="user-info">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Username:</strong> <?php if(isset($userData['username'])) echo htmlspecialchars($userData['username']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Phone:</strong> <?php if(isset($userData['phone'])) echo htmlspecialchars($userData['phone']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Joined At:</strong> <?php echo htmlspecialchars($userData['created_at']); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/logout"><button class="btn btn-danger" id="logout-btn">Logout</button></a>
                    </div>
                    <input type="hidden" id="userId" value="<?php echo $userData['id']; ?>">
                </div>
            </div>
        </div>
    </div>

    <div id="popup">
        <h5>Enter Missing Details</h5>
        <form id="popup-form">
            <div id="username-section" style="display: none;">
                <label for="newUsername">Username:</label>
                <input type="text" id="newUsername" name="newUsername" class="form-control" required><br>
            </div>

            <div id="phone-section" style="display: none;">
                <label for="newPhone">Phone:</label>
                <input type="text" id="newPhone" name="newPhone" class="form-control" required><br>
            </div>

            <div id="password-section" style="display: none;">
                <label for="newPassword">Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="form-control" required><br>
            </div>
            <div id="email-section" style="display: none;">
                <label for="newEmail">Email:</label>
                <input type="email" id="newEmail" name="newEmail" class="form-control" required><br>
            </div>

            <div class="popup-btns">
                <button type="button" id="close-btn" class="btn">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div id="toast" class="toast">
        <p id="toast-message"></p>
    </div>

    <script>
        async function checkdetails() {
            const userId = document.getElementById("userId").value;
            const response = await fetch('/api/checkDetails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({userId}),
            });
            const data = await response.json();

            if (data && data.length > 0) {
                const userDetails = data[0];
                
                if (userDetails.password == '1') {
                    document.getElementById("password-section").style.display = "block";
                } else {
                    document.getElementById("newPassword").removeAttribute('required');
                }

                if (userDetails.phone == '1') {
                    document.getElementById("phone-section").style.display = "block";
                } else {
                    document.getElementById("newPhone").removeAttribute('required');
                }

                if (userDetails.username == '1') {
                    document.getElementById("username-section").style.display = "block";
                } else {
                    document.getElementById("newUsername").removeAttribute('required');
                }
                if (userDetails.email == '1') {
                    document.getElementById("email-section").style.display = "block";
                } else {
                    document.getElementById("newEmail").removeAttribute('required');
                }

                if (userDetails.password !== '1' && userDetails.phone !== '1' && userDetails.username !== '1' && userDetails.email !== '1') {
                    document.getElementById("popup").style.display = "none";
                } else {
                    document.getElementById("popup").style.display = "block";
                }
                
            } else {
                console.error('No data or unexpected format:', data);
            }
        }

        checkdetails();

        document.getElementById("popup-form").addEventListener("submit", async function (e) {
            e.preventDefault();

            const userId = document.getElementById("userId").value;
            let newUsername = '';
            let newPhone = '';
            let newPassword = '';
            let newEmail = '';

            if (document.getElementById("username-section").style.display !== "none") {
                newUsername = document.getElementById("newUsername").value;
            }

            if (document.getElementById("phone-section").style.display !== "none") {
                newPhone = document.getElementById("newPhone").value;
            }

            if (document.getElementById("password-section").style.display !== "none") {
                newPassword = document.getElementById("newPassword").value;
            }
            if (document.getElementById("email-section").style.display !== "none") {
                newEmail = document.getElementById("newEmail").value;
            }

            const response = await fetch('/api/updateDetails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    'id' : userId,
                    'phone': newPhone,
                    'password': newPassword,
                    'username': newUsername,
                    'email': newEmail,
                }),
            });

            const data = await response.json();

            if (data.success) {
                showToast('Details updated successfully!', 'success');
                document.getElementById("popup").style.display = "none";
                setTimeout(() => {
                    location.reload();
                }, 3000); 
            } else {
                showToast('Failed to update details.', 'error');
            }
        });

        document.getElementById("close-btn").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });

        function showToast(message, type) {
            const toast = document.getElementById("toast");
            const toastMessage = document.getElementById("toast-message");
            
            toastMessage.textContent = message;
            toast.classList.add(type);
            toast.classList.add("show");

            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }

        window.onload = function () {
            gsap.from("#user-card", {
                opacity: 0,
                duration: 1.5,
                y: 50,
                ease: "power3.out"
            });

            gsap.from("#user-info .list-group-item", {
                opacity: 0,
                duration: 1,
                y: 20,
                stagger: 0.3,
                ease: "power3.out"
            });

            gsap.to("#logout-btn", {
                scale: 1.1,
                duration: 0.2,
                ease: "power1.out",
                paused: true,
                repeat: -1,
                yoyo: true
            });

            document.getElementById("user-card").addEventListener("mouseenter", function () {
                gsap.to("#user-card", {
                    scale: 1.05,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            document.getElementById("user-card").addEventListener("mouseleave", function () {
                gsap.to("#user-card", {
                    scale: 1,
                    duration: 0.3,
                    ease: "power2.in"
                });
            });

            gsap.to("#logout-btn", {paused: false});
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
