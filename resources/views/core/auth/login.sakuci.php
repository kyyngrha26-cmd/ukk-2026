@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="row justify-content-center align-items-center my-4">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-sm-5">
                    
                    <!-- Header Form & Logo Icon -->
                    <div class="text-center mb-4">
                        <div class="brand-mark mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px;">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h1 class="h4 fw-bold mb-1">Selamat Datang</h1>
                        <p class="text-secondary small mb-0">Silakan masuk ke akun Anda</p>
                    </div>

                    <!-- Info Demo Account -->
                    <div class="alert alert-light border-0 bg-brand-subtle text-brand small rounded-3 mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill fs-6"></i>
                        <div>
                            Akun demo: <strong>admin</strong> &mdash; password <code class="inline">rahasia123</code>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="username">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary border-end-0">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control border-start-0 ps-0 @error('username') is-invalid @enderror" placeholder="Masukkan username" autofocus>
                                @error('username') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small" for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary border-end-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" id="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="Masukkan password">
                                @error('password') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Login -->
                        <button class="btn btn-brand w-100 py-2 d-flex align-items-center justify-content-center gap-2" type="submit">
                            <span>Masuk</span>
                            <i class="bi bi-arrow-right-short fs-5"></i>
                        </button>
                    </form>

                    <!-- Cek Opsi Register -->
                    @php
                        $canRegister = false;
                        try {
                            $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                        } catch (\Throwable $e) {
                            $canRegister = false;
                        }
                    @endphp

                    @if ($canRegister)
                        <div class="text-center mt-4 pt-2 border-top">
                            <p class="text-secondary small mb-0">
                                Belum punya akun? <a href="{{ route('register') }}" class="text-brand fw-semibold text-decoration-none">Daftar di sini</a>
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection