<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Services - User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            max-width: 1000px;
            width: 90%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        h2 {
            grid-column: span 2;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="checkbox"] {
            width: auto;
            margin-top: 0;
        }

        .form-group .password-requirements {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        .submit-btn {
            grid-column: span 2;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .terms {
            grid-column: span 2;
            font-size: 12px;
            color: #555;
        }

        .terms a {
            color: #007bff;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .captcha {
            grid-column: span 2;
            text-align: center;
            margin: 15px 0;
        }

        @media (max-width: 600px) {
            .container {
                grid-template-columns: 1fr; /* Stack inputs on smaller screens */
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Create Your Account</h2>
        <form action="/register" method="post">

            <!-- Personal Information -->
            <div class="form-group">
                <label for="full-name">Full Name *</label>
                <input type="text" id="full-name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
                <p class="password-requirements">
                    Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.
                </p>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password *</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="company">Company Name</label>
                <input type="text" id="company" name="company">
            </div>

            <div class="form-group">
                <label for="website">Website URL</label>
                <input type="url" id="website" name="website">
            </div>

            <div class="form-group">
                <label for="role">Your Role</label>
                <select id="role" name="role">
                    <option value="">Select your role</option>
                    <option value="developer">Developer</option>
                    <option value="cto">CTO</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>

            <div class="form-group">
                <label for="usage">How will you use our API? *</label>
                <select id="usage" name="api_usage" required>
                    <option value="">Select an option</option>
                    <option value="web-application">Web Application</option>
                    <option value="mobile-application">Mobile Application</option>
                    <option value="backend-service">Backend Service</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="usage-volume">Expected API Usage Volume *</label>
                <select id="usage-volume" name="api_usage_volume" required>
                    <option value="">Select a volume</option>
                    <option value="low">Low (1,000 requests per month)</option>
                    <option value="medium">Medium (10,000 requests per month)</option>
                    <option value="high">High (100,000+ requests per month)</option>
                </select>
            </div>

            <!-- API Key Option -->
            <div class="form-group">
                <input type="checkbox" id="generate-key" name="generate_api_key" checked>
                <label for="generate-key">Generate API Key After Registration</label>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-group terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.
                </label>
            </div>

            <!-- CAPTCHA -->
            <div class="captcha">
                <!-- reCAPTCHA Placeholder -->
                <p>[Insert reCAPTCHA here]</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Create Account</button>

        </form>
    </div>

</body>

</html>
