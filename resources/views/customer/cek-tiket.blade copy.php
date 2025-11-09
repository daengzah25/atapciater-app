<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tiket - Atap Ciater</title>
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
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --success: #28a745;
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        
        .cek-tiket-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .ticket-result {
            margin-top: 2rem;
        }
        
        .ticket-card {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 2rem;
        }
        
        .ticket-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .ticket-id {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .ticket-status {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-menunggu { background: var(--warning); color: #856404; }
        .status-dikonfirmasi { background: var(--info); color: white; }
        .status-dibatalkan { background: var(--danger); color: white; }
        .status-selesai { background: var(--success); color: white; }
        
        .ticket-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
        
        .detail-label {
            font-weight: 500;
        }
        
        .detail-value {
            font-weight: 600;
            text-align: right;
        }
        
        .addon-list {
            margin-top: 1rem;
        }
        
        .addon-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 5px;
            margin-bottom: 0.5rem;
        }
        
        .no-ticket {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: var(--primary);
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
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
                <a href="{{ route('customer.cektiket') }}">Cek Tiket</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="cek-tiket-card">
            <h1 class="page-title">Cek Status Tiket</h1>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.cektiket.proses') }}">
                @csrf
                <div class="form-group">
                    <label for="id_pesanan">Masukkan ID Pesanan (6 digit)</label>
                    <input type="number" id="id_pesanan" name="id_pesanan" value="{{ old('id_pesanan') }}" required min="100000" max="999999" placeholder="Contoh: 123456">
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-search"></i> Cek Status
                </button>
            </form>

            @if(isset($pesanan))
            <div class="ticket-result">
                <div class="ticket-card">
                    <div class="ticket-header">
                        <div class="ticket-id">#{{ $pesanan->id_pesanan }}</div>
                        <span class="ticket-status status-{{ str_replace('_', '-', $pesanan->status) }}">
                            {{ ucwords(str_replace('_', ' ', $pesanan->status)) }}
                        </span>
                    </div>
                    
                    <div class="ticket-details">
                        <div class="detail-item">
                            <span class="detail-label">Nama Pemesan</span>
                            <span class="detail-value">{{ $pesanan->nama_pemesan }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tanggal Booking</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Paket</span>
                            <span class="detail-value">{{ $pesanan->nama_paket }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Metode Bayar</span>
                            <span class="detail-value">{{ $pesanan->metode_bayar == 'dp_50%' ? 'DP 50%' : 'Lunas' }}</span>
                        </div>
                    </div>
                    
                    @if($pesanan->detailPesanan->count() > 0)
                    <div class="addon-list">
                        <h3 style="margin-bottom: 1rem; text-align: center;">Tambahan</h3>
                        @foreach($pesanan->detailPesanan as $detail)
                        <div class="addon-item">
                            <span>{{ $detail->nama_addons }} (x{{ $detail->jumlah }})</span>
                            <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="detail-item" style="margin-top: 1.5rem; background: rgba(255,255,255,0.2);">
                        <span class="detail-label">Total Pembayaran</span>
                        <span class="detail-value" style="font-size: 1.2rem;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <a href="{{ route('customer.cektiket') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Cek Tiket Lainnya
                </a>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Format input ID Pesanan
        document.getElementById('id_pesanan').addEventListener('input', function(e) {
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });
    </script>
</body>
</html>