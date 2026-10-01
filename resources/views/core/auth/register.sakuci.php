@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h1 class="h4 mb-1 fw-bold">Daftar Akun</h1>
                    <p class="text-body-secondary small mb-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>.</p>

                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="username">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 px-3 text-body-secondary">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                    class="form-control border-start-0 ps-2 {{ errors()->has('username') ? 'is-invalid' : '' }}" 
                                    placeholder="Masukkan username" autofocus required>
                                @error('username') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 px-3 text-body-secondary">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" id="password" name="password" 
                                    class="form-control border-start-0 ps-2 {{ errors()->has('password') ? 'is-invalid' : '' }}" 
                                    placeholder="Masukkan password" required>
                                @error('password') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small" for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 px-3 text-body-secondary">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                    class="form-control border-start-0 ps-2" 
                                    placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Pilihan Role -->
                        @if (count($roles) > 1)
                            <div class="mb-4">
                                <label class="form-label fw-semibold small" for="role">Daftar sebagai</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 px-3 text-body-secondary">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <select id="role" name="role" class="form-select border-start-0 ps-2 {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                        @endif

                        <!-- Tombol Submit -->
                        <button class="btn btn-brand w-100 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold" type="submit">
                            <span>Daftar</span>
                            <i class="bi bi-arrow-right-short fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection