@csrf

<div class="mb-3">
    <label for="id_daop" class="form-label">Daop</label>
    <select name="id_daop" class="form-control" required>
        <option value="">-- Pilih Daop --</option>
        @foreach ($daops as $daop)
            <option value="{{ $daop->id }}" {{ old('id_daop', $stasiun->id_daop ?? '') == $daop->id ? 'selected' : '' }}>
                {{ $daop->nama }}
            </option>
        @endforeach
    </select>
    @error('id_daop') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Singkatan</label>
    <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan', $stasiun->singkatan ?? '') }}" required>
    @error('singkatan') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $stasiun->nama ?? '') }}" required>
    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">DPL</label>
    <input type="number" step="0.01" name="dpl" class="form-control" value="{{ old('dpl', $stasiun->dpl ?? '') }}">
    @error('dpl') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Kode</label>
    <input type="text" name="kode" class="form-control" value="{{ old('kode', $stasiun->kode ?? '') }}">
    @error('kode') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="row">
    @foreach ([
        'aktif' => 'Aktif',
        'kotak' => 'Kotak',
        'garis_tipis' => 'Garis Tipis',
        'garis_tebal' => 'Garis Tebal',
        'perhentian' => 'Perhentian',
        'batas_daop' => 'Batas Daop',
        'ppkt' => 'PPKT'
    ] as $field => $label)
        <div class="col-md-3 mb-3">
            <label class="form-label">{{ $label }}</label>
            <select name="{{ $field }}" class="form-control">
                <option value="0" {{ old($field, $stasiun->$field ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ old($field, $stasiun->$field ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
            </select>
            @error($field) <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    @endforeach
</div>

<div class="mb-3">
    <label class="form-label">Track</label>
    <input type="text" name="track" class="form-control" value="{{ old('track', $stasiun->track ?? '') }}">
    @error('track') <small class="text-danger">{{ $message }}</small> @enderror
</div>
