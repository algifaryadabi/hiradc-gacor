<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Dokumen Risiko - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Header */
        .page-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
        }

        .btn-back {
            width: 44px;
            height: 44px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateX(-4px);
        }

        .page-title h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .page-title p {
            font-size: 14px;
            color: #718096;
        }

        /* Progress Steps */
        .progress-steps {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .steps-container::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #a0aec0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .step.completed .step-number {
            background: #48bb78;
            color: white;
        }

        .step-label {
            font-size: 13px;
            color: #718096;
            text-align: center;
        }

        .step.active .step-label {
            color: #667eea;
            font-weight: 600;
        }

        /* Form Sections */
        .form-section {
            background: white;
            padding: 32px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f7fafc;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .section-title h2 {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .section-title p {
            font-size: 13px;
            color: #718096;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .required {
            color: #f56565;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Document Type Pills */
        .type-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .type-option {
            position: relative;
        }

        .type-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .type-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .type-option input[type="radio"]:checked + .type-label {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        }

        .type-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .type-icon.ko { background: #bee3f8; }
        .type-icon.k3 { background: #fbd38d; }
        .type-icon.lingkungan { background: #9ae6b4; }
        .type-icon.keamanan { background: #fbb6ce; }

        .type-text h4 {
            font-size: 15px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .type-text p {
            font-size: 12px;
            color: #718096;
        }

        /* Risk Assessment Sliders */
        .slider-group {
            margin-bottom: 24px;
        }

        .slider-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .slider-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
        }

        .slider-value {
            font-size: 18px;
            font-weight: 700;
            color: #667eea;
            min-width: 40px;
            text-align: right;
        }

        .slider {
            width: 100%;
            height: 8px;
            border-radius: 4px;
            background: #e2e8f0;
            outline: none;
            -webkit-appearance: none;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }

        .slider::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
            border: none;
        }

        .slider-scale {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 12px;
            color: #a0aec0;
        }

        /* Risk Level Display */
        .risk-level-display {
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-top: 24px;
        }

        .risk-level-display.low {
            background: #c6f6d5;
            color: #22543d;
        }

        .risk-level-display.medium {
            background: #feebc8;
            color: #7c2d12;
        }

        .risk-level-display.high {
            background: #fed7d7;
            color: #742a2a;
        }

        .risk-level-display h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .risk-level-display p {
            font-size: 24px;
            font-weight: 700;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
        }

        .btn {
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'Inter', sans-serif;
        }

        .btn-secondary {
            background: white;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            border-color: #cbd5e0;
            background: #f7fafc;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5);
        }

        /* Help Text */
        .help-text {
            font-size: 13px;
            color: #718096;
            margin-top: 6px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .type-selector {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <a href="{{ route('user.dashboard') }}" class="btn-back">←</a>
            <div class="page-title">
                <h1>Buat Dokumen Risiko Baru</h1>
                <p>Lengkapi formulir di bawah untuk membuat dokumen penilaian risiko</p>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="steps-container">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-label">Pilih Jenis</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-label">Data Umum</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Penilaian Risiko</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-label">Pengendalian</div>
                </div>
            </div>
        </div>

        <form action="{{ route('documents.store') }}" method="POST" id="riskForm">
            @csrf

            <!-- Section 1: Informasi Dokumen -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">📋</div>
                    <div class="section-title">
                        <h2>Informasi Dokumen</h2>
                        <p>Informasi dasar tentang dokumen risiko</p>
                    </div>
                </div>

                <div class="form-group">
                    <label>Jenis Dokumen <span class="required">*</span></label>
                    <div class="type-selector">
                        <div class="type-option">
                            <input type="radio" name="document_type" id="type-ko" value="KO" required>
                            <label for="type-ko" class="type-label">
                                <div class="type-icon ko">🏭</div>
                                <div class="type-text">
                                    <h4>KO</h4>
                                    <p>Keselamatan Operasional</p>
                                </div>
                            </label>
                        </div>
                        <div class="type-option">
                            <input type="radio" name="document_type" id="type-k3" value="K3">
                            <label for="type-k3" class="type-label">
                                <div class="type-icon k3">⚠️</div>
                                <div class="type-text">
                                    <h4>K3</h4>
                                    <p>Kesehatan & Keselamatan Kerja</p>
                                </div>
                            </label>
                        </div>
                        <div class="type-option">
                            <input type="radio" name="document_type" id="type-lingkungan" value="Lingkungan">
                            <label for="type-lingkungan" class="type-label">
                                <div class="type-icon lingkungan">🌱</div>
                                <div class="type-text">
                                    <h4>Lingkungan</h4>
                                    <p>Dampak Lingkungan</p>
                                </div>
                            </label>
                        </div>
                        <div class="type-option">
                            <input type="radio" name="document_type" id="type-keamanan" value="Keamanan">
                            <label for="type-keamanan" class="type-label">
                                <div class="type-icon keamanan">🔒</div>
                                <div class="type-text">
                                    <h4>Keamanan</h4>
                                    <p>Keamanan & Proteksi</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Judul Dokumen <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Contoh: Penilaian Risiko Penggunaan Mesin Produksi" required>
                    <p class="help-text">Berikan judul yang jelas dan deskriptif</p>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Jelaskan konteks dan tujuan dari penilaian risiko ini..."></textarea>
                </div>
            </div>

            <!-- Section 2: Identifikasi Bahaya -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">⚠️</div>
                    <div class="section-title">
                        <h2>Identifikasi Bahaya</h2>
                        <p>Identifikasi sumber bahaya dan dampak potensial</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hazard_source">Sumber Risiko <span class="required">*</span></label>
                    <input type="text" id="hazard_source" name="hazard_source" class="form-control" placeholder="Contoh: Mesin produksi, Bahan kimia, Proses kerja" required>
                </div>

                <div class="form-group">
                    <label for="hazard_identification">Bahaya yang Teridentifikasi <span class="required">*</span></label>
                    <textarea id="hazard_identification" name="hazard_identification" class="form-control" placeholder="Jelaskan bahaya yang teridentifikasi secara detail..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="potential_impact">Dampak Potensial <span class="required">*</span></label>
                    <textarea id="potential_impact" name="potential_impact" class="form-control" placeholder="Jelaskan dampak yang mungkin terjadi jika risiko terealisasi..." required></textarea>
                </div>
            </div>

            <!-- Section 3: Penilaian Risiko -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">📊</div>
                    <div class="section-title">
                        <h2>Penilaian Risiko</h2>
                        <p>Tentukan tingkat kemungkinan dan keparahan risiko</p>
                    </div>
                </div>

                <div class="slider-group">
                    <div class="slider-header">
                        <span class="slider-label">Skor Kemungkinan (Likelihood)</span>
                        <span class="slider-value" id="likelihood-value">3</span>
                    </div>
                    <input type="range" min="1" max="5" value="3" class="slider" id="likelihood" name="likelihood" oninput="updateRiskLevel()">
                    <div class="slider-scale">
                        <span>1 - Sangat Jarang</span>
                        <span>2 - Jarang</span>
                        <span>3 - Mungkin</span>
                        <span>4 - Sering</span>
                        <span>5 - Sangat Sering</span>
                    </div>
                </div>

                <div class="slider-group">
                    <div class="slider-header">
                        <span class="slider-label">Skor Keparahan (Severity)</span>
                        <span class="slider-value" id="severity-value">3</span>
                    </div>
                    <input type="range" min="1" max="5" value="3" class="slider" id="severity" name="severity" oninput="updateRiskLevel()">
                    <div class="slider-scale">
                        <span>1 - Tidak Signifikan</span>
                        <span>2 - Minor</span>
                        <span>3 - Sedang</span>
                        <span>4 - Mayor</span>
                        <span>5 - Katastropik</span>
                    </div>
                </div>

                <div class="risk-level-display medium" id="risk-display">
                    <h3>Tingkat Risiko</h3>
                    <p id="risk-level-text">SEDANG (9)</p>
                </div>
            </div>

            <!-- Section 4: Pengendalian -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">🛡️</div>
                    <div class="section-title">
                        <h2>Tindakan Pengendalian</h2>
                        <p>Tentukan langkah-langkah untuk mengendalikan risiko</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="control_measures">Tindakan Pengendalian <span class="required">*</span></label>
                    <textarea id="control_measures" name="control_measures" class="form-control" placeholder="Jelaskan tindakan pengendalian yang akan diterapkan..." required></textarea>
                    <p class="help-text">Contoh: Penggunaan APD, Pelatihan, Prosedur kerja, dll.</p>
                </div>

                <div class="form-group">
                    <label for="residual_risk">Risiko Sisa (Setelah Pengendalian)</label>
                    <textarea id="residual_risk" name="residual_risk" class="form-control" placeholder="Jelaskan risiko yang masih tersisa setelah pengendalian diterapkan..."></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="saveDraft()">💾 Simpan Draft</button>
                <button type="submit" class="btn btn-primary">📤 Kirim untuk Review</button>
            </div>
        </form>
    </div>

    <script>
        // Update slider values
        document.getElementById('likelihood').addEventListener('input', function() {
            document.getElementById('likelihood-value').textContent = this.value;
        });

        document.getElementById('severity').addEventListener('input', function() {
            document.getElementById('severity-value').textContent = this.value;
        });

        // Calculate and update risk level
        function updateRiskLevel() {
            const likelihood = parseInt(document.getElementById('likelihood').value);
            const severity = parseInt(document.getElementById('severity').value);
            const riskScore = likelihood * severity;
            
            const display = document.getElementById('risk-display');
            const levelText = document.getElementById('risk-level-text');
            
            // Remove all classes
            display.classList.remove('low', 'medium', 'high');
            
            // Determine risk level
            let level, levelName;
            if (riskScore <= 6) {
                level = 'low';
                levelName = 'RENDAH';
            } else if (riskScore <= 15) {
                level = 'medium';
                levelName = 'SEDANG';
            } else {
                level = 'high';
                levelName = 'TINGGI';
            }
            
            display.classList.add(level);
            levelText.textContent = `${levelName} (${riskScore})`;
        }

        // Save as draft
        function saveDraft() {
            const form = document.getElementById('riskForm');
            const formData = new FormData(form);
            formData.append('status', 'draft');
            
            // Send AJAX request to save draft
            fetch('{{ route("documents.save-draft") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                alert('Draft berhasil disimpan!');
            })
            .catch(error => {
                alert('Gagal menyimpan draft');
            });
        }

        // Initialize risk level on page load
        updateRiskLevel();
    </script>
</body>
</html>
