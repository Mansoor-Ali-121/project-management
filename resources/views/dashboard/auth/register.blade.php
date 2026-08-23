<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register · Executive Command Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: radial-gradient(circle at 20% 30%, #0e0c14, #030303 90%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* floating particles / orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
            animation: floatDrift 16s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: #d4af37;
            top: -10%;
            left: -8%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 450px;
            height: 450px;
            background: #b8860b;
            bottom: -12%;
            right: -6%;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: #f1c40f;
            top: 50%;
            left: 60%;
            animation-delay: -10s;
            opacity: 0.2;
        }

        @keyframes floatDrift {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(20px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(10px, -10px) scale(1.05);
            }
        }

        /* main card wrapper — double border glow */
        .card-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 720px;
            padding: 4px;
            border-radius: 32px;
            background: linear-gradient(145deg, #d4af37, #7a5f1a, #d4af37, #b8860b);
            background-size: 300% 300%;
            animation: shimmerBorder 8s ease-in-out infinite;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), 0 0 0 1px rgba(212, 175, 55, 0.2) inset;
        }

        @keyframes shimmerBorder {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            background: #0b0d12;
            backdrop-filter: blur(2px);
            border: none;
            border-radius: 28px;
            padding: 2rem 2.2rem;
            color: #e5e9f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .brand-icon svg {
            filter: drop-shadow(0 0 8px #d4af37);
        }

        h3 {
            font-weight: 700;
            letter-spacing: 3px;
            color: #d4af37;
            text-transform: uppercase;
            font-size: 1.6rem;
            text-shadow: 0 0 18px rgba(212, 175, 55, 0.3);
            margin-bottom: 1.2rem;
        }

        .form-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #9aa3b8;
            margin-bottom: 4px;
        }

        .form-control,
        .form-select {
            background: rgba(18, 22, 30, 0.85);
            border: 1px solid #2b3142;
            color: #f0f3fa;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            backdrop-filter: blur(4px);
        }

        .form-control:focus,
        .form-select:focus {
            background: #131823;
            border-color: #d4af37;
            outline: none;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15), 0 0 20px rgba(212, 175, 55, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: #6f788e;
            font-weight: 300;
            font-size: 0.85rem;
        }

        .form-select option {
            background: #0b0d12;
            color: #e5e9f0;
        }

        /* premium button — liquid shine */
        .btn-gold {
            position: relative;
            background: transparent;
            color: #d4af37;
            font-weight: 700;
            letter-spacing: 2px;
            border: 2px solid #d4af37;
            border-radius: 50px;
            padding: 14px 20px;
            transition: all 0.3s ease;
            overflow: hidden;
            z-index: 1;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, #d4af37, #f1c40f, #d4af37);
            z-index: -1;
            transition: left 0.45s cubic-bezier(0.65, 0, 0.35, 1);
            border-radius: 50px;
        }

        .btn-gold:hover::before {
            left: 0;
        }

        .btn-gold:hover {
            color: #0b0d12;
            border-color: #f1c40f;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.4);
            transform: scale(1.01);
        }

        .btn-gold:active {
            transform: scale(0.97);
        }

        /* subtle link */
        .login-link {
            color: #b9c2d9;
            transition: 0.2s;
            font-weight: 400;
            border-bottom: 1px solid transparent;
        }

        .login-link:hover {
            color: #d4af37;
            border-bottom-color: #d4af37;
            text-shadow: 0 0 6px #d4af3750;
        }

        .text-muted-custom {
            color: #7b849e;
        }

        /* file input style override */
        input[type="file"]::file-selector-button {
            background: #1e2332;
            border: 1px solid #3d445b;
            color: #d4af37;
            padding: 6px 16px;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background: #2f364a;
            border-color: #d4af37;
        }

        /* responsive */
        @media (max-width: 576px) {
            .card {
                padding: 1.5rem 1rem;
            }

            h3 {
                font-size: 1.3rem;
            }

            .orb-1,
            .orb-2 {
                width: 250px;
                height: 250px;
            }
        }

        /* small decorative line */
        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af3760, #d4af37, #d4af3760, transparent);
            margin: 0.5rem 0 1.5rem 0;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- background orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="card-wrapper">
        <div class="card">

            <div class="brand-icon">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#d4af37"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5" />
                    <path d="M2 12l10 5 10-5" />
                </svg>
                <span style="font-size: 1rem; font-weight: 300; letter-spacing: 4px; color: #b9c2d9;">EXECUTIVE</span>
            </div>

            <h3 class="text-center">✦ REGISTER ✦</h3>
            <div class="divider"></div>

            <!-- Dynamic Error Box (Form ke top par errors dikhane ke liye) -->
            <div id="form-error-container" class="alert alert-danger d-none mb-3"
                style="background-color: rgba(139, 0, 0, 0.2); border: 1px solid #ff4d4d; color: #ffb3b3; border-radius: 14px;">
                <ul id="error-list" class="mb-0 ps-3"></ul>
            </div>

            {{-- Server-side validation errors (agar page reload ho jaye) --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-3"
                    style="background-color: rgba(139, 0, 0, 0.2); border: 1px solid #ff4d4d; color: #ffb3b3; border-radius: 14px;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full name</label>
                        <input type="text" name="name" class="form-control" placeholder="Mansoor Ali" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com"
                            required>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone number</label>
                        <input type="text" name="phone" class="form-control" placeholder="+92 300 1234567">
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="Rawalpindi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Skills</label>
                        <input type="text" name="skills" class="form-control" placeholder="Laravel, Vue, PHP">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Profile picture</label>
                    <input type="file" name="profile_picture" class="form-control" style="padding-top: 8px;">
                </div>

                <button type="submit" class="btn btn-gold w-100 mt-4 mb-3">
                    ⚡ Authorize &amp; Register
                </button>

                <div class="text-center">
                    <small class="text-muted-custom">Already have clearance?
                        <a href="{{ route('login') }}" class="login-link">Login here</a>
                    </small>
                </div>
            </form>

        </div>
    </div>

    <!-- Script for AJAX Fetch API Submission -->
    <script>
        document.querySelector('form').addEventListener('submit', async function(e) {
            e.preventDefault(); // Page reload rokne ke liye

            const form = this;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const errorContainer = document.getElementById('form-error-container');
            const errorList = document.getElementById('error-list');

            // Purane errors hide aur clear kar dein
            errorContainer.classList.add('d-none');
            errorList.innerHTML = '';

            // Button text temporary disable aur loading state ke liye
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⚡ Processing...';
            submitBtn.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Success hone par seedha redirect karein
                    window.location.href = "{{ route('login') }}";
                } else {
                    // Errors ko form ke top par show karna
                    if (result.errors) {
                        Object.values(result.errors).flat().forEach(err => {
                            const li = document.createElement('li');
                            li.textContent = err;
                            errorList.appendChild(li);
                        });
                    } else {
                        const li = document.createElement('li');
                        li.textContent = result.message || 'Something went wrong!';
                        errorList.appendChild(li);
                    }

                    errorContainer.classList.remove('d-none'); // Error box visible kar dein
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                const li = document.createElement('li');
                li.textContent = 'An unexpected error occurred. Please try again.';
                errorList.appendChild(li);
                errorContainer.classList.remove('d-none');

                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    </script>
</body>

</html>
