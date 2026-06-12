@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/materials.css') }}">
@endsection

@section('content')
<h1>新しい材料を追加</h1>

<div class="form-container">
    <form action="{{ route('materials.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">材料名 <span class="required">*</span></label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="例: 塩、砂糖、小麦粉"
                required
                class="form-input">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="unit">単位 <span class="required">*</span></label>
            <input
                type="text"
                id="unit"
                name="unit"
                value="{{ old('unit') }}"
                placeholder="例: g, ml, 個, kg"
                required
                class="form-input">
            @error('unit')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">✅ 作成</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>
</div>

<div style="margin-top: 30px;">
    <a href="{{ route('index') }}" class="btn btn-secondary">← トップに戻る</a>
</div>

@endsection