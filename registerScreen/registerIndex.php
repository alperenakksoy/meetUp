<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet"  href="../registerScreen/registerStyle.css">


</head>
<body>
    <header>
        <div class="header-container">
            <div class="header-left">
                <div class="logo"></div>
                <nav>
                    <ul>
                        <li><a href="../homepage/index.html">Home</a></li>
                        <li><a href="../navigations/aboutUs.html">About Us</a></li>
                        <li><a href="../navigations/supportUs.html">Support Us</a></li>
                        <li><a href="../navigations/Safety/safety.html">Safety</a></li>
                        <li><a href="../navigations/howitworks.html">How It Works</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <select>
                    <option>English</option>
                    <option>Turkish</option>
                    <option>Spanish</option>
                    <option>Arabic</option>
                    <option>French</option>
                    <option>Italian</option>
                    <option>German</option>
                </select>
                <a href="../loginScreen/loginIndex.html">
                <button class="login-btn">Log in</button>
              </a>
              <a href="../registerScreen/registerIndex.html">
                <button class="signup-btn">Sign Up</button>
            </a>
            </div>
        </div>
    </header>

    <div class="wrapper">
    <form action="">
        <h1>Register</h1>

        <div class="name">
            <input type="text" placeholder="First Name" required id="fname">
            <input type="text" placeholder="Last Name" required id="lname">
        </div>
            <div class="input-box">
                <input type="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" required>
            </div>

            <div class="input-box duo">
                <input type="date" required>
                <select required>
                    <option value="" disabled selected>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            
            

            <button type="submit" id="loginBtn">Join</button>

            <div class="login-link">
                <p>Have an Account? <a href="../loginScreen/loginIndex.html"> Login</a></p>
            </div>
    </form>
    </div>
<script src="registerApp.js"></script>
</body>
</html>