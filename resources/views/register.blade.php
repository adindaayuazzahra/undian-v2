@extends('layout.web')

@section('navbar')
@include('partials.navbar')
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-center">
    <div class="card p-3 rounded" style="width: 90vw">
        <div class="card-body">
            <form action="{{ route('register.do') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3 position-relative">
                    <label style="font-size:14pt;" for="npp" class="form-label fw-bold">NPP <span
                            class="text-danger">*</span></label>
                    <input autocomplete="off" type="text" class="form-control @error('npp') is-invalid @enderror"
                        name="npp" id="npp" value="{{old('npp')}}">
                    @error('npp')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3 position-relative">
                    <label style="font-size:14pt;" for="nama" class="form-label fw-bold">Nama <span
                            class="text-danger">*</span></label>
                    <input autocomplete="off" type="text" class="form-control @error('nama') is-invalid @enderror"
                        name="nama" id="nama" value="{{old('nama')}}">
                    @error('nama')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3 position-relative">
                    <label style="font-size:14pt;" for="unit" class="form-label fw-bold">Unit Kerja <span
                            class="text-danger">*</span></label>
                    <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit">
                        <option value=""> Pilih Unit </option>
                        <option value="HCGA" {{ old('unit')=='HCGA' ? 'selected' : '' }}>HCGA</option>
                        <option value="AMTD" {{ old('unit')=='AMTD' ? 'selected' : '' }}>AMTD</option>
                        <option value="CPFTA" {{ old('unit')=='CPFTA' ? 'selected' : '' }}>CPFTA</option>
                        <option value="OPS 1" {{ old('unit')=='OPS 1' ? 'selected' : '' }}>OPS 1</option>
                        <option value="OPS 2" {{ old('unit')=='OPS 2' ? 'selected' : '' }}>OPS 2</option>
                        <option value="OPS 3" {{ old('unit')=='OPS 3' ? 'selected' : '' }}>OPS 3</option>
                        <option value="PROCUREMENT" {{ old('unit')=='PROCUREMENT' ? 'selected' : '' }}>PROCUREMENT
                        </option>
                        <option value="AMBD" {{ old('unit')=='AMBD' ? 'selected' : '' }}>AMBD</option>
                    </select>
                    @error('unit')
                    <div class="invalid-tooltip"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 position-relative">
                    <label style="font-size:14pt;" for="passcode" class="form-label fw-bold m-0">Passcode <span
                            class="text-danger">*</span></label>
                    <p class="fw-light fst-italic lh-sm">(*)Passcode terdiri 4 angka acak yang nantinya akan digunakan
                        untuk
                        melihat QrCode Dorprize</p>
                    <input autocomplete="off" type="number" class="form-control @error('passcode') is-invalid @enderror"
                        name="passcode" maxlength="4" id="passcode" value="{{old('passcode')}}">
                    @error('passcode')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Registrasi</button>
                    <a href="{{route('index')}}" class="btn btn-dark">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection