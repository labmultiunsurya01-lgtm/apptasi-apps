@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Galeri</h1>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-600">*</span></label>
                    <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 @error('title') border-red-500 @enderror" value="{{ old('title', $gallery->title) }}" required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi <span class="text-red-600">*</span></label>
                    <textarea id="description" name="description" class="w-full @error('description') border-red-500 @enderror" required>{{ old('description', $gallery->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2"><i class="fas fa-info-circle mr-1"></i>Gunakan toolbar untuk format teks. Maximal 2000 karakter.</p>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar</label>
                    
                    {{-- Current Image --}}
                    @if ($gallery->image)
                        <div id="currentImageContainer" class="mb-4 bg-gray-100 rounded-lg p-4">
                            <p class="text-sm text-gray-600 mb-2 font-semibold">Gambar Saat Ini:</p>
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full max-h-96 object-contain rounded-lg">
                            <button type="button" id="changeImageBtn" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-edit mr-1"></i>Ganti Gambar
                            </button>
                        </div>
                    @endif

                    {{-- File Input with Drag & Drop --}}
                    <div id="imageDropZone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-teal-500 transition @error('image') border-red-500 @enderror {{ $gallery->image ? 'hidden' : '' }}">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-600 font-semibold mb-1">Drag dan drop gambar di sini atau klik untuk memilih</p>
                        <p class="text-gray-500 text-sm mb-3">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        <p class="text-teal-600 text-sm font-semibold">Rekomendasi: 800x600 px atau lebih</p>
                        <p class="text-gray-500 text-sm mt-2">Biarkan kosong jika tidak ingin mengubah</p>
                        <input type="file" id="image" name="image" class="hidden" accept="image/*">
                    </div>
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Image Preview --}}
                    <div id="imagePreviewContainer" class="mt-4 hidden">
                        <div class="bg-gray-100 rounded-lg p-4">
                            <p class="text-sm text-gray-600 mb-2 font-semibold">Preview Gambar Baru:</p>
                            <img id="imagePreview" src="" alt="Preview" class="w-full max-h-96 object-contain rounded-lg">
                            <div id="imageDimensions" class="text-sm text-gray-600 mt-2"></div>
                            <button type="button" id="removeImageBtn" class="mt-3 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-trash mr-1"></i>Hapus Gambar Baru
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="icon" class="block text-gray-700 font-semibold mb-2">Ikon FontAwesome <span class="text-red-600">*</span></label>
                    <input type="text" id="icon" name="icon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 @error('icon') border-red-500 @enderror" value="{{ old('icon', $gallery->icon) }}" required>
                    <p class="text-gray-500 text-sm mt-1">Contoh: fa-image, fa-video, fa-users, fa-certificate, dll</p>
                    @error('icon')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-gray-700 font-semibold mb-2">Urutan</label>
                    <input type="number" id="order" name="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 @error('order') border-red-500 @enderror" value="{{ old('order', $gallery->order) }}" min="0">
                    @error('order')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="w-4 h-4" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 font-semibold">Aktif</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
// Initialize TinyMCE Editor
tinymce.init({
    selector: '#description',
    plugins: 'lists link image code help wordcount align paste',
    toolbar: 'undo redo | formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor | bullist numlist | link image | alignleft aligncenter alignright alignjustify | removeformat | code | help',
    toolbar_sticky: true,
    height: 350,
    menubar: false,
    branding: false,
    statusbar: true,
    font_formats: 'Segoe UI=Segoe UI,-apple-system,BlinkMacSystemFont,Roboto,sans-serif;Arial=arial,helvetica,sans-serif;Times New Roman=times new roman,times,serif;Courier New=courier new,courier,monospace;Georgia=georgia,serif;Trebuchet MS=trebuchet ms,sans-serif;Verdana=verdana,geneva,sans-serif',
    fontsize_formats: '12px 14px 16px 18px 20px 22px 24px 28px 32px',
    content_css: 'default',
    body_class: 'mceContentBody',
    content_style: `
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 15px;
            line-height: 1.8;
            color: #333;
        }
        p {
            margin: 0 0 1em 0;
            padding: 0;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0.5em 0;
            font-weight: 600;
        }
        ul, ol {
            margin: 1em 0;
            padding-left: 2em;
        }
        li {
            margin: 0.5em 0;
        }
        a {
            color: #0891b2;
            text-decoration: underline;
        }
        strong, b {
            font-weight: 600;
        }
    `,
    setup: function(editor) {
        editor.on('change', function() {
            editor.save();
        });
    },
    placeholder: 'Tulis deskripsi kegiatan di sini... Gunakan toolbar untuk formatting!',
    max_chars: 2000,
    paste_as_text: false,
    paste_data_images: true,
});

document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imageDropZone = document.getElementById('imageDropZone');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const imageDimensions = document.getElementById('imageDimensions');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const changeImageBtn = document.getElementById('changeImageBtn');
    const currentImageContainer = document.getElementById('currentImageContainer');

    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', (e) => {
            e.preventDefault();
            currentImageContainer.classList.add('hidden');
            imageDropZone.classList.remove('hidden');
        });
    }

    // Click to select file
    imageDropZone.addEventListener('click', () => imageInput.click());

    // Drag and drop
    imageDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageDropZone.classList.add('border-teal-500', 'bg-teal-50');
    });

    imageDropZone.addEventListener('dragleave', () => {
        imageDropZone.classList.remove('border-teal-500', 'bg-teal-50');
    });

    imageDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        imageDropZone.classList.remove('border-teal-500', 'bg-teal-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImagePreview();
        }
    });

    // File input change
    imageInput.addEventListener('change', handleImagePreview);

    // Remove image
    removeImageBtn.addEventListener('click', (e) => {
        e.preventDefault();
        imageInput.value = '';
        imagePreviewContainer.classList.add('hidden');
        if (currentImageContainer) {
            currentImageContainer.classList.remove('hidden');
        } else {
            imageDropZone.classList.remove('hidden');
        }
    });

    function handleImagePreview() {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                
                const img = new Image();
                img.onload = function() {
                    imageDimensions.innerHTML = `<strong>Dimensi:</strong> ${img.width} x ${img.height} px | <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB`;
                };
                img.src = e.target.result;
                
                imagePreviewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
@endsection
