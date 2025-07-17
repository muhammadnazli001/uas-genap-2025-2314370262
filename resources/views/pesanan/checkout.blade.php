<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>NASARA - Easy, Effortless Style</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
        /* Custom styles for ribbons and overlays */
        .ribbon {
      position: absolute;
      top: 8px;
      left: 8px;
      background: #fbbf24; /* yellow-400 */
      color: #000;
      font-weight: 600;
      font-size: 0.85rem;
      padding: 0.15rem 0.5rem;
      border-radius: 0.375rem;
      display: flex;
      align-items: center;
      gap: 0.15rem;
      user-select: none;
    }
    .ad-label {
      position: absolute;
      top: 8px;
      right: 8px;
      background-color: #e5e7eb; /* gray-200 */
      color: #6b7280; /* gray-500 */
      font-weight: 600;
      font-size: 0.75rem;
      padding: 0.15rem 0.5rem;
      border-radius: 0.375rem;
      user-select: none;
    }
    .badge-popular {
      position: absolute;
      top: 40px;
      right: 8px;
      background-color: #3b82f6; /* blue-500 */
      color: white;
      font-weight: 600;
      font-size: 0.7rem;
      padding: 0.15rem 0.5rem;
      border-radius: 9999px;
      user-select: none;
      white-space: nowrap;
    }
    .discount-banner {
      background: rgba(0, 0, 0, 0.8);
      color: white;
      font-size: 0.75rem;
      padding: 0.2rem 0.4rem;
      border-radius: 0 0 0.375rem 0.375rem;
      user-select: none;
      text-align: center;
      font-weight: 600;
      letter-spacing: 0.02em;
    }
    .price-old {
      text-decoration: line-through;
      color: #6b7280;
      margin-left: 0.25rem;
      font-size: 0.85rem;
    }
    .price-current {
      font-weight: 700;
      color: #dc2626; /* red-600 */
      font-size: 1.15rem;
    }
    .vip-label {
      background-color: #2563eb; /* blue-600 */
      color: white;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 0.1rem 0.4rem;
      border-radius: 0.3rem;
      margin-left: 0.3rem;
      user-select: none;
    }
    .star-icon {
      fill: #fbbf24; /* yellow-400 */
    }
  /* Custom scroll bar for horizontal slider */
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  [x-cloak] { display: none !important; }
</style>
</head>
<body class="bg-white font-sans text-gray-900">
<main class="max-w-6xl mx-auto mt-12 px-4">

    <h1 class="text-2xl font-bold mb-6">Checkout Produk</h1>

    <form action="{{ route('pesanan.store') }}" method="POST" class="grid md:grid-cols-2 gap-8">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">

        {{-- KIRI: FORM PEMBELI --}}
        <div class="bg-white p-6 rounded shadow">
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 font-medium">Nama Penerima</label>
                    <input type="text" name="nama_penerima" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">No HP</label>
                    <input type="text" name="no_hp" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Negara</label>
                    <input type="text" name="negara" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Provinsi</label>
                    <input type="text" name="provinsi" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Kota</label>
                    <input type="text" name="kota" class="w-full border rounded p-2" required>
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Nama Jalan</label>
                    <input type="text" name="nama_jalan" class="w-full border rounded p-2" required>
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Kode Pos</label>
                    <input type="text" name="kode_pos" class="w-full border rounded p-2" required>
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Pesan (Opsional)</label>
                    <textarea name="pesan" class="w-full border rounded p-2"></textarea>
                </div>
            </div>

            <p class="text-sm text-gray-600 mb-4">Metode Pembayaran: <strong>COD (Bayar di Tempat)</strong></p>

            <button type="submit" id="btn-konfirmasi" class="px-6 py-3 bg-green-600 text-white font-semibold rounded border border-green-600 hover:bg-green-700 transition">
                Konfirmasi Pesanan
            </button>

        </div>

        {{-- KANAN: DETAIL PRODUK --}}
        <div class="bg-white p-6 rounded shadow space-y-4">
        @if ($produk->foto)
        <img src="{{ asset($produk->foto) }}" alt="{{ $produk->name }}" class="w-48 h-48 object-cover rounded-lg">

        @else
            <p class="text-gray-500 italic">Gambar tidak tersedia</p>
        @endif


            <div>
                <h2 class="text-xl font-bold">{{ $produk->name }}</h2>
                <p class="text-gray-600 mb-1">Harga: Rp {{ number_format($produk->price, 0, ',', '.') }}</p>
                <p class="text-gray-800">{{ $produk->description }}</p>
            </div>

           
            <div class="mb-4">
                <label class="block mb-1 font-medium">Pilih Ukuran</label>
                <select name="size" required class="w-full border rounded p-2">
                    @foreach (json_decode($produk->size) as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Kuantitas</label>
                <input type="number" id="kuantitas" name="kuantitas" value="1" min="1" class="w-full border rounded p-2" required>
            </div>


            <div class="border-t pt-4">
                <p class="font-semibold">Kuantitas: <span id="previewKuantitas">1</span></p>
                <p class="font-semibold">* Subtotal: <span id="subtotal"></span></p>
            </div>

        </div>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const price = {{ $produk->price }}; // harga satuan
        const kuantitasInput = document.getElementById('kuantitas');
        const subtotalEl = document.getElementById('subtotal');
        const previewQty = document.getElementById('previewKuantitas');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function updateSubtotal() {
            const qty = parseInt(kuantitasInput.value) || 1;
            const subtotal = price * qty;

            previewQty.textContent = qty;
            subtotalEl.textContent = `${formatRupiah(price)} x ${qty} = ${formatRupiah(subtotal)}`;
        }

        kuantitasInput.addEventListener('input', updateSubtotal);
        updateSubtotal(); // jalankan saat awal halaman dimuat
    });


  const bannerImages = [
    {
      src: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0a490647-2f0d-4860-a284-2a2b421c9f37.png",
      alt: "3 stylish Asian young adults featuring modern casual fashion posing in a studio with smooth gradient background from white to black, conveying easy and effortless style"
    },
    {
      src: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/9f0b275f-e795-46dc-8849-ef0756d14056.png",
      alt: "Urban streetwear fashion trends 2024 showing diverse models posing confidently on city street background"
    }
  ];

  let currentIndex = 0;
  const bannerImageElement = document.querySelector('main section img');
  const nextBtn = document.getElementById('nextBannerBtn');

  nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % bannerImages.length;
    const {src, alt} = bannerImages[currentIndex];
    bannerImageElement.src = src;
    bannerImageElement.alt = alt;
  });

  
</script>
<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>

