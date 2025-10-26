# Laporan Praktikum: JQuery dan AJAX
**Nama:** Fajar Eka Sandiyuda  
**NIM:** 244107020043  
**Kelas:** TI-2A  
**Mata Kuliah:** Desain dan Pemrograman Web  
**Pengampu:** Tim Ajar Desain dan Pemrograman Web

## Petunjuk
Ganti placeholder di atas (Nama, NIM, Kelas) sebelum mengumpulkan.

## Jawaban Soal (ringkas)
**Soal 1 (Document Ready)**  
Fungsi `$(document).ready()` memastikan DOM selesai dimuat sebelum kode jQuery dieksekusi sehingga manipulasi elemen tidak gagal.

**Soal 2 (Selector)**  
- Selector tag: `$("p")` memilih semua paragraf.  
- Selector id: `$("#idName")` memilih elemen dengan id tertentu.  
- Selector class: `$(".className")` memilih elemen dengan class tertentu.

**Soal 3 (Selector di kode)**  
Contoh selector yang sering muncul: `$("#btn")`, `$(".panel")`, `$("p")`, `$("input[type='text']")`. Mereka memilih elemen berdasarkan id, class, tag, atau atribut.

**Soal 4 (Events - hasil pengamatan)**  
- `mouseover` men-trigger saat pointer masuk elemen.  
- `mouseout` saat pointer keluar.  
- `click` saat diklik sekali; `dblclick` saat diklik dua kali.  
Perubahan bisa berupa teks, warna, atau efek animasi.

**Soal 5 (Effect hide/show)**  
- `hide()` menyembunyikan elemen secara langsung.  
- `show()` menampilkan kembali.  
- `fadeIn()`/`fadeOut()` melakukan transisi opacity untuk efek halus.

**Soal 6–8 (Effect Slide)**  
- `slideUp()` mengecilkan tinggi elemen sampai tersembunyi.  
- `slideDown()` menampilkan dengan naik.  
- `slideToggle()` menggabungkan keduanya sesuai kondisi.

**Soal 9–10 (Animation & Chaining)**  
- `animate()` mengubah properti CSS (mis. `left`, `top`, `opacity`) dengan durasi.  
- Chaining: `$("#box").fadeIn().animate(...).slideUp();` menjalankan berurutan.

**Soal 11–12 (GET/SET text/html/val)**  
- `text()` mengambil/men-set teks tanpa HTML.  
- `html()` mengambil/men-set HTML (termasuk tag).  
- `val()` mengambil/men-set nilai input form.

**Soal 13 (append/remove)**  
- `append()` menambahkan elemen ke dalam container.  
- `remove()` menghapus elemen yang dipilih.

**Soal 14 (Manipulasi CSS)**  
- `addClass()` menambah class.  
- `removeClass()` menghapus class.  
- `css()` mengatur properti style langsung.

**Soal 15 (Slideshow - pengamatan)**  
Slideshow menampilkan gambar satu per satu, biasanya menggunakan `fadeIn()`/`fadeOut()` dan `delay()` untuk transisi.

**Soal 16 (Accordion)**  
Accordion membuka/menutup panel; di jQuery UI cukup panggil `.accordion()` pada container.

**Soal 17 (AJAX load)**  
`$(selector).load("file.html")` memuat konten HTML dari server ke dalam elemen tanpa reload halaman.

---

## Catatan Pengumpulan
- Paket ini berisi contoh kode untuk setiap bagian praktikum (HTML/CSS/JS) yang bisa langsung dijalankan pada `localhost` jika diletakkan di direktori server (mis. `dasarWeb/praktik_jquery`).
- Jika ingin versi PDF report, konversi REPORT.md ke PDF lokal sebelum dikumpulkan.

