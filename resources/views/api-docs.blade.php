<!DOCTYPE html>
<html lang="en" class="scroll-pt-20">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Chat API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }

        pre, code {
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            z-index: 50;
        }

        .main-content {
            margin-left: 280px;
            max-width: 1400px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nav-group-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 24px 0 8px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            font-size: 0.875rem;
            color: #4b5563;
            border-radius: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        .nav-link.active {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }

        .badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            min-width: 45px;
            text-align: center;
        }

        .post {
            background: #dbeafe;
            color: #1e40af;
        }

        .get {
            background: #d1fae5;
            color: #065f46;
        }

        .put {
            background: #fef3c7;
            color: #92400e;
        }

        .patch {
            background: #fff7ed;
            color: #c2410c;
        }

        .delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .api-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 60px 40px;
            border-bottom: 1px solid #e5e7eb;
        }

        .api-code {
            position: sticky;
            top: 40px;
            align-self: start;
        }

        .param-table {
            width: 100%;
            font-size: 0.875rem;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .param-table td {
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            vertical-align: top;
        }

        .param-name {
            font-family: 'JetBrains Mono', monospace;
            color: #2563eb;
            font-weight: 500;
        }

        .param-type {
            font-size: 0.75rem;
            color: #9ca3af;
            font-family: 'JetBrains Mono', monospace;
        }

        .req {
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 4px;
        }

        .code-window {
            background: #0f172a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid #1e293b;
            margin-bottom: 20px;
        }

        .code-header {
            background: #1e293b;
            padding: 10px 16px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #334155;
        }

        .code-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .code-body {
            padding: 20px;
            overflow-x: auto;
            color: #e2e8f0;
            font-size: 0.8125rem;
            line-height: 1.6;
        }

        .auth-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            margin-right: 8px;
            margin-bottom: 1rem;
        }

        .auth-sanctum {
            background: #374151;
            color: white;
        }

        .auth-verified {
            background: #059669;
            color: white;
        }

        .j-key {
            color: #7dd3fc;
        }

        .j-str {
            color: #a5f3fc;
        }

        .j-num {
            color: #fcd34d;
        }

        .j-bool {
            color: #f9a8d4;
        }

        .j-null {
            color: #94a3b8;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .api-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="lg:hidden sticky top-0 bg-white border-b z-40 px-4 py-3 flex justify-between items-center">
    <span class="font-bold text-lg">Chat API</span>
    <button onclick="toggleMenu()" class="text-gray-500"><i class="fa-solid fa-bars fa-lg"></i></button>
</div>

<aside id="sidebar" class="sidebar">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">C</div>
            <div>
                <h1 class="font-bold text-gray-900 text-sm">Real-time Chat API</h1>
                <p class="text-xs text-gray-500">Documentation</p>
            </div>
        </div>
    </div>

    <nav class="p-4 text-xs">
        <div class="nav-group-title">Overview</div>
        <a href="#intro" class="nav-link active"><i class="fa-solid fa-book w-5 text-center"></i> Introduction</a>

        <div class="nav-group-title">Authentication</div>
        <a href="#register" class="nav-link"><span class="badge post">POST</span> Register</a>
        <a href="#login" class="nav-link"><span class="badge post">POST</span> Login</a>
        <a href="#forgot-password" class="nav-link"><span class="badge post">POST</span> Forgot Password</a>
        <a href="#reset-password" class="nav-link"><span class="badge post">POST</span> Reset Password</a>

        <div class="nav-group-title">Account Management</div>
        <a href="#user-me" class="nav-link"><span class="badge get">GET</span> Current User</a>
        <a href="#logout" class="nav-link"><span class="badge post">POST</span> Logout</a>
        <a href="#resend-verify" class="nav-link"><span class="badge post">POST</span> Resend Verify</a>
        <a href="#verify-email" class="nav-link"><span class="badge get">GET</span> Verify Email</a>
        <a href="#delete-account" class="nav-link"><span class="badge delete">DEL</span> Delete Account</a>

        <div class="nav-group-title">Profile (Verified)</div>
        <a href="#update-profile" class="nav-link"><span class="badge patch">PTCH</span> Update Profile</a>
        <a href="#update-password" class="nav-link"><span class="badge patch">PTCH</span> Update Password</a>

        <div class="nav-group-title">Search (Verified)</div>
        <a href="#search-users" class="nav-link"><span class="badge get">GET</span> Search Users</a>
        <a href="#user-status" class="nav-link"><span class="badge get">GET</span> User Status</a>
        <a href="#search-groups" class="nav-link"><span class="badge get">GET</span> Search Groups</a>

        <div class="nav-group-title">Conversations (Verified)</div>
        <a href="#conv-list" class="nav-link"><span class="badge get">GET</span> List All</a>
        <a href="#conv-create" class="nav-link"><span class="badge post">POST</span> Create</a>
        <a href="#conv-show" class="nav-link"><span class="badge get">GET</span> Show</a>
        <a href="#conv-add" class="nav-link"><span class="badge post">POST</span> Add User</a>
        <a href="#conv-remove" class="nav-link"><span class="badge post">POST</span> Remove User</a>
        <a href="#conv-leave" class="nav-link"><span class="badge post">POST</span> Leave Group</a>
        <a href="#conv-delete" class="nav-link"><span class="badge delete">DEL</span> Delete</a>

        <div class="nav-group-title">Messages (Verified)</div>
        <a href="#msg-list" class="nav-link"><span class="badge get">GET</span> Get Messages</a>
        <a href="#msg-send" class="nav-link"><span class="badge post">POST</span> Send Message</a>
        <a href="#msg-read" class="nav-link"><span class="badge patch">PTCH</span> Read Message</a>
        <a href="#msg-delete" class="nav-link"><span class="badge delete">DEL</span> Delete Message</a>

        <div class="nav-group-title">Real-time</div>
        <a href="#broadcasting" class="nav-link"><i class="fa-solid fa-tower-broadcast w-5"></i> Broadcasting</a>
    </nav>
</aside>

<main class="main-content">

    <section id="intro" class="api-section">
        <div class="api-details">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Introduction</h1>
            <p class="text-gray-600 leading-relaxed mb-6">
                Welcome to the Real-time Chat API. This documentation covers all endpoints for authentication, user
                management, and messaging features.
            </p>

            <div class="flex flex-wrap gap-3 mb-8">
                <a href="https://github.com/yuldoshewuz/real-time-chat-api" target="_blank"
                   class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-800 transition-all shadow-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GitHub
                </a>
                <a href="https://yuldoshew.uz" target="_blank"
                   class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:border-indigo-500 hover:text-indigo-600 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Developer
                </a>
            </div>

            <div class="mb-8 p-5 bg-indigo-50 border border-indigo-100 rounded-xl shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-1.5 bg-indigo-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-indigo-900 uppercase tracking-tight">Demo Accounts</h3>
                </div>

                <p class="text-xs text-indigo-700/80 mb-4 leading-relaxed">
                    After running <code class="bg-indigo-200/50 px-1 rounded text-indigo-800 font-bold">php artisan
                        migrate --seed</code>,
                    you can use these pre-defined accounts to test the API permissions and features.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-white/60 p-4 rounded-lg border border-indigo-200/50 hover:bg-white transition-colors">
                        <div class="space-y-1">
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Email:</span> <span
                                    class="font-bold">user@example.com</span>
                            </p>
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Pass:</span> <span class="font-bold italic text-indigo-600">password</span>
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white/60 p-4 rounded-lg border border-indigo-200/50 hover:bg-white transition-colors">
                        <div class="space-y-1">
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Email:</span> <span
                                    class="font-bold">user2@example.com</span>
                            </p>
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Pass:</span> <span class="font-bold italic text-indigo-600">password</span>
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white/60 p-4 rounded-lg border border-indigo-200/50 hover:bg-white transition-colors">
                        <div class="space-y-1">
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Email:</span> <span
                                    class="font-bold">user3@example.com</span>
                            </p>
                            <p class="text-[13px] font-mono text-gray-700 flex justify-between">
                                <span class="text-gray-400">Pass:</span> <span class="font-bold italic text-indigo-600">password</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-bold text-blue-800 mb-1">Base URL</h3>
                <code class="text-blue-600 font-mono text-sm tracking-tight">{{ url('/api') }}</code>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <h3 class="text-sm font-bold text-gray-800 mb-2">Authentication & Verification</h3>
                <p class="text-sm text-gray-600 mb-2">This API uses Laravel Sanctum for authentication.</p>
                <div class="flex gap-2 flex-wrap">
                    <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH: SANCTUM</span>
                    <span class="text-xs text-gray-500 self-center">Requires Bearer Token</span>
                </div>
                <div class="flex gap-2 flex-wrap mt-2">
                    <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
                    <span class="text-xs text-gray-500 self-center">Requires Email Verification Account</span>
                </div>
            </div>
        </div>
    </section>

    <section id="register" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Register</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/register</code>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">name</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">201</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User registered successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"user"</span>: { <span class="j-key">"id"</span>: <span class="j-num">4</span>, <span
                            class="j-key">"name"</span>: <span class="j-str">"Test"</span>, <span
                            class="j-key">"email"</span>: <span class="j-str">"test@example.com"</span> },
    <span class="j-key">"access_token"</span>: <span class="j-str">"1|hVX5q..."</span>,
    <span class="j-key">"token_type"</span>: <span class="j-str">"Bearer"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="login" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Login</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/login</code>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Logged in successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"user"</span>: { <span class="j-key">"id"</span>: <span class="j-num">4</span>, <span
                            class="j-key">"email"</span>: <span class="j-str">"test@example.com"</span> },
    <span class="j-key">"access_token"</span>: <span class="j-str">"2|3EnW..."</span>,
    <span class="j-key">"token_type"</span>: <span class="j-str">"Bearer"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="forgot-password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Forgot Password</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/forgot-password</code>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"We have emailed your password reset link."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="reset-password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Reset Password</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/reset-password</code>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">token</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">email</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Your password has been reset."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="user-me" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">Current User</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/user/me</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User profile retrieved"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">4</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"Test"</span>,
    <span class="j-key">"email"</span>: <span class="j-str">"test@example.com"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="logout" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Logout</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/logout</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Successfully logged out"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="resend-verify" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Resend Verification</h2></div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/email/verification-notification</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Verification link sent."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="verify-email" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">Verify Email</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/auth/email/verify/{id}/{hash}</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Email verified successfully."</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="delete-account" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold">Delete Account</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/user/delete</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Account deleted successfully"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="update-profile" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge patch">PATCH</span>
                <h2 class="text-2xl font-bold">Update Profile</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/user/update</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">name</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">email</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Profile updated successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">4</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"New Name"</span>,
    <span class="j-key">"email"</span>: <span class="j-str">"new@example.com"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="update-password" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge patch">PATCH</span>
                <h2 class="text-2xl font-bold">Update Password</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/user/password/update</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">current_password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">password_confirmation</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Password updated successfully"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="search-users" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">User Search</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/users/search?q={query}</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">q</span><span class="req">*</span></td>
                    <td><span class="param-type">query</span></td>
                    <td>Search term</td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"3 user(s) found"</span>,
  <span class="j-key">"data"</span>: [
    { <span class="j-key">"id"</span>: <span class="j-num">1</span>, <span class="j-key">"name"</span>: <span
                            class="j-str">"Marjory"</span>, <span class="j-key">"email"</span>: <span class="j-str">"user@example.com"</span> },
    { <span class="j-key">"id"</span>: <span class="j-num">2</span>, <span class="j-key">"name"</span>: <span
                            class="j-str">"Rosemary"</span>, <span class="j-key">"email"</span>: <span class="j-str">"user2@example.com"</span> }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="user-status" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">User Status</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/users/{user_id}/status</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User status retrieved"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">5</span>,
    <span class="j-key">"email_verified"</span>: <span class="j-bool">true</span>,
    <span class="j-key">"created_at"</span>: <span class="j-str">"2026-01-31 17:45:40"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="search-groups" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">Group Search</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/groups/search?q={query}</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Public groups retrieved successfully"</span>,
  <span class="j-key">"data"</span>: [
    {
      <span class="j-key">"id"</span>: <span class="j-num">1</span>,
      <span class="j-key">"name"</span>: <span class="j-str">"New Group"</span>,
      <span class="j-key">"type"</span>: <span class="j-str">"group"</span>,
      <span class="j-key">"users_count"</span>: <span class="j-num">1</span>
    }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">List Conversations</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"data"</span>: [
    {
      <span class="j-key">"id"</span>: <span class="j-num">2</span>,
      <span class="j-key">"name"</span>: <span class="j-str">"My Friend"</span>,
      <span class="j-key">"type"</span>: <span class="j-str">"private"</span>,
      <span class="j-key">"unread_count"</span>: <span class="j-num">0</span>,
      <span class="j-key">"users"</span>: [ ... ]
    }
  ]
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-create" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Create Conversation</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">type</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>'private' or 'group'</td>
                </tr>
                <tr>
                    <td><span class="param-name">name</span></td>
                    <td><span class="param-type">string</span></td>
                    <td>Group name</td>
                </tr>
                <tr>
                    <td><span class="param-name">user_id</span></td>
                    <td><span class="param-type">int</span></td>
                    <td>Required if private</td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created (Group)</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Conversation created successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"New Group"</span>,
    <span class="j-key">"type"</span>: <span class="j-str">"group"</span>
  }
}</pre>
                </div>
            </div>
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created (Private)</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Conversation created successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">2</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"My Friend"</span>,
    <span class="j-key">"type"</span>: <span class="j-str">"private"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-show" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">Show Conversation</h2></div>
            <code
                class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/show?conversation_id={id}</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Conversation details retrieved"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"name"</span>: <span class="j-str">"New Group"</span>,
    <span class="j-key">"type"</span>: <span class="j-str">"group"</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-add" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Add Participant</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/add-participant</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">conversation_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">user_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"User added successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"users"</span>: [ ... ]
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-remove" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Remove Participant</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/remove-participant</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">conversation_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">user_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Participant removed successfully"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-leave" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Leave Group</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/leave</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">conversation_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"You left the group"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="conv-delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold">Delete Conversation</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/delete</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">conversation_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Conversation deleted"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="msg-list" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge get">GET</span>
                <h2 class="text-2xl font-bold">Get Messages</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/conversations/{id}/messages</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Messages retrieved successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"data"</span>: [
      {
        <span class="j-key">"id"</span>: <span class="j-num">1</span>,
        <span class="j-key">"text"</span>: <span class="j-str">"hi"</span>,
        <span class="j-key">"user_id"</span>: <span class="j-num">5</span>,
        <span class="j-key">"read_at"</span>: <span class="j-null">null</span>
      }
    ],
    <span class="j-key">"total"</span>: <span class="j-num">1</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="msg-send" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge post">POST</span>
                <h2 class="text-2xl font-bold">Send Message</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/messages</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
            <table class="param-table">
                <tr>
                    <td><span class="param-name">conversation_id</span><span class="req">*</span></td>
                    <td><span class="param-type">int</span></td>
                </tr>
                <tr>
                    <td><span class="param-name">text</span><span class="req">*</span></td>
                    <td><span class="param-type">string</span></td>
                </tr>
            </table>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">201 Created</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">201</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Message sent successfully"</span>,
  <span class="j-key">"data"</span>: {
    <span class="j-key">"id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"text"</span>: <span class="j-str">"hi"</span>,
    <span class="j-key">"conversation_id"</span>: <span class="j-num">1</span>,
    <span class="j-key">"user_id"</span>: <span class="j-num">5</span>
  }
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="msg-read" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge patch">PATCH</span>
                <h2 class="text-2xl font-bold">Read Message</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/messages/{id}/read</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Message marked as read"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="msg-delete" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-4"><span class="badge delete">DELETE</span>
                <h2 class="text-2xl font-bold">Delete Message</h2></div>
            <code class="block bg-gray-100 p-2 rounded text-sm mb-6 font-mono">/messages/{id}</code>
            <span class="auth-badge auth-sanctum"><i class="fa-solid fa-lock mr-2"></i>AUTH REQUIRED</span>
            <span class="auth-badge auth-verified"><i class="fa-solid fa-check-circle mr-2"></i>VERIFIED</span>
        </div>
        <div class="api-code">
            <div class="code-window">
                <div class="code-header"><span class="code-title text-emerald-400">200 OK</span></div>
                <div class="code-body"><pre>{
  <span class="j-key">"status"</span>: <span class="j-str">"success"</span>,
  <span class="j-key">"status_code"</span>: <span class="j-num">200</span>,
  <span class="j-key">"message"</span>: <span class="j-str">"Message deleted successfully"</span>,
  <span class="j-key">"data"</span>: <span class="j-null">null</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <section id="broadcasting" class="api-section">
        <div class="api-details">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                    <i class="fa-solid fa-tower-broadcast text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Broadcasting</h2>
                    <p class="text-xs text-indigo-600 font-bold uppercase tracking-widest">Example for Frontend</p>
                </div>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                This application uses <strong>Pusher</strong> to broadcast server-side events to the frontend.
                All connections require <strong>Bearer Token</strong> authentication via the built-in <code>/broadcasting/auth</code>
                endpoint.
            </p>

            <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase">How it works:</h3>
            <div class="space-y-4 mb-10">
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold border border-indigo-200">
                            1
                        </div>
                        <div class="w-px h-full bg-gray-200 my-1"></div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Authentication</h4>
                        <p class="text-xs text-gray-500">Client connects to Pusher and requests auth for private
                            channels using the Bearer Token.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold border border-indigo-200">
                            2
                        </div>
                        <div class="w-px h-full bg-gray-200 my-1"></div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Subscription</h4>
                        <p class="text-xs text-gray-500">Client subscribes to specific channels (e.g.,
                            <code>chat.15</code>) to listen for events.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold border border-emerald-200">
                            3
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Event Execution</h4>
                        <p class="text-xs text-gray-500">When a message is sent via API, the server broadcasts an event,
                            and the client receives the payload instantly.</p>
                    </div>
                </div>
            </div>

            <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase">Available Channels</h3>
            <div class="overflow-hidden border border-gray-100 rounded-xl">
                <table class="w-full text-left border-collapse bg-white">
                    <thead class="bg-slate-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-xs font-bold text-slate-500">Channel Name</th>
                        <th class="p-3 text-xs font-bold text-slate-500">Event Class</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm">
                    <tr class="border-b border-gray-50">
                        <td class="p-3"><code class="text-pink-600 font-bold">chat.{id}</code></td>
                        <td class="p-3 font-medium text-slate-700">MessageSent, MessageRead</td>
                    </tr>
                    <tr class="border-b border-gray-50">
                        <td class="p-3"><code class="text-pink-600 font-bold">App.Models.User.{id}</code></td>
                        <td class="p-3 font-medium text-slate-700">ConversationCreated</td>
                    </tr>
                    <tr>
                        <td class="p-3"><code class="text-emerald-600 font-bold">online</code></td>
                        <td class="p-3 font-medium text-slate-700 text-xs italic">Presence (User list)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="api-code">
            <div class="code-window">
                <div class="code-header">
                    <div class="flex gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                    </div>
                    <span class="code-title">bootstrap.js / echo-config</span>
                </div>
                <div class="code-body">
<pre class="text-xs leading-relaxed"><span class="j-key">import</span> Echo <span class="j-key">from</span> <span
        class="j-str">'laravel-echo'</span>;
<span class="j-key">window</span>.Pusher = <span class="j-key">require</span>(<span class="j-str">'pusher-js'</span>);

<span class="j-key">window</span>.Echo = <span class="j-key">new</span> Echo({
    broadcaster: <span class="j-str">'pusher'</span>,
    key: <span class="j-str">'PUSHER_APP_KEY'</span>,
    cluster: <span class="j-str">'YOUR_CLUSTER'</span>,
    forceTLS: <span class="j-bool">true</span>,
    authEndpoint: <span class="j-str">'/api/broadcasting/auth'</span>,
    auth: {
        headers: {
            Authorization: <span class="j-str">'Bearer '</span> + token
        }
    }
});</pre>
                </div>
            </div>

            <div class="code-window mt-6 border-t-4 border-indigo-500">
                <div class="code-header">
                    <span class="code-title text-indigo-400">Listening to Events</span>
                </div>
                <div class="code-body">
<pre class="text-xs leading-relaxed">
<span class="j-null">// 1. Listen for new messages in a chat</span>
<span class="j-key">window</span>.Echo.private(<span class="j-str">`chat.<span class="j-num">${convId}</span>`</span>)
    .listen(<span class="j-str">'MessageSent'</span>, (e) => {
        console.log(<span class="j-str">"New Message:"</span>, e.text);
        <span class="j-null">// Payload: {id, text, user: {id, name}, created_at}</span>
    })
    .listen(<span class="j-str">'MessageRead'</span>, (e) => {
        <span class="j-null">// Update UI read status</span>
        console.log(<span class="j-str">"Message ID "</span> + e.message_id + <span class="j-str">" was read"</span>);
    });

<span class="j-null">// 2. Listen for new conversations (on User channel)</span>
<span class="j-key">window</span>.Echo.private(<span class="j-str">`App.Models.User.<span class="j-num">${userId}</span>`</span>)
    .listen(<span class="j-str">'ConversationCreated'</span>, (e) => {
        <span class="j-null">// Add new chat item to sidebar</span>
        console.log(<span class="j-str">"New conversation with:"</span>, e.name);
    });</pre>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-12 border-t border-gray-200 text-gray-400 text-sm mt-auto">
        <div class="flex flex-col items-center gap-3">
            <p>Real-time Chat API &copy; {{ date('Y') }}</p>

            <div class="flex items-center gap-4 text-xs tracking-wide">
                <a href="https://github.com/yuldoshewuz/real-time-chat-api" target="_blank"
                   class="hover:text-gray-900 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GITHUB
                </a>
                <span class="text-gray-200">|</span>
                <a href="https://yuldoshew.uz" target="_blank"
                   class="hover:text-indigo-500 transition-colors uppercase">
                    Developer
                </a>
            </div>
        </div>
    </footer>

</main>
<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('open');
    }

    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= sectionTop - 120) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
