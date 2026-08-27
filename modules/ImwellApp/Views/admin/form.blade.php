@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="patient-details">
                    <div class="media pc-media-box">
                        <div class="title-heading-icon-box-cus"><i class="fas fa-building"></i></div>
                        <div class="media-body theme-title-box">
                            <h3 class="font-weight-bold">
                                {{ $org->exists ? 'Edit Organization' : 'Create Organization' }}
                            </h3>
                            <div class="theme-btn-cont organization-btn-cont">
                                <a href="{{ route('imwell.admin.index') }}" class="btn-custom">
                                    <i class="fas fa-arrow-left"></i> Back to list
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('ImwellApp::admin.partials.flash')

        <form method="POST"
              action="{{ $org->exists ? route('imwell.admin.update', $org->id) : route('imwell.admin.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- ---------------- Organization details ---------------- --}}
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card card-body">
                        <h4 class="mb-3">Organization details</h4>

                        <div class="form-group">
                            <label>Organization name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="org-name" class="form-control"
                                   value="{{ old('name', $org->name) }}" required
                                   placeholder="e.g. Springfield High School">
                            <small class="text-muted">
                                The member URL is built from this name.
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Member URL</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ url('/org') }}/</span>
                                </div>
                                <input type="text" id="org-slug" class="form-control" readonly
                                       value="{{ $org->slug }}" placeholder="auto-generated from the name">
                            </div>
                            <small class="text-muted">
                                Generated automatically from the organization name.
                                @if($org->exists)
                                    Changing the name will change this URL.
                                @endif
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            {{-- Lightweight self-contained editor: no CDN, no external
                                 dependency, and completely separate from the legacy
                                 CKEditor used on the Corporate screens. --}}
                            <div class="ie-toolbar" role="toolbar" aria-label="Formatting">
                                <button type="button" data-cmd="bold" title="Bold"><b>B</b></button>
                                <button type="button" data-cmd="italic" title="Italic"><i>I</i></button>
                                <button type="button" data-cmd="underline" title="Underline"><u>U</u></button>
                                <span class="ie-sep"></span>
                                <button type="button" data-cmd="formatBlock" data-val="h3" title="Heading">H</button>
                                <button type="button" data-cmd="insertUnorderedList" title="Bulleted list">&bull; List</button>
                                <button type="button" data-cmd="insertOrderedList" title="Numbered list">1. List</button>
                                <span class="ie-sep"></span>
                                <button type="button" data-cmd="createLink" title="Add link">Link</button>
                                <button type="button" data-cmd="removeFormat" title="Clear formatting">Clear</button>
                            </div>
                            <div id="ie-editor" class="ie-editor" contenteditable="true">{!! old('description', $org->description) !!}</div>
                            <textarea name="description" id="ie-editor-input" hidden>{{ old('description', $org->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Contact name</label>
                                <input type="text" name="contact_name" class="form-control"
                                       value="{{ old('contact_name', $org->contact_name) }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Contact email</label>
                                <input type="email" name="contact_email" class="form-control"
                                       value="{{ old('contact_email', $org->contact_email) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Contact phone</label>
                                <input type="text" name="contact_phone" class="form-control"
                                       value="{{ old('contact_phone', $org->contact_phone) }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control"
                                       value="{{ old('address', $org->address) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control"
                                       value="{{ old('city', $org->city) }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control"
                                       value="{{ old('state', $org->state) }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Zip code</label>
                                <input type="text" name="zip_code" class="form-control"
                                       value="{{ old('zip_code', $org->zip_code) }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ---------------- Branding + features ---------------- --}}
                <div class="col-lg-4 grid-margin">
                    <div class="card card-body mb-4">
                        <h4 class="mb-3">Branding</h4>

                        <div class="form-group">
                            <label>Logo</label>
                            <div class="ie-logo-preview" id="ie-logo-preview">
                                @if($org->logoUrl())
                                    <img src="{{ $org->logoUrl() }}" alt="Current logo">
                                @else
                                    <span class="text-muted">No logo uploaded</span>
                                @endif
                            </div>
                            <input type="file" name="logo" id="ie-logo" class="form-control-file mt-2"
                                   accept=".jpg,.jpeg,.png,.svg,.webp">
                            <small class="text-muted">JPG, PNG, SVG or WEBP. Max 2 MB.</small>
                        </div>

                        <div class="form-group">
                            <label>Primary color</label>
                            <input type="color" name="primary_color" class="form-control"
                                   value="{{ old('primary_color', $org->primary_color ?: '#994c8d') }}"
                                   style="height:42px;padding:4px;">
                            <small class="text-muted">Used on the member login screen and app header.</small>
                        </div>

                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <label class="mr-3">
                                <input type="checkbox" name="status" value="1"
                                       {{ old('status', $org->status ?? 1) ? 'checked' : '' }}>
                                Active
                            </label>
                            <small class="text-muted d-block">
                                Inactive organizations cannot be reached at their member URL.
                            </small>
                        </div>
                    </div>

                    <div class="card card-body">
                        <h4 class="mb-1">Enabled features</h4>
                        <p class="text-muted small">
                            Members of this organization can only open the features ticked here.
                            Anything unticked stays inaccessible.
                        </p>

                        @foreach($features as $feature)
                            <label class="d-block mb-2">
                                <input type="checkbox" name="features[]" value="{{ $feature['key'] }}"
                                       {{ in_array($feature['key'], old('features', $enabled), true) ? 'checked' : '' }}>
                                <i class="{{ $feature['icon'] }} ml-1 mr-1"></i>
                                {{ $feature['label'] }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group imwell-form-actions">
                        <button type="submit" class="btn btn-primary mr-3" id="submit">
                            {{ $org->exists ? 'Save Changes' : 'Create Organization' }}
                        </button>

                        @if($org->exists)
                            <a href="{{ route('imwell.admin.import.form', $org->id) }}" class="btn-custom">
                                <i class="fas fa-file-upload" aria-hidden="true"></i> Import Users
                            </a>
                            <a href="{{ route('imwell.admin.import.members', $org->id) }}" class="btn-custom">
                                <i class="fas fa-users" aria-hidden="true"></i> View Members
                            </a>
                            <a href="{{ $org->landingUrl() }}" target="_blank" class="btn-custom">
                                <i class="fas fa-external-link-alt" aria-hidden="true"></i> Open Member URL
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<style>
/* Footer actions on one baseline: the project's btn-custom is an inline <a>
   with its own padding, so without this it sits lower than the submit button
   and wraps onto a second line. */
.imwell-form-actions{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:40px}
.imwell-form-actions .btn,
.imwell-form-actions .btn-custom{margin:0 !important;display:inline-flex;align-items:center;gap:7px;
    line-height:1.2;white-space:nowrap}
.imwell-form-actions .btn-primary{padding:9px 22px}
.imwell-form-actions .btn-custom i{margin:0}

.ie-toolbar{display:flex;flex-wrap:wrap;align-items:center;gap:4px;border:1px solid #dfe3e8;border-bottom:0;
    border-radius:8px 8px 0 0;background:#f8f9fb;padding:8px}
.ie-toolbar button{border:1px solid transparent;background:transparent;border-radius:6px;padding:5px 10px;
    font-size:14px;line-height:1;cursor:pointer;color:#3c4257}
.ie-toolbar button:hover{background:#ececf2;border-color:#dfe3e8}
.ie-toolbar button.is-active{background:#994c8d;color:#fff}
.ie-sep{width:1px;height:18px;background:#dfe3e8;margin:0 4px}
.ie-editor{min-height:190px;border:1px solid #dfe3e8;border-radius:0 0 8px 8px;background:#fff;
    padding:14px 16px;font-size:14px;line-height:1.6;overflow-y:auto;outline:none}
.ie-editor:focus{border-color:#994c8d;box-shadow:0 0 0 3px rgba(153,76,141,.12)}
.ie-editor:empty:before{content:attr(data-placeholder);color:#9aa0ab}
.ie-logo-preview{display:flex;align-items:center;justify-content:center;min-height:96px;border:1px dashed #dfe3e8;
    border-radius:8px;background:#fafbfc;padding:10px}
.ie-logo-preview img{max-height:76px;max-width:100%;object-fit:contain}
</style>

<script>
(function () {
    // ---- Slug follows the organization name -------------------------------
    var nameInput = document.getElementById('org-name');
    var slugInput = document.getElementById('org-slug');
    var orgId     = {{ $org->exists ? $org->id : 'null' }};
    var timer     = null;

    function localSlug(value) {
        return String(value).toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    if (nameInput) {
        nameInput.addEventListener('input', function () {
            slugInput.value = localSlug(nameInput.value);

            // Ask the server for the collision-safe version.
            clearTimeout(timer);
            timer = setTimeout(function () {
                fetch('{{ route('imwell.admin.slug-preview') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: nameInput.value, id: orgId })
                })
                .then(function (r) { return r.json(); })
                .then(function (d) { if (d && d.slug) { slugInput.value = d.slug; } })
                .catch(function () { /* keep the local guess */ });
            }, 350);
        });
    }

    // ---- Logo preview -----------------------------------------------------
    var logoInput   = document.getElementById('ie-logo');
    var logoPreview = document.getElementById('ie-logo-preview');

    if (logoInput) {
        logoInput.addEventListener('change', function () {
            var file = logoInput.files && logoInput.files[0];
            if (!file) { return; }
            var reader = new FileReader();
            reader.onload = function (e) {
                logoPreview.innerHTML = '<img alt="Logo preview">';
                logoPreview.querySelector('img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // ---- Minimal rich text editor ----------------------------------------
    var editor = document.getElementById('ie-editor');
    var hidden = document.getElementById('ie-editor-input');
    var bar    = document.querySelector('.ie-toolbar');

    if (editor && hidden && bar) {
        editor.setAttribute('data-placeholder', 'Describe this organization...');

        function sync() { hidden.value = editor.innerHTML.trim(); }

        bar.addEventListener('click', function (e) {
            var btn = e.target.closest('button[data-cmd]');
            if (!btn) { return; }
            e.preventDefault();

            var cmd = btn.getAttribute('data-cmd');
            var val = btn.getAttribute('data-val') || null;

            if (cmd === 'createLink') {
                var url = window.prompt('Link URL');
                if (!url) { return; }
                val = url;
            }

            editor.focus();
            document.execCommand(cmd, false, val);
            sync();
        });

        // Paste as plain text so pasted markup cannot smuggle styling in.
        editor.addEventListener('paste', function (e) {
            e.preventDefault();
            var text = (e.clipboardData || window.clipboardData).getData('text/plain');
            document.execCommand('insertText', false, text);
        });

        editor.addEventListener('input', sync);
        editor.addEventListener('blur', sync);

        var form = editor.closest('form');
        if (form) { form.addEventListener('submit', sync); }
    }
})();
</script>
@endsection
