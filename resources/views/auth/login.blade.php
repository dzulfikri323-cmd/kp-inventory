<x-guest-layout>

<div
    style="
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:linear-gradient(135deg,#58b7ff,#7c5cff,#ff7aa2);
        padding:20px;
    "
>

    <div
        style="
            width:460px;
            background:#ffffff;
            padding:35px;
            border-radius:24px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        "
    >

        <div style="text-align:center;margin-bottom:25px;">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo"
                style="
                    width:180px;
                    height:auto;
                    display:block;
                    margin:auto;
                "
            >
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom:18px;">
                <label
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                        color:#374151;
                    "
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    style="
                        width:100%;
                        padding:12px 15px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >

                @if ($errors->has('email'))
                    <p
                        style="
                            color:#dc2626;
                            margin-top:8px;
                            font-size:14px;
                        "
                    >
                        Email dan Password salah!
                    </p>
                @endif
            </div>

            <div style="margin-bottom:18px;">
                <label
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                        color:#374151;
                    "
                >
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    style="
                        width:100%;
                        padding:12px 15px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <div style="margin-bottom:20px;">
                <label
                    style="
                        display:flex;
                        align-items:center;
                        gap:8px;
                        color:#4b5563;
                        font-size:14px;
                    "
                >
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                style="
                    width:100%;
                    border:none;
                    color:white;
                    padding:14px;
                    border-radius:12px;
                    font-weight:700;
                    font-size:15px;
                    cursor:pointer;
                    background:linear-gradient(90deg,#58b7ff,#7c5cff,#ff7aa2);
                "
            >
                LOG IN
            </button>

        </form>

    </div>

</div>

</x-guest-layout>