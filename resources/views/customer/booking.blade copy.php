<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text: #333333;
            --border: #e0e0e0;
            --error: #d32f2f;
            --success: #388e3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text);
            line-height: 1.6;
        }

        .navbar {
            background-color: var(--primary);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .breadcrumb {
            margin-bottom: 2rem;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .booking-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .section-title {
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .paket-info {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .paket-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .paket-price {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .addon-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .addon-info {
            flex: 1;
        }

        .addon-name {
            font-weight: 500;
        }

        .addon-price {
            color: var(--primary);
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-input {
            width: 50px;
            text-align: center;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .payment-option {
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option.selected {
            border-color: var(--primary);
            background-color: rgba(46, 125, 50, 0.05);
        }

        .total-section {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .total-final {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary);
            border-top: 1px solid var(--border);
            padding-top: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-primary:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .payment-methods {
                grid-template-columns: 1fr;
            }

            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                gap: 1rem;
            }
        }

        .bank-info {
            margin-bottom: 2rem;
        }

        .bank-card {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        .bank-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bank-header i {
            font-size: 2rem;
        }

        .bank-name {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .bank-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .bank-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .bank-label {
            font-weight: 500;
            min-width: 150px;
        }

        .bank-value {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            flex: 1;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .copy-btn.copied {
            background: #4caf50;
            border-color: #4caf50;
        }

        .bank-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 1rem;
            color: #856404;
        }

        .bank-notice i {
            color: #856404;
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .bank-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .bank-value {
                font-size: 0.9rem;
            }

            .copy-btn {
                align-self: stretch;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('landing.page') }}" class="logo">
                <i class="fas fa-mountain"></i> Atap Ciater
            </a>
            <div class="nav-links">
                <a href="{{ route('landing.page') }}">Beranda</a>
                <a href="{{ route('customer.paket') }}">Paket</a>
                <a href="#">Kontak</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('customer.paket') }}"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Paket</a>
        </div>

        <div class="booking-card">
            <h2 class="section-title">Form Booking</h2>

            <div class="paket-info">
                <div class="paket-name">{{ $paket->nama_paket }}</div>
                <div class="paket-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
            </div>

            <form id="bookingForm" action="{{ route('customer.booking.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_paket" value="{{ $paket->id_paket }}">
                <input type="hidden" name="harga_paket" value="{{ $paket->harga }}">
                <input type="hidden" name="nama_paket" value="{{ $paket->nama_paket }}">

                <!-- Tambahkan ini untuk JavaScript -->
                <input type="hidden" id="harga_paket_value" value="{{ $paket->harga }}">

                <div class="form-group">
                    <label for="nama_pemesan">Nama Pemesan *</label>
                    <input type="text" id="nama_pemesan" name="nama_pemesan" required>
                </div>

                <div class="form-group">
                    <label for="no_wa">Nomor WhatsApp *</label>
                    <input type="tel" id="no_wa" name="no_wa" required placeholder="Contoh: 081234567890">
                </div>

                <div class="form-group">
                    <label for="tanggal_booking">Tanggal Booking *</label>
                    <select id="tanggal_booking" name="tanggal_booking" required>
                        <option value="">Pilih Tanggal</option>
                        @foreach($slots as $slot)
                        <option value="{{ $slot->tanggal }}" data-slot-tersedia="{{ $slot->slot_tersedia }}">
                            {{ \Carbon\Carbon::parse($slot->tanggal)->format('d F Y') }} (Tersedia: {{ $slot->slot_tersedia }} slot)
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Ada alergi makanan, dll."></textarea>
                </div>

                <h3 class="section-title">Tambahan (Opsional)</h3>

                <div id="addons-container">
                    @foreach($addons as $addon)
                    <div class="addon-item" data-addon-id="{{ $addon->id_addons }}" data-addon-price="{{ $addon->harga }}" data-addon-stock="{{ $addon->stok }}">
                        <div class="addon-info">
                            <div class="addon-name">{{ $addon->nama_addons }}</div>
                            <div class="addon-price">Rp {{ number_format($addon->harga, 0, ',', '.') }} / unit</div>
                        </div>
                        <div class="quantity-controls">
                            <button type="button" class="qty-btn minus" data-addon-id="{{ $addon->id_addons }}">-</button>
                            <input type="number" class="qty-input" id="qty-{{ $addon->id_addons }}"
                                name="addons[{{ $addon->id_addons }}]" value="0" min="0" max="{{ $addon->stok }}" readonly>
                            <button type="button" class="qty-btn plus" data-addon-id="{{ $addon->id_addons }}">+</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h3 class="section-title">Metode Pembayaran</h3>

                <div class="payment-methods">
                    <div class="payment-option" data-method="dp_50%">
                        <input type="radio" id="dp" name="metode_bayar" value="dp_50%" class="hidden">
                        <label for="dp" style="cursor: pointer;">
                            <strong>DP 50%</strong><br>
                            Bayar 50% sekarang
                        </label>
                    </div>
                    <div class="payment-option" data-method="lunas">
                        <input type="radio" id="lunas" name="metode_bayar" value="lunas" class="hidden">
                        <label for="lunas" style="cursor: pointer;">
                            <strong>Lunas</strong><br>
                            Bayar 100% sekarang
                        </label>
                    </div>
                </div>

                <!-- Tambahkan setelah section Metode Pembayaran -->
                <h3 class="section-title">Informasi Pembayaran</h3>

                <div class="bank-info">
                    <div class="bank-card">
                        <div class="bank-header">
                            <i class="fas fa-university"></i>
                            <div class="bank-name">Bank BCA</div>
                        </div>
                        <div class="bank-details">
                            <div class="bank-item">
                                <span class="bank-label">Nomor Rekening:</span>
                                <span class="bank-value">1234 5678 9012</span>
                                <button class="copy-btn" data-text="123456789012">
                                    <i class="fas fa-copy"></i> Salin
                                </button>
                            </div>
                            <div class="bank-item">
                                <span class="bank-label">Atas Nama:</span>
                                <span class="bank-value">ATAP CIATER OFFICIAL</span>
                                <!-- <button class="copy-btn" data-text="ATAP CIATER OFFICIAL">
                                    <i class="fas fa-copy"></i> Salin
                                </button> -->
                            </div>
                        </div>
                    </div>

                    <div class="bank-notice">
                        <p><i class="fas fa-info-circle"></i> <strong>Penting:</strong> Harap transfer sesuai dengan total pembayaran yang tertera di bawah. Simpan bukti transfer untuk diupload.</p>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-line">
                        <span>Harga Paket:</span>
                        <span id="display-harga-paket">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-line">
                        <span>Tambahan:</span>
                        <span id="display-tambahan">Rp 0</span>
                    </div>
                    <div class="total-line total-final">
                        <span>Total Pembayaran:</span>
                        <span id="display-total">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="screenshot">Upload Bukti Pembayaran *</label>
                    <input type="file" id="screenshot" name="screenshot" accept="image/*" required>
                    <small>Format: JPG, PNG (Maks. 2MB)</small>
                </div>

                <button type="submit" class="btn-primary" id="submit-btn">
                    <i class="fas fa-paper-plane"></i> Konfirmasi Booking
                </button>
            </form>
        </div>
    </div>

    <script>
        // Data harga paket dari hidden input
        const hargaPaket = parseInt(document.getElementById('harga_paket_value').value);

        // Variabel untuk perhitungan
        let totalTambahan = 0;
        let totalBayar = hargaPaket;

        // Elemen untuk display
        const displayTambahan = document.getElementById('display-tambahan');
        const displayTotal = document.getElementById('display-total');
        const submitBtn = document.getElementById('submit-btn');

        // Format Rupiah
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Update display
        function updateDisplay() {
            displayTambahan.textContent = 'Rp ' + formatRupiah(totalTambahan);
            displayTotal.textContent = 'Rp ' + formatRupiah(totalBayar);
        }

        // Quantity controls
        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const addonId = this.getAttribute('data-addon-id');
                const input = document.getElementById('qty-' + addonId);
                let value = parseInt(input.value);

                // Dapatkan harga dari data attribute
                const addonItem = document.querySelector(`[data-addon-id="${addonId}"]`);
                const addonPrice = parseInt(addonItem.getAttribute('data-addon-price'));

                if (this.classList.contains('plus')) {
                    if (value < parseInt(input.max)) {
                        value++;
                    }
                } else if (this.classList.contains('minus')) {
                    if (value > 0) {
                        value--;
                    }
                }

                input.value = value;

                // Update perhitungan
                calculateTotal();
            });
        });

        // Payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });

                // Add selected class to clicked option
                this.classList.add('selected');

                // Check the radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;

                // Update perhitungan
                calculateTotal();
            });
        });

        // Calculate total
        function calculateTotal() {
            totalTambahan = 0;

            // Hitung total addons dari data attributes
            document.querySelectorAll('.addon-item').forEach(item => {
                const addonId = item.getAttribute('data-addon-id');
                const addonPrice = parseInt(item.getAttribute('data-addon-price'));
                const input = document.getElementById('qty-' + addonId);
                const quantity = parseInt(input.value);

                totalTambahan += quantity * addonPrice;
            });

            // Hitung total bayar berdasarkan metode pembayaran
            const selectedPayment = document.querySelector('input[name="metode_bayar"]:checked');
            if (selectedPayment) {
                if (selectedPayment.value === 'dp_50%') {
                    totalBayar = Math.floor((hargaPaket + totalTambahan) * 0.5);
                } else {
                    totalBayar = hargaPaket + totalTambahan;
                }
            } else {
                totalBayar = hargaPaket + totalTambahan;
            }

            updateDisplay();
        }

        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi dasar
            const namaPemesan = document.getElementById('nama_pemesan').value;
            const noWa = document.getElementById('no_wa').value;
            const tanggalBooking = document.getElementById('tanggal_booking').value;
            const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
            const screenshot = document.getElementById('screenshot').files[0];

            if (!namaPemesan || !noWa || !tanggalBooking || !metodeBayar || !screenshot) {
                alert('Harap lengkapi semua field yang wajib diisi!');
                return;
            }

            // Validasi format nomor WhatsApp
            const waRegex = /^[0-9]{10,13}$/;
            if (!waRegex.test(noWa.replace(/[^0-9]/g, ''))) {
                alert('Format nomor WhatsApp tidak valid!');
                return;
            }

            // Validasi ukuran file
            if (screenshot.size > 2 * 1024 * 1024) { // 2MB
                alert('Ukuran file maksimal 2MB!');
                return;
            }

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // Submit form
            this.submit();
        });



        // Initialize display
        updateDisplay();

        // Copy to clipboard function
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-text');

                // Menggunakan Clipboard API
                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Ubah tampilan tombol sementara
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                    this.classList.add('copied');

                    // Kembalikan ke keadaan semula setelah 2 detik
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('copied');
                    }, 2000);
                }).catch(err => {
                    // Fallback untuk browser lama
                    const textArea = document.createElement('textarea');
                    textArea.value = textToCopy;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);

                    // Ubah tampilan tombol sementara
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                    this.classList.add('copied');

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('copied');
                    }, 2000);
                });
            });
        });
    </script>
</body>

</html>