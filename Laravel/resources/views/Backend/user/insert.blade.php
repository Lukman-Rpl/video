@extends('Backend.back')

@section('admincontent')
<div class="row">
    <div class="col-6">
        <form action="{{ url('admin/user') }}" method="POST">
            @csrf




            <div class="mt-2">
                <label class="form-label" for="">Level</label>
                <select class="form-select" name="level" id="">
                    <option value="manager">manager</option>
                    <option value="kasir">kasir</option>
                    <option value="admin">admin</option>
                </select>
            </div>

            <div class="mt-2">
                <label class="form-label" for="">Nama</label>
                <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-2">
                <label class="form-label" for="">Password</label>
                <input class="form-control" value="{{ old('password') }}" type="password" name="password" id="">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div class="mt-4">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>


        </form>
    </div>
</div>
@endsection