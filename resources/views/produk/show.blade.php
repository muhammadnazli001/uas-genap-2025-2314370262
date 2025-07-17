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

<!-- Header -->
<header class="border-b border-gray-200 fixed w-full bg-white z-20 top-0 left-0">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 md:py-4">
    <!-- Logo -->
    <div class="flex-shrink-0">
      <a href="#" aria-label="Home - ZALORA">
        <span class="font-semibold text-xl tracking-wide">NASARA</span>
      </a>
    </div>

    <!-- Search Box -->
    <form class="flex-grow max-w-lg mx-4 md:mx-8 relative" role="search" aria-label="Search products, trends, and brands">
      <input
        type="search"
        placeholder="Cari produk, tren, dan merek."
        class="w-full border border-gray-300 rounded-full py-2 pl-4 pr-10 text-sm focus:border-black focus:ring-1 focus:ring-black focus:outline-none"
        aria-label="Search products, trends, and brands"
      />
      <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-black hover:text-gray-700" aria-label="Submit search">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
      </button>
    </form>

    <!-- User Controls -->
    <div class="flex items-center space-x-6 text-sm font-semibold text-gray-900">
    @if (Route::has('login'))
    <div class="flex items-center gap-4">
        @auth
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('dashboard.admin') }}" class="hover:text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1119.95 6.05a9 9 0 01-14.829 11.753z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Dashboard
        </a>
    @elseif(auth()->user()->role === 'user')
        <a href="{{ route('dashboard.user') }}" class="hover:text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1119.95 6.05a9 9 0 01-14.829 11.753z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Dashboard
        </a>
    @endif
         <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <!-- <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div> -->

           <div class="relative" x-data="{ open: false }">
            <!-- Trigger Icon -->
            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0v.75H4.5v-.75z" />
                </svg>
            </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-cloak @click.away="open = false" x-transition
     class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profile
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

        </div>
        @else
            <a href="{{ route('login') }}" class="hover:text-gray-700 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1119.95 6.05a9 9 0 01-14.829 11.753z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Masuk
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="hover:text-gray-700 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m0 6v1m0 6v1m0-11a3 3 0 110 6 3 3 0 010-6zm0 0v1m0 6v1" />
                    </svg>
                    Daftar
                </a>
            @endif
        @endauth
    </div>
@endif


      <button aria-label="Wishlist" class="hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.682l1.318-1.364a4.5 4.5 0 016.364 6.364L12 21 4.318 13.682a4.5 4.5 0 010-6.364z" />
        </svg>
      </button>

      <button aria-label="Shopping bag" class="hover:text-gray-700 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14l-1.5 12.5a2 2 0 01-2 1.5H8a2 2 0 01-2-1.5L5 8z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 8a5 5 0 0110 0" />
        </svg>
        <span class="absolute -top-1 -right-2 bg-black text-white text-xs rounded-full px-1.5">0</span>
      </button>
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav aria-label="Primary Navigation" class="max-w-7xl mx-auto px-4 border-t border-gray-200">
    <ul class="flex space-x-6 py-3 text-sm font-semibold uppercase tracking-wide text-black">
      <li><a href="{{route('produk.daftar')}}" class="hover:text-gray-600">Semua Produk</a></li>
      <li><a href="#" class="hover:text-gray-600">Pria</a></li>
      <li><a href="#" class="hover:text-gray-600">Sports</a></li>
      <li><a href="#" class="hover:text-gray-600">Anak</a></li>
      <li><a href="{{route('pesanan.riwayat')}}" class="hover:text-gray-600">Riwayat Pesanan</a></li>
      @auth
    @if(auth()->user()->role === 'admin')
        <li><a href="{{ route('kategori.index') }}" class="hover:text-gray-600">Kategori</a></li>
        <li><a href="{{ route('produk.index') }}" class="hover:text-gray-600">Produk</a></li>
    @endif
@endauth

    </ul>
  </nav>
</header>

<main class="mt-[160px] max-w-7xl mx-auto px-4">
<div class="max-w-4xl mx-auto p-4">
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img src="{{ asset($produk->foto) }}" alt="{{ $produk->name }}" class="w-full h-96 object-cover">
    <div class="p-6">
      <h2 class="text-2xl font-bold mb-2">{{ $produk->name }}</h2>
      <p class="text-gray-700 mb-4">{{ $produk->description }}</p>
      <p class="text-xl text-gray-800 font-semibold">Harga: Rp {{ number_format($produk->price, 0, ',', '.') }}</p>
      <p class="mt-2 text-sm text-gray-500">Kategori: {{ $produk->kategori->name ?? '-' }}</p>
      <p class="mt-2 text-sm text-gray-500">Ukuran tersedia: {{ $produk->size ? implode(', ', json_decode($produk->size)) : '-' }}</p>
      <a href="{{ route('checkout', ['produk' => $produk->id]) }}" class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
  Beli Sekarang
</a>


    </div>
  </div>
  
</div>
  </div>
  
</main>
<!-- Modal -->
<div id="orderModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl relative">
    <button onclick="toggleModal()" class="absolute top-2 right-3 text-gray-500 hover:text-black">&times;</button>
    <h2 class="text-xl font-bold mb-4">Form Pemesanan</h2>
    <form method="POST" action="{{ route('pesanan.store') }}">
      @csrf
      <input type="hidden" name="produk_id" value="{{ $produk->id }}">
      <input type="hidden" name="status" value="diproses">
      <input type="hidden" name="pembayaran" value="COD">

      {{-- Pilih Ukuran --}}
      <div class="mb-4">
        <label class="block font-medium mb-1">Pilih Ukuran</label>
        <select name="size" required class="w-full border rounded p-2">
          <option value="" disabled selected>-- Pilih Ukuran --</option>
          @foreach (json_decode($produk->size) as $ukuran)
            <option value="{{ $ukuran }}">{{ $ukuran }}</option>
          @endforeach
        </select>
      </div>

      {{-- Kuantitas --}}
      <div class="mb-4">
        <label class="block font-medium mb-1">Kuantitas</label>
        <input type="number" name="kuantitas" min="1" value="1" required class="w-full border rounded p-2">
      </div>

      {{-- Data Pengiriman --}}
      <div class="mb-4">
        <label class="block font-medium mb-1">Nama Penerima</label>
        <input type="text" name="nama_penerima" required class="w-full border rounded p-2">
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block font-medium mb-1">Negara</label>
          <input type="text" name="negara" required class="w-full border rounded p-2">
        </div>
        <div>
          <label class="block font-medium mb-1">Provinsi</label>
          <input type="text" name="provinsi" required class="w-full border rounded p-2">
        </div>
        <div>
          <label class="block font-medium mb-1">Kota</label>
          <input type="text" name="kota" required class="w-full border rounded p-2">
        </div>
        <div>
          <label class="block font-medium mb-1">Kode Pos</label>
          <input type="text" name="kode_pos" required class="w-full border rounded p-2">
        </div>
      </div>

      <div class="mb-4 mt-2">
        <label class="block font-medium mb-1">Nama Jalan</label>
        <input type="text" name="nama_jalan" required class="w-full border rounded p-2">
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Pesan (opsional)</label>
        <textarea name="pesan" rows="2" class="w-full border rounded p-2"></textarea>
      </div>

      {{-- Kontak --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium mb-1">Email</label>
          <input type="email" name="email" required class="w-full border rounded p-2">
        </div>
        <div>
          <label class="block font-medium mb-1">No HP</label>
          <input type="text" name="no_hp" required class="w-full border rounded p-2">
        </div>
      </div>

      {{-- Submit --}}
      <div class="text-right">
        <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700">Kirim Pesanan</button>
      </div>
    </form>
  </div>
</div>

<!-- Optional Simple Banner Script for Next Button -->
<script>
  // For demonstration: rotate banner images (just one image now, no actual rotation)
  // In a real implementation, you would use multiple images and rotating logic here.
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
  function toggleModal() {
    const modal = document.getElementById('orderModal');
    modal.classList.toggle('hidden');
  }
</script>
<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>

