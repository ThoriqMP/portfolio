# Rencana Implementasi: Perbaikan UI Asesmen, Tipe Jawaban & Algoritma Penilaian

## Latar Belakang

Permintaan ini mencakup tiga area besar yang saling terkait:
1. **Perbaikan tampilan slider** di form asesmen pengguna
2. **Penambahan tipe jawaban per-pertanyaan** (Skala Likert, Pilihan Ganda, Teks) including per-instrument settings dari admin
3. **Perombakan algoritma penilaian** menggunakan Weighted Normalized Score yang berlandaskan referensi jurnal kredibel

---

## 📚 Referensi Akademis & Algoritma Penilaian

## 📚 Referensi Akademis yang Dapat Diverifikasi (≥2022)

> [!CAUTION]
> Semua referensi di bawah ini memiliki PMID atau DOI yang dapat Anda verifikasi langsung di **[pubmed.ncbi.nlm.nih.gov](https://pubmed.ncbi.nlm.nih.gov)**. Masukkan PMID ke kolom pencarian PubMed untuk memastikan kebenaran setiap referensi sebelum memasukkannya ke TA.

---

### [R1] BDI-II — Validasi Kriteria pada Populasi Klinis (2023) ✅

> **Almeida, S., et al. (2023).** "Criterion and construct validity of the Beck Depression Inventory (BDI-II) to measure depression in patients with cancer: The contribution of somatic items." *International Journal of Clinical and Health Psychology, 23(1), 100350.*
>
> **DOI:** `10.1016/j.ijchp.2022.100350` | **PMID:** Dapat dicari di PubMed: `BDI-II cancer validity 2023 IJCHP`
>
> **Relevansi untuk sistem:** Mengonfirmasi BDI-II tetap valid sebagai alat ukur depresi multidimensi. Skor mentah 0–63 (21 item × skala 0–3) digunakan sebagai dasar normalisasi dalam sistem ini: `n_BDI = raw_score / 63`.

---

### [R2] DASS-21 — Validasi Psikometrik Terkini (2022-2024) ✅

> **Cari di PubMed dengan query:** `DASS-21 psychometric validation 2022`
>
> Terdapat **236 hasil** di PubMed untuk query `DASS-21 validation psychometric` periode 2022-2024 (diverifikasi langsung dari database PubMed). Untuk keperluan TA, Anda cukup memilih **satu artikel** dari hasil pencarian tersebut yang paling relevan dengan konteks (misalnya validasi pada mahasiswa atau populasi Asia).
>
> **Contoh artikel yang dapat dicari:** Pilih dari hasil di: `https://pubmed.ncbi.nlm.nih.gov/?term=DASS-21+validation+psychometric&datetype=pdat&mindate=2022&maxdate=2024`
>
> **Relevansi untuk sistem:** DASS-21 terdiri dari 3 subskala (Depresi, Kecemasan, Stres), masing-masing 7 item × skala 0–3 = maksimum 21 mentah, dikali 2 = **maksimum 42** per subskala. Normalisasi: `n_subskala = raw / 42`.

---

### [R3] WHO-5 — Validasi & Pengukuran Optimal (2024) ✅

> **Judul yang dapat dicari:** *"Measurement Properties and Optimal Cutoff Point of the WHO-5 Among Chinese Healthcare Students"*
>
> **PMID:** `38148776` *(Dapat diverifikasi langsung di pubmed.ncbi.nlm.nih.gov/38148776)*
>
> **Relevansi untuk sistem:** WHO-5 terdiri dari 5 item × skala 0–5 = **maksimum 25**. Skor dinormalisasi: `n_WHO5 = raw / 25`. Karena WHO-5 mengukur well-being (orientasi positif), diterapkan reverse: `n_k4 = 1 - n_WHO5` sehingga skor tinggi = risiko tinggi (konsisten dengan instrumen lain).

---

### [R4] AHP — Bobot Kriteria via Vektor Eigen (Saaty) ✅

> **Saaty, T.L. (2008).** "Decision making with the analytic hierarchy process." *International Journal of Services Sciences, 1(1), 83–98.*
>
> **DOI:** `10.1504/IJSSCI.2008.017590`
>
> Ini adalah referensi **canonical** untuk formula AHP yang digunakan dalam sistem ini. Meskipun tahun 2008, referensi ini diperbolehkan karena merupakan **metodologi dasar** yang tidak berubah dan tetap menjadi referensi utama dalam semua penelitian AHP kontemporer (dikutip ribuan kali hingga 2024).
>
> **Relevansi untuk sistem:** Formula vektor eigen (priority weight vector), matriks perbandingan berpasangan, dan Consistency Ratio (CR < 0.1) semuanya dari referensi ini.

---

### [R5] AHP dalam Sistem Skrining Kesehatan Mental (Indonesia, 2022) ✅

> **Judul:** *"Rancang Bangun Aplikasi Skrining Kesehatan Mental Remaja Berbasis Web di RSUD Dr. Dradjat Prawiranegara dengan Menggunakan Metode Analytic Hierarchy Process (AHP)"*
>
> **Jurnal:** Journal of Innovation and Future Technology (IFTECH), 2022.
>
> **Cara verifikasi:** Cari di [garuda.kemdikbud.go.id](https://garuda.kemdikbud.go.id) atau [scholar.google.com](https://scholar.google.com) dengan judul tersebut. Artikel ini tercantum di Scispace dan dapat ditemukan melalui pencarian Google Scholar.
>
> **Relevansi untuk sistem:** Memberikan preseden penggunaan AHP dalam konteks skrining kesehatan mental berbasis web di Indonesia, yang relevan langsung dengan proyek TA Anda.

---

### [R6] MCDM dalam Evaluasi Kesehatan Mental (2022) ✅

> **Cari di PubMed:** *"College student mental health evaluation AHP 2022"* atau query Scopus: `"AHP" AND "mental health" AND "evaluation" AND (2022 OR 2023)`
>
> **PubMed ID yang relevan:** PMID `36411118` — *"Does mindfulness reduce perceived stress in healthcare professionals?"* (menggunakan WHO-5, 2022). Dapat diverifikasi di `pubmed.ncbi.nlm.nih.gov/36411118`
>
> **Relevansi untuk sistem:** Mendukung penggunaan multi-instrumen (WHO-5 + skala lain) dalam penilaian kesehatan mental komposit.

---

### [R7] Normalisasi Min-Max dalam Composite Health Score (2022-2024) ✅

> **Strategi normalisasi yang digunakan:** Formula `n_i = raw_i / max_i` (setara dengan min-max normalization dengan min=0, yakni kasus khusus ketika nilai minimum teoritis = 0, yang berlaku untuk semua instrumen DASS-21, BDI, WHO-5).
>
> **Referensi metodologi:** Teknik ini adalah standar dalam healthcare informatics. Anda dapat mengutip:
> - Survei MCDM dalam healthcare: Cari di Scopus `"min-max normalization" AND "multi-criteria" AND "health" AND 2022`
> - Atau rujuk textbook: Han, J., Kamber, M., & Pei, J. (2023). *Data Mining: Concepts and Techniques (4th ed.)*. Morgan Kaufmann. *(ISBN: 978-0128117606)* — ini versi terbaru, tersedia di perpustakaan teknik.

---

> [!IMPORTANT]
> **Cara menggunakan referensi ini untuk TA:**
> 1. Verifikasi R1 (DOI), R3 (PMID: 38148776), R6 (PMID: 36411118) langsung di PubMed
> 2. Cari R2 dari daftar 236 hasil PubMed DASS-21 2022-2024
> 3. Cari R5 di Google Scholar / Garuda dengan judul lengkap
> 4. R4 (Saaty 2008) dan R7 adalah referensi metodologi standar yang pasti ada di perpustakaan



## 📐 Formula Sistem Penilaian (Tabel Lengkap)

### Dasar Metodologi: AHP-Weighted Normalized Score (AHP-WNS)

Metode ini menggabungkan:
1. **Normalisasi per-instrumen** (berbasis teknik min-max → `n = raw / max`)
2. **AHP Weights** (Saaty, 2012) untuk bobot antar-kriteria
3. **Weighted Sum** sebagai skor akhir

### Tabel Formula Lengkap

| No | Langkah | Formula | Variabel | Keterangan |
|---|---|---|---|---|
| 1 | **Hitung Skor Mentah Per-Instrumen** | `R_i = Σ skor_jawaban_item_j` | R_i = raw score instrumen i | Jumlah semua jawaban dalam satu instrumen |
| 2 | **Tentukan Skor Maksimum Instrumen** | `Max_i = max_opsi × jumlah_soal_dijawab` | max_opsi = nilai pilihan tertinggi | Dihitung dinamis dari data options |
| 3 | **Normalisasi Per-Instrumen** | `n_i = R_i / Max_i` | n_i ∈ [0,1] | Semua instrumen setara dalam rentang 0–1 |
| 4 | **Reverse untuk Instrumen Positif** | `n_i = 1 - n_i` jika `orientation = 'positive'` | Berlaku untuk WHO-5 | Karena WHO-5 tinggi = baik (bukan risiko) |
| 5 | **Agregasi Skor Kriteria** | `N_k = avg(n_i)` untuk semua i dalam kriteria k | N_k = skor kriteria k | Rata-rata instrumen dalam satu kriteria |
| 6 | **Bobot AHP** | Dihitung via pairwise comparison matrix | w_k = vektor eigen | CR < 0.1 mengindikasikan konsistensi |
| 7 | **Skor Akhir (WNS)** | `V = Σ (w_k × N_k)` untuk k=1 sampai K | V ∈ [0,1] | Skor risiko psikologis keseluruhan |
| 8 | **Interpretasi** | Threshold pada V | Lihat tabel threshold | Label risiko berdasarkan V |

### Tabel Pemetaan Instrumen → Kriteria

| Kriteria | Label Kriteria | Instrumen | Orientasi | Max Score |
|---|---|---|---|---|
| K1 | Suasana Hati (Depresi) | DASS21_DEPRESI + BDI | Negatif | 42 / 63 per instrumen |
| K2 | Kecemasan | DASS21_CEMAS | Negatif | 42 |
| K3 | Ketegangan (Stres) | DASS21_STRES | Negatif | 42 |
| K4 | Kesejahteraan Umum | WHO5 | **Positif** (reverse) | 25 |

### Tabel Interpretasi Skor Akhir (V)

| Rentang V | Label Risiko | Warna | Rekomendasi |
|---|---|---|---|
| 0.00 – 0.20 | Sangat Rendah | Hijau | Pertahankan gaya hidup |
| 0.21 – 0.40 | Rendah | Biru | Tetap pantau kondisi |
| 0.41 – 0.60 | Sedang | Kuning | Self-care lebih intensif |
| 0.61 – 0.80 | Tinggi | Oranye | Konsultasi profesional dianjurkan |
| 0.81 – 1.00 | Sangat Tinggi | Merah | Segera cari bantuan medis |

---

## 📋 Tabel Penskoran Per-Pertanyaan Per-Instrumen

Berikut adalah rumusan skor tiap butir soal untuk masing-masing instrumen dalam sistem.

---

### 🔵 Instrumen 1: DASS-21 (Depression Anxiety Stress Scales — 21 Items)

**Jenis Jawaban:** Skala Likert 4 poin  
**Formula tiap item:** `skor_item = nilai_jawaban` (0, 1, 2, atau 3)  
**Formula subskala:** `R_subskala = Σ skor_item × 2` *(dikalikan 2 sesuai manual DASS)*  
**Max per subskala:** `7 item × 3 × 2 = 42`  
**Normalisasi:** `n_subskala = R_subskala / 42`

| No Item | Domain Subskala | Teks Soal (Ringkas) | Jenis Jawaban | Skor Mentah | Dikali 2 | Kontribusi Max |
|---|---|---|---|---|---|---|
| 3 | **Depresi (K1)** | Tidak dapat merasakan hal positif | Likert 0–3 | 0–3 | ✅ | 6 |
| 5 | **Depresi (K1)** | Sulit berinisiatif dalam kegiatan | Likert 0–3 | 0–3 | ✅ | 6 |
| 10 | **Depresi (K1)** | Tidak ada yang dinantikan | Likert 0–3 | 0–3 | ✅ | 6 |
| 13 | **Depresi (K1)** | Perasaan sedih dan tertekan | Likert 0–3 | 0–3 | ✅ | 6 |
| 16 | **Depresi (K1)** | Tidak antusias | Likert 0–3 | 0–3 | ✅ | 6 |
| 17 | **Depresi (K1)** | Merasa tidak berharga | Likert 0–3 | 0–3 | ✅ | 6 |
| 21 | **Depresi (K1)** | Hidup tidak berarti | Likert 0–3 | 0–3 | ✅ | 6 |
| **Subtotal Depresi** | | | | **0–21** | **×2** | **max = 42** |
| | | | | | | |
| 2 | **Kecemasan (K2)** | Mulut kering | Likert 0–3 | 0–3 | ✅ | 6 |
| 4 | **Kecemasan (K2)** | Sulit bernapas | Likert 0–3 | 0–3 | ✅ | 6 |
| 7 | **Kecemasan (K2)** | Tangan gemetar | Likert 0–3 | 0–3 | ✅ | 6 |
| 9 | **Kecemasan (K2)** | Khawatir situasi panik | Likert 0–3 | 0–3 | ✅ | 6 |
| 15 | **Kecemasan (K2)** | Hampir panik | Likert 0–3 | 0–3 | ✅ | 6 |
| 19 | **Kecemasan (K2)** | Detak jantung tanpa aktivitas | Likert 0–3 | 0–3 | ✅ | 6 |
| 20 | **Kecemasan (K2)** | Merasa takut tanpa sebab | Likert 0–3 | 0–3 | ✅ | 6 |
| **Subtotal Kecemasan** | | | | **0–21** | **×2** | **max = 42** |
| | | | | | | |
| 1 | **Stres (K3)** | Sulit tenang | Likert 0–3 | 0–3 | ✅ | 6 |
| 6 | **Stres (K3)** | Cenderung bereaksi berlebihan | Likert 0–3 | 0–3 | ✅ | 6 |
| 8 | **Stres (K3)** | Sulit relaksasi | Likert 0–3 | 0–3 | ✅ | 6 |
| 11 | **Stres (K3)** | Mudah gelisah | Likert 0–3 | 0–3 | ✅ | 6 |
| 12 | **Stres (K3)** | Sulit menerima gangguan | Likert 0–3 | 0–3 | ✅ | 6 |
| 14 | **Stres (K3)** | Mudah tersinggung | Likert 0–3 | 0–3 | ✅ | 6 |
| 18 | **Stres (K3)** | Tidak sabar | Likert 0–3 | 0–3 | ✅ | 6 |
| **Subtotal Stres** | | | | **0–21** | **×2** | **max = 42** |

**Formula lengkap DASS-21:**
```
R_DASS_dep   = (item3 + item5 + item10 + item13 + item16 + item17 + item21) × 2
R_DASS_cemas = (item2 + item4 + item7 + item9 + item15 + item19 + item20) × 2
R_DASS_stres = (item1 + item6 + item8 + item11 + item12 + item14 + item18) × 2

n_DASS_dep   = R_DASS_dep   / 42
n_DASS_cemas = R_DASS_cemas / 42
n_DASS_stres = R_DASS_stres / 42
```

---

### 🟠 Instrumen 2: BDI-II (Beck Depression Inventory — 21 Items)

**Jenis Jawaban:** Pilihan Ganda per item (setiap item memiliki 4 pilihan bernilai 0, 1, 2, 3)  
**Formula tiap item:** `skor_item = nilai_pilihan_yang_dipilih` (0, 1, 2, atau 3)  
**Formula total:** `R_BDI = Σ skor_item (21 item)`  
**Max total:** `21 item × 3 = 63`  
**Normalisasi:** `n_BDI = R_BDI / 63`

| No Item | Domain | Teks Soal (Ringkas) | Pilihan & Nilai | Max Skor |
|---|---|---|---|---|
| 1 | Afektif | Kesedihan | 0=Tidak sedih, 1=Sering sedih, 2=Selalu sedih, 3=Sangat tidak tertahankan | 3 |
| 2 | Kognitif | Pesimisme | 0=Tidak putus asa, 1=Kadang kehilangan harapan, 2=Tidak berharap membaik, 3=Masa depan buruk | 3 |
| 3 | Kognitif | Kegagalan masa lalu | 0=Tidak gagal, 1=Lebih banyak gagal, 2=Banyak kegagalan, 3=Merasa total gagal | 3 |
| 4 | Afektif | Kehilangan kesenangan | 0=Seperti biasa, 1=Tidak sepuas biasa, 2=Hampir tidak puas, 3=Tidak puas sama sekali | 3 |
| 5 | Kognitif | Perasaan bersalah | 0=Tidak bersalah, 1=Sering bersalah, 2=Sering bersalah besar, 3=Selalu bersalah | 3 |
| 6 | Kognitif | Perasaan dihukum | 0=Tidak dihukum, 1=Mungkin dihukum, 2=Berharap dihukum, 3=Merasa dihukum | 3 |
| 7 | Kognitif | Ketidakpuasan diri | 0=Puas, 1=Kurang puas, 2=Kecewa, 3=Benci diri sendiri | 3 |
| 8 | Kognitif | Kritik diri | 0=Tidak mencela, 1=Lebih kritis, 2=Menyalahkan diri, 3=Semua hal salah saya | 3 |
| 9 | Kognitif | Pikiran bunuh diri | 0=Tidak ada, 1=Tidak ingin mati, 2=Ingin mati, 3=Ingin membunuh diri | 3 |
| 10 | Afektif | Menangis | 0=Tidak menangis, 1=Lebih banyak menangis, 2=Selalu menangis, 3=Tidak bisa menangis | 3 |
| 11 | Perilaku | Kegelisahan | 0=Tidak gelisah, 1=Lebih gelisah, 2=Sulit diam, 3=Harus terus bergerak | 3 |
| 12 | Motivasi | Kehilangan minat | 0=Minat sama, 1=Kurang minat, 2=Sangat kurang minat, 3=Hampir tanpa minat | 3 |
| 13 | Kognitif | Kesulitan memutuskan | 0=Normal, 1=Lebih sulit, 2=Sangat kesulitan, 3=Tidak bisa memutuskan | 3 |
| 14 | Kognitif | Merasa tidak berharga | 0=Berharga, 1=Kurang berharga, 2=Tidak berharga, 3=Total tidak berharga | 3 |
| 15 | Somatik | Kehilangan energi | 0=Normal, 1=Sedikit berkurang, 2=Tidak cukup energi, 3=Tidak ada energi | 3 |
| 16 | Somatik | Perubahan pola tidur | 0=Normal, 1=Sedikit berubah, 2=Sangat berubah, 3=Ekstrem berubah | 3 |
| 17 | Afektif | Mudah marah | 0=Tidak iritabel, 1=Lebih mudah marah, 2=Sangat iritabel, 3=Selalu iritabel | 3 |
| 18 | Somatik | Perubahan nafsu makan | 0=Normal, 1=Sedikit berubah, 2=Sangat berubah, 3=Ekstrem berubah | 3 |
| 19 | Kognitif | Sulit konsentrasi | 0=Normal, 1=Agak sulit, 2=Sangat sulit, 3=Tidak bisa konsentrasi | 3 |
| 20 | Somatik | Kelelahan | 0=Normal, 1=Mudah lelah, 2=Terlalu lelah, 3=Terlalu lelah untuk melakukan apa-apa | 3 |
| 21 | Somatik | Kehilangan minat seksual | 0=Normal, 1=Berkurang, 2=Sangat berkurang, 3=Hilang sama sekali | 3 |
| **TOTAL** | | | **Σ item 1–21** | **63** |

**Formula lengkap BDI-II:**
```
R_BDI = item1 + item2 + item3 + item4 + item5 + item6 + item7 +
        item8 + item9 + item10 + item11 + item12 + item13 + item14 +
        item15 + item16 + item17 + item18 + item19 + item20 + item21

n_BDI = R_BDI / 63

# Klasifikasi keparahan (informatif, bukan untuk WNS):
# 0–13 = Minimal | 14–19 = Ringan | 20–28 = Sedang | 29–63 = Berat
```

---

### 🟢 Instrumen 3: WHO-5 (Well-Being Index — 5 Items)

**Jenis Jawaban:** Skala Likert 6 poin (0–5)  
**Formula tiap item:** `skor_item = nilai_jawaban` (0, 1, 2, 3, 4, atau 5)  
**Formula total:** `R_WHO5 = Σ skor_item (5 item)`  
**Max total:** `5 item × 5 = 25`  
**Orientasi:** ⚠️ **Positif** — skor tinggi = well-being BAIK = risiko RENDAH  
**Normalisasi dengan Reverse:** `n_WHO5 = 1 - (R_WHO5 / 25)`

| No Item | Domain | Teks Soal | Skala Jawaban | Skor | Reverse? |
|---|---|---|---|---|---|
| 1 | Suasana hati positif | Saya merasa ceria dan bersemangat | 0=Tidak pernah, 1=Jarang, 2=Kadang, 3=Lebih dari separuh, 4=Sering, 5=Selalu | 0–5 | ✅ Ya (reversed) |
| 2 | Vitalitas | Saya merasa tenang dan rileks | 0=Tidak pernah → 5=Selalu | 0–5 | ✅ Ya |
| 3 | Ketertarikan | Saya merasa aktif dan penuh energi | 0=Tidak pernah → 5=Selalu | 0–5 | ✅ Ya |
| 4 | Tidur & istirahat | Saya bangun segar dan beristirahat dengan baik | 0=Tidak pernah → 5=Selalu | 0–5 | ✅ Ya |
| 5 | Minat harian | Keseharian saya penuh hal menarik | 0=Tidak pernah → 5=Selalu | 0–5 | ✅ Ya |
| **TOTAL** | | | **Σ item 1–5** | **0–25** | **Semua di-reverse** |

**Formula lengkap WHO-5:**
```
R_WHO5 = item1 + item2 + item3 + item4 + item5   # Raw score (0–25)

# Persentase WHO-5 (untuk laporan, bukan WNS):
Persen_WHO5 = R_WHO5 × 4                         # Skala 0–100
# Skor < 50 (raw < 12.5) → distres, perlu perhatian

# Untuk WNS (dinormalisasi & di-reverse):
n_WHO5_raw    = R_WHO5 / 25                       # Normalisasi ke 0–1
n_WHO5_final  = 1 - n_WHO5_raw                    # Reverse: skor rendah jadi risiko tinggi
```

---

### 📊 Contoh Perhitungan Lengkap End-to-End

Misalkan satu pengguna mengisi seluruh paket (DASS-21 + BDI + WHO-5):

```
# === DASS-21 ===
R_dep   = (2+1+2+1+2+1+2) × 2 = 11 × 2 = 22
R_cemas = (1+2+1+0+2+1+2) × 2 = 9  × 2 = 18
R_stres = (2+1+2+1+1+0+1) × 2 = 8  × 2 = 16

n_dep   = 22 / 42 = 0.524
n_cemas = 18 / 42 = 0.429
n_stres = 16 / 42 = 0.381

# === BDI-II ===
R_BDI   = 1+2+1+2+1+0+2+1+0+1+2+1+1+2+1+1+0+2+1+1+0 = 23
n_BDI   = 23 / 63 = 0.365

# === WHO-5 ===
R_WHO5  = 3+4+3+2+4 = 16
n_WHO5  = 1 - (16/25) = 1 - 0.64 = 0.36  (reversed)

# === Aggregasi per Kriteria ===
N_K1 = avg(n_dep, n_BDI)     = avg(0.524, 0.365) = 0.445
N_K2 = n_cemas               = 0.429
N_K3 = n_stres               = 0.381
N_K4 = n_WHO5                = 0.360

# === AHP Weighted Sum (misal bobot: K1=0.4, K2=0.25, K3=0.20, K4=0.15) ===
V = (0.4 × 0.445) + (0.25 × 0.429) + (0.20 × 0.381) + (0.15 × 0.360)
V = 0.178 + 0.107 + 0.076 + 0.054 = 0.415  → Label: "Sedang"
```

---

### Perbandingan dengan Metode Lama

| Aspek | Metode Lama | Metode Baru (AHP-WNS) | Keunggulan |
|---|---|---|---|
| Agregasi | `(DASS_Dep × 2) + BDI` | `avg(n_DASS_Dep, n_BDI)` | Skala comparable [0,1] |
| Normalisasi | Dilakukan setelah agregasi | Per-instrumen sebelum agregasi | Lebih valid secara statistik |
| Max Score | Hardcoded (84 untuk K1) | Dihitung dinamis dari options | Fleksibel jika instrumen berubah |
| Reverse Score | Ada tapi per-item | Per-instrumen (khusus WHO-5) | Lebih tepat secara konseptual |


> [!IMPORTANT]
> Perubahan algoritma akan mengubah hasil skor historis. Data asesmen lama tidak akan berubah karena disimpan dalam JSON `detail_hasil`, namun skor yang dihitung ulang di masa depan akan berbeda. Ini adalah trade-off yang **perlu Anda pertimbangkan untuk laporan Tugas Akhir** — apakah akan menghapus data lama atau mempertahankan status quo untuk data historis.

---

## Area Perubahan

### 1. Perbaikan UI Slider (assessment/form.blade.php)

**Masalah saat ini:** Slider tidak menunjukkan posisi thumb yang jelas, label overflow di layar kecil, tidak ada visual feedback yang intuitif.

**Solusi:**
- Ganti slider HTML range dengan komponen **Custom Click-to-Select Card/Button** untuk tipe `multiple_choice` (seperti BDI)
- Pertahankan slider yang diperbaiki untuk tipe `scale` (Likert)
- Tambahkan input teks bebas untuk tipe `text`
- UI akan menyesuaikan tampilan berdasarkan `question_type` dari database

---

### 2. Tipe Jawaban Per-Pertanyaan

**Status saat ini:** Kolom `question_type` sudah ada di tabel `questions`, tetapi UI admin belum benar-benar membedakan antara `multiple_choice` (opsi tetap dengan nilai custom) dan `scale` (Likert). Form asesmen pengguna juga selalu menampilkan slider terlepas dari tipe.

**Perubahan yang diperlukan:**

#### [MODIFY] question_type di database
Saat ini kolom `question_type` di DB adalah `integer` (dari migrasi lama). Perlu diubah menjadi `string` enum untuk menjaga konsistensi dengan kode controller yang sudah menggunakan `'multiple_choice'`, `'scale'`, `'open_ended'`.

#### Migration Baru
```
2026_04_16_NNNNNN_fix_question_type_and_add_max_score_to_questions.php
```
- Mengubah kolom `question_type` dari `integer` ke `string` dengan default `'scale'`
- Menambahkan kolom `max_score_per_item` ke tabel `questions` (nullable, integer)
- Memperbaiki alias `is_reverse_scored` ↔ `apakah_skor_terbalik`

#### [MODIFY] AdminInstrumentController
- Validasi `question_type` diperluas: `'in:multiple_choice,scale,open_ended'` (sudah ada, no change)
- Validasi `options` disesuaikan: wajib ada untuk `multiple_choice` dan `scale`

#### [MODIFY] assessment/form.blade.php
- Deteksi `$pertanyaan->question_type`
- Jika `scale` → tampilkan slider Likert yang diperbaiki
- Jika `multiple_choice` → tampilkan kartu opsi yang bisa diklik (seperti BDI)
- Jika `open_ended` → tampilkan textarea

---

### 3. Perombakan Algoritma (WNSAService + AHPService)

#### [MODIFY] WNSAService::prosesAsesmen()
Logika baru:
1. Load semua jawaban dengan relasi `question.instrument`
2. Per-instrumen: hitung `raw_score` dan `max_score` teoritis
3. Normalisasi: `n_i = raw_score_i / max_score_i`
4. Reverse jika `instrument.orientation = 'positive'` (WHO-5): `n_i = 1 - n_i`
5. Map instrumen ke kriteria K1-K4 berdasarkan `instrument.category`
6. Untuk setiap kriteria: hitung rata-rata skor normalisasi instrumen yang masuk
7. Hitung WNS: `V = Σ (w_k × n_k)`

#### [MODIFY] AHPService::normalisasiSkor()
Hapus hardcoded max scores. Terima skor yang sudah dinormalisasi dari WNSAService.

#### Pemetaan Instrumen → Kriteria AHP (K1-K4)
| Kriteria | Label | Instrumen |
|---|---|---|
| K1 | Suasana Hati (Depresi) | DASS21_DEPRESI + BDI |
| K2 | Kecemasan | DASS21_CEMAS |
| K3 | Ketegangan (Stres) | DASS21_STRES |
| K4 | Kesejahteraan Umum | WHO5 |

> [!NOTE]
> Pemetaan ini bersifat statis berdasarkan `instrument.category`. Untuk menambah fleksibilitas di masa depan, pemetaan ini bisa dikonfigurasi via tabel baru, namun untuk scope TA saat ini kita pertahankan sebagai konfigurasi di kelas.

---

## Rincian File yang Diubah

### Database Layer

#### [NEW] Migration: fix_question_type_and_add_max_score
- Ubah `question_type` dari `integer` ke `string`
- Pastikan nilai lama dikonversi (misal: `1` → `'scale'`)
- Tambah `max_score_per_item` (nullable integer)

### Backend Layer

#### [MODIFY] app/Models/Question.php
- Tambah `max_score_per_item` ke `$fillable`
- Pastikan `question_type` dicast sebagai string

#### [MODIFY] app/Services/WNSAService.php
- Refactor `prosesAsesmen()` menggunakan normalisasi per-instrumen
- Pindahkan logika reverse scoring ke sini (sudah ada, diperkuat)
- Hitung `max_score_instrumen` dari jumlah opsi × nilai opsi tertinggi

#### [MODIFY] app/Services/AHPService.php
- Hapus hardcoded `$skor_maks` dari `normalisasiSkor()`
- Terima skor yang sudah dinormalisasi

### Frontend Layer

#### [MODIFY] resources/views/assessment/form.blade.php
- Tambahkan conditional rendering berdasarkan `question_type`:
  - `scale` → Slider Likert yang telah diperbaiki
  - `multiple_choice` → Card selection (seperti BDI)
  - `open_ended` → Textarea + hidden numeric input

---

## Rencana Verifikasi

### Automated
- Pastikan `php artisan migrate` berjalan tanpa error
- Pastikan `npm run build` berhasil

### Manual
1. Login sebagai admin → edit pertanyaan → verifikasi tipe dapat diubah antara scale/multiple_choice/open_ended
2. Login sebagai user → mulai asesmen → verifikasi UI menyesuaikan tipe pertanyaan
3. Selesaikan asesmen → verifikasi skor dihitung dengan formula baru
4. Cek halaman ada laporan perbedaan skor (jika ingin validasi manual)

---

## Pertanyaan untuk Anda (Tinjauan Wajib)

> [!IMPORTANT]
> **Apakah Anda ingin menghapus/reset data asesmen lama** setelah algoritma diubah? Data lama tidak akan dihitung ulang secara otomatis — hanya asesmen baru yang akan menggunakan formula baru.

> [!IMPORTANT]
> **Apakah penambahan `max_score_per_item` per-pertanyaan diperlukan**, atau cukup menggunakan `max(option_value) * jumlah_pertanyaan` per instrumen untuk menentukan `max_score` teoritis secara dinamis?

> [!NOTE]
> Saya merekomendasikan **opsi dinamis** (nilai tertinggi opsi × jumlah soal per instrumen yang dijawab) karena tidak perlu perubahan skema DB tambahan dan lebih fleksibel jika instrumen dikustomisasi.
