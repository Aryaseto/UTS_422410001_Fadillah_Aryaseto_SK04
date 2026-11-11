@props([
    'name',
    'label',
    'options' => [],
    'value' => null,
    'placeholder' => null,
    'hint' => null,
    'required' => false,
    'id' => null,
])

@php
    $errorKey = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $inputId = $id ?? 'field-'.str_replace(['[', ']', '.'], '-', $name);
    $current = (string) old($errorKey, $value);
    $hasError = $errors->has($errorKey);
    $hintId = $hint ? $inputId.'-hint' : null;
@endphp

<div>
    <label for="{{ $inputId }}" class="flex items-baseline justify-between gap-3 font-mono text-[11px] font-medium uppercase tracking-[0.13em] text-ink-soft">
        <span>{{ $label }} @if ($required)<span class="text-rust" aria-hidden="true">*</span>@endif</span>
        @if ($required)<span class="text-[10px] normal-case tracking-normal text-ink-faint">wajib</span>@endif
    </label>

    <div class="relative mt-2">
        <select
            id="{{ $inputId }}"
            name="{{ $name }}"
            @if ($required) required @endif
            @if ($hint) aria-describedby="{{ $hintId }}" @endif
            @if ($hasError) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
            {{ $attributes->merge([
                'class' => 'block h-11 w-full appearance-none rounded-[4px] border-2 bg-paper-light py-0 pl-3.5 pr-10 text-sm text-ink transition focus:border-ink focus:outline-none focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-rust '.($hasError ? 'border-rust' : 'border-ink/25'),
            ]) }}
        >
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected($current === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
        <x-icon name="caret-down" class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-soft" />
    </div>

    @if ($hint)
        <p id="{{ $hintId }}" class="mt-1.5 text-xs leading-relaxed text-ink-faint">{{ $hint }}</p>
    @endif

    @error($errorKey)
        <p id="{{ $inputId }}-error" class="mt-1.5 flex items-start gap-1.5 text-xs font-medium text-rust">
            <x-icon name="warning" class="mt-0.5 h-3.5 w-3.5 shrink-0" />
            <span>{{ $message }}</span>
        </p>
    @enderror
</div>
